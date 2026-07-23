#!/usr/bin/env bash

set -Eeuo pipefail
umask 0002

readonly APP_DIR="/home/master/applications/bvcxzudysy/public_html"
readonly LOCK_FILE="/home/master/mls-github-deploy.lock"
readonly LOG_FILE="/home/master/mls-github-deploy.log"
readonly DEPLOY_ROOT="/home/master/deploy/mls"
readonly REPOSITORY_DIR="${DEPLOY_ROOT}/repository.git"
readonly RELEASES_DIR="${DEPLOY_ROOT}/releases"
readonly ROLLBACK_DIR="${DEPLOY_ROOT}/rollback"
readonly MANIFEST_FILE="${DEPLOY_ROOT}/deployed-manifest"
readonly REVISION_FILE="${APP_DIR}/storage/app/deployed-revision"
readonly GIT_URL="git@github.com:mlsarmenia/backend.git"
readonly GIT_BRANCH_REF="refs/remotes/origin/master"
readonly GIT_IDENTITY="/home/master/.ssh/mls-github-readonly"
readonly GIT_KNOWN_HOSTS="/home/master/.ssh/mls-github-known_hosts"
readonly GIT_SSH_COMMAND="ssh -i ${GIT_IDENTITY} -o BatchMode=yes -o IdentitiesOnly=yes -o StrictHostKeyChecking=yes -o CheckHostIP=no -o UserKnownHostsFile=${GIT_KNOWN_HOSTS}"

revision=""
if ! IFS= read -r revision || [[ ! "$revision" =~ ^[0-9a-f]{40}$ ]]; then
    echo "This key is restricted to MLS production deployments."
    exit 1
fi

if IFS= read -r _; then
    echo "The deployment request contained unexpected input."
    exit 1
fi

release_dir=""
new_manifest=""
previous_manifest=""
previous_revision=""
maintenance_enabled=false
rollback_ready=false
deployment_started=false
manifest_existed=false
manifest_replaced=false
revision_existed=false
revision_replaced=false

exec > >(tee -a "$LOG_FILE") 2>&1

echo "[$(date -u +'%Y-%m-%dT%H:%M:%SZ')] Starting ${revision}"

exec 9>"$LOCK_FILE"
if ! flock -n 9; then
    echo "Another MLS deployment is already running."
    exit 1
fi

restore_application() {
    local status=$?

    set +e

    if [[ $status -ne 0 && "$deployment_started" == "true" && "$rollback_ready" == "true" ]]; then
        echo "Restoring the previous application files..."
        rsync -a --delete \
            --exclude '/.env' \
            --exclude '/auth.json' \
            --exclude '/storage' \
            --exclude '/public/storage' \
            "${ROLLBACK_DIR}/" \
            "${APP_DIR}/"

        if [[ "$manifest_replaced" == "true" ]]; then
            if [[ "$manifest_existed" == "true" ]]; then
                install -m 600 "$previous_manifest" "$MANIFEST_FILE"
            else
                rm -f -- "$MANIFEST_FILE"
            fi
        fi

        if [[ "$revision_replaced" == "true" ]]; then
            if [[ "$revision_existed" == "true" ]]; then
                install -m 600 "$previous_revision" "$REVISION_FILE"
            else
                rm -f -- "$REVISION_FILE"
            fi
        fi
    fi

    if [[ "$maintenance_enabled" == "true" ]]; then
        cd "$APP_DIR"
        php artisan up
        if [[ $? -ne 0 ]]; then
            rm -f storage/framework/down
        fi
    fi

    if [[ -n "$release_dir" && "$release_dir" == "${RELEASES_DIR}/"* ]]; then
        rm -rf -- "$release_dir"
    fi

    if [[ -n "$new_manifest" && "$new_manifest" == "${DEPLOY_ROOT}/"* ]]; then
        rm -f -- "$new_manifest"
    fi

    if [[ -n "$previous_manifest" && "$previous_manifest" == "${DEPLOY_ROOT}/"* ]]; then
        rm -f -- "$previous_manifest"
    fi

    if [[ -n "$previous_revision" && "$previous_revision" == "${DEPLOY_ROOT}/"* ]]; then
        rm -f -- "$previous_revision"
    fi

    if [[ $status -ne 0 ]]; then
        echo "[$(date -u +'%Y-%m-%dT%H:%M:%SZ')] Deployment ${revision} failed."
    fi

    exit "$status"
}
trap restore_application EXIT

for command in composer flock git php rsync tar; do
    command -v "$command" >/dev/null
done

for path in "$APP_DIR" "$APP_DIR/.env" "$APP_DIR/storage" "$GIT_IDENTITY" "$GIT_KNOWN_HOSTS"; do
    if [[ ! -e "$path" ]]; then
        echo "Required deployment path is missing: ${path}"
        exit 1
    fi
done

install -d -m 700 "$DEPLOY_ROOT" "$RELEASES_DIR" "$ROLLBACK_DIR"

if [[ ! -d "$REPOSITORY_DIR" ]]; then
    git init --bare "$REPOSITORY_DIR"
    git --git-dir="$REPOSITORY_DIR" remote add origin "$GIT_URL"
fi

git --git-dir="$REPOSITORY_DIR" remote set-url origin "$GIT_URL"
export GIT_SSH_COMMAND
git --git-dir="$REPOSITORY_DIR" fetch \
    --prune \
    origin \
    "+refs/heads/master:${GIT_BRANCH_REF}"

git --git-dir="$REPOSITORY_DIR" cat-file -e "${revision}^{commit}"
master_revision="$(git --git-dir="$REPOSITORY_DIR" rev-parse "$GIT_BRANCH_REF")"
if [[ "$revision" != "$master_revision" ]]; then
    echo "Revision ${revision} is not the current origin/master head (${master_revision})."
    exit 1
fi

release_dir="$(mktemp -d "${RELEASES_DIR}/${revision}.XXXXXX")"
git --git-dir="$REPOSITORY_DIR" archive "$revision" | tar -x -C "$release_dir"

for path in artisan composer.json composer.lock; do
    if [[ ! -f "${release_dir}/${path}" ]]; then
        echo "Revision ${revision} is missing ${path}."
        exit 1
    fi
done

bash -n "$release_dir/scripts/cloudways-server-deploy.sh"

ln -s "$APP_DIR/.env" "$release_dir/.env"
ln -s "$APP_DIR/storage" "$release_dir/storage"
if [[ -f "$APP_DIR/auth.json" ]]; then
    rm -f -- "$release_dir/auth.json"
    ln -s "$APP_DIR/auth.json" "$release_dir/auth.json"
fi

if [[ -d "$APP_DIR/vendor" ]]; then
    cp -a "$APP_DIR/vendor" "$release_dir/vendor"
fi

(
    cd "$release_dir"
    composer install \
        --no-dev \
        --no-interaction \
        --prefer-dist \
        --optimize-autoloader
)

new_manifest="$(mktemp "${DEPLOY_ROOT}/manifest.XXXXXX")"
git --git-dir="$REPOSITORY_DIR" ls-tree -r --name-only "$revision" \
    | LC_ALL=C sort >"$new_manifest"

rsync -a --delete \
    --exclude '/.env' \
    --exclude '/auth.json' \
    --exclude '/storage' \
    --exclude '/public/storage' \
    "${APP_DIR}/" \
    "${ROLLBACK_DIR}/"
rollback_ready=true

cd "$APP_DIR"
if [[ ! -f storage/framework/down ]]; then
    php artisan down --retry=60
    maintenance_enabled=true
fi
deployment_started=true

if [[ -f "$MANIFEST_FILE" ]]; then
    while IFS= read -r obsolete_path; do
        case "$obsolete_path" in
            "" | /* | .. | ../* | */../* | .env | auth.json | storage | storage/* | vendor | vendor/* | public/storage | public/storage/*)
                continue
                ;;
        esac

        target_path="$(realpath -m "${APP_DIR}/${obsolete_path}")"
        if [[ "$target_path" != "${APP_DIR}/"* ]]; then
            echo "Refusing to remove unsafe deployment path: ${obsolete_path}"
            exit 1
        fi

        rm -f -- "$target_path"

        parent_path="$(dirname "$target_path")"
        while [[ "$parent_path" == "${APP_DIR}/"* ]]; do
            if ! rmdir --ignore-fail-on-non-empty "$parent_path" 2>/dev/null; then
                break
            fi
            parent_path="$(dirname "$parent_path")"
        done
    done < <(comm -23 "$MANIFEST_FILE" "$new_manifest")
fi

rsync -a \
    --exclude '/.env' \
    --exclude '/auth.json' \
    --exclude '/storage' \
    --exclude '/vendor' \
    --exclude '/public/storage' \
    "${release_dir}/" \
    "${APP_DIR}/"

install -d -m 775 "$APP_DIR/vendor"
rsync -a --delete "${release_dir}/vendor/" "${APP_DIR}/vendor/"

php artisan migrate --force --no-interaction
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
php artisan queue:restart

if [[ "$maintenance_enabled" == "true" ]]; then
    php artisan up
    maintenance_enabled=false
fi

if [[ -f "$MANIFEST_FILE" ]]; then
    previous_manifest="$(mktemp "${DEPLOY_ROOT}/previous-manifest.XXXXXX")"
    cp -a "$MANIFEST_FILE" "$previous_manifest"
    manifest_existed=true
fi

if [[ -f "$REVISION_FILE" ]]; then
    previous_revision="$(mktemp "${DEPLOY_ROOT}/previous-revision.XXXXXX")"
    cp -a "$REVISION_FILE" "$previous_revision"
    revision_existed=true
fi

server_script_tmp="$(mktemp /home/master/bin/deploy-mls.XXXXXX)"
install -m 700 "$APP_DIR/scripts/cloudways-server-deploy.sh" "$server_script_tmp"
mv -f -- "$server_script_tmp" /home/master/bin/deploy-mls

manifest_tmp="$(mktemp "${DEPLOY_ROOT}/deployed-manifest.XXXXXX")"
install -m 600 "$new_manifest" "$manifest_tmp"
mv -f -- "$manifest_tmp" "$MANIFEST_FILE"
manifest_replaced=true

revision_tmp="$(mktemp "${APP_DIR}/storage/app/deployed-revision.XXXXXX")"
printf '%s\n' "$revision" >"$revision_tmp"
chmod 600 "$revision_tmp"
mv -f -- "$revision_tmp" "$REVISION_FILE"
revision_replaced=true

echo "[$(date -u +'%Y-%m-%dT%H:%M:%SZ')] Deployment ${revision} completed."
trap - EXIT

if [[ "$release_dir" == "${RELEASES_DIR}/"* ]]; then
    rm -rf -- "$release_dir"
fi
rm -f -- "$new_manifest"
rm -f -- "$previous_manifest" "$previous_revision"
