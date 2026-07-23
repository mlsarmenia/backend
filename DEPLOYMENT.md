# Production deployment

Pushes to `master` deploy automatically through
`.github/workflows/deploy-production.yml`.

The workflow:

1. Connects with a restricted SSH key that can only run the MLS deployment
   command and sends the exact commit SHA over standard input.
2. Fetches the exact pushed commit with a repository-scoped, read-only GitHub
   deploy key stored on the Cloudways server.
3. Builds production Composer dependencies before maintenance mode.
4. Takes a local rollback snapshot while preserving `.env`, `auth.json`,
   `storage`, and `public/storage`.
5. Updates the application, runs database migrations, and rebuilds Laravel
   caches.
6. Checks `https://mlsapp.am`.

## GitHub production configuration

Create a `production` environment with:

- Secret `CLOUDWAYS_DEPLOY_SSH_KEY`: the private half of the restricted
  deployment key.
- Variable `CLOUDWAYS_SSH_USER`: the Cloudways master username.

Limit the environment to the `master` branch. Never commit passwords or private
SSH keys.

## Server command

The deployment key is restricted in Cloudways'
`~/.openssh/authorized_keys` to a fixed copy of
`scripts/cloudways-server-deploy.sh` stored outside the application directory.
A separate read-only deploy key grants the server pull access to this
repository only.

The command prepares a release, keeps a rollback copy, and then runs:

```text
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
php artisan migrate --force --no-interaction
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
php artisan queue:restart
```

The application enters maintenance mode while these commands run and is
restored automatically if a command fails. Application code and Composer
dependencies are also restored from the local rollback copy on failure.
