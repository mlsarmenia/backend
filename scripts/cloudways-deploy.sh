#!/usr/bin/env bash

set -Eeuo pipefail

require_env() {
    local name="$1"

    if [[ -z "${!name:-}" ]]; then
        echo "::error::Required environment variable ${name} is not configured."
        exit 1
    fi
}

for name in \
    CLOUDWAYS_DEPLOY_SSH_KEY \
    CLOUDWAYS_SSH_USER \
    CLOUDWAYS_SSH_HOST \
    PRODUCTION_URL
do
    require_env "$name"
done

command -v curl >/dev/null
command -v ssh >/dev/null

key_file="$(mktemp)"

cleanup() {
    rm -f "$key_file"
}
trap cleanup EXIT

install -d -m 700 "$HOME/.ssh"
install -m 600 .github/cloudways_known_hosts "$HOME/.ssh/known_hosts"
printf '%s\n' "$CLOUDWAYS_DEPLOY_SSH_KEY" >"$key_file"
chmod 600 "$key_file"

echo "Starting the restricted production deployment for ${GITHUB_SHA}..."
printf '%s\n' "$GITHUB_SHA" | ssh \
    -T \
    -i "$key_file" \
    -o BatchMode=yes \
    -o IdentitiesOnly=yes \
    -o StrictHostKeyChecking=yes \
    -o ConnectTimeout=20 \
    -o ServerAliveInterval=30 \
    -o ServerAliveCountMax=20 \
    "${CLOUDWAYS_SSH_USER}@${CLOUDWAYS_SSH_HOST}"

echo "Checking ${PRODUCTION_URL}..."
curl \
    --fail \
    --silent \
    --show-error \
    --location \
    --max-time 30 \
    --retry 5 \
    --retry-delay 5 \
    --output /dev/null \
    "$PRODUCTION_URL"

echo "Production deployment completed successfully."
