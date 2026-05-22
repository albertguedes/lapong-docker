# User Manual

Lapong Docker — Laravel 12 development environment (v0.10.1).

## Quick Start

```bash
# 1. Clone and enter directory
git clone https://github.com/albertguedes/lapong-docker.git
cd lapong-docker

# 2. Configure environment
cp .env.example .env
cp src/.env.example src/.env
php src/artisan key:generate   # or: make shell service=php, then artisan key:generate

# 3. Build and start
make build && make up

# 4. Verify
make test
```

## Services (host networking)

All services bind on the host loopback. Only **one** stack using these ports can run at a time (e.g. do not run minimal_viable alongside lapong).

| Service | Port | Description |
|---------|------|-------------|
| nginx | 8080 | HTTP server (Laravel `public/`) |
| php-fpm | 9000 | PHP FastCGI |
| postgresql | 5432 | Database |

## Common Commands

```bash
make up               # Start containers
make down             # Stop containers
make build            # Rebuild images
make logs             # View logs
make logs service=php # Service-specific logs
make shell            # Shell into container (service=php|db|webserver)
make status           # Show running containers
make clean            # Remove containers and volumes
make test             # HTTP checks + PHPUnit (all suites)
make test-unit        # Unit tests only
make test-integration # Integration tests only
make test-backup      # Backup/restore script tests
make backup           # Backup database
make restore          # Restore database (file=<backup>)
make crontab          # Install crontab from crontab.txt
```

## Laravel Commands

```bash
docker exec lapong-php-fpm-container php artisan <command>
docker exec lapong-php-fpm-container composer <command>

# Or shell in
make shell service=php
cd /var/www/html && php artisan <command>
```

## Endpoints

| URL | Description |
|-----|-------------|
| http://localhost:8080/ | Laravel application |
| http://localhost:8080/health | Nginx health check (static OK) |
| http://localhost:8080/up | Laravel health check |
| http://localhost:8080/metrics.php | JSON metrics (DB size, PHP stats) |

## Environment

**Docker (`.env`):** `POSTGRES_DB`, `POSTGRES_USER`, `POSTGRES_PASSWORD`

**Laravel (`src/.env`):**

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=lapongdb
DB_USERNAME=lapong
DB_PASSWORD=lapong
APP_URL=http://localhost:8080
```

## Backup & Restore

```bash
# Create backup (optional: copy backup/config.sh → config.local.sh for S3/GPG/rsync)
make backup

# Restore from backup
make restore file=backup/postgresql_20260521_120000.sql.gz

# Verify latest backup in isolated container
bash backup/verify-restore.sh
```

## Troubleshooting

**Port already in use (8080, 9000, or 5432):**

Another project may be using host networking on the same ports. Stop it first:

```bash
# Example: minimal_viable on the same machine
cd /path/to/minimal_viable && make down
```

**Services won't start:**

```bash
docker compose ps
make logs
cat .env
```

**Database connection fails:**

```bash
pg_isready -h 127.0.0.1 -p 5432 -U lapong -d lapongdb
make shell service=php
cd /var/www/html && php artisan migrate:status
```
