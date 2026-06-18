## MLS estates backend/admin

## Setup

**1. Install Composer dependencies**

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

**2. Configure environment**

```bash
cp .env.example .env
```

**3. Start services**

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail a db:seed --class=UserSeeder
./vendor/bin/sail a storage:link
```

**4. Go to admin panel**

Navigate to http://localhost/admin

Local credentials:
```text
mlsarmenia8@gmail.com
password
```
