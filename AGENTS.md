# Agents

## Start environment
```bash
make build && make up
```
App: http://localhost:8080

## Developer Commands
```bash
make help              # Show all commands
make build             # Build Docker images
make up                # Start all containers
make down              # Stop all containers
make logs              # View all logs
make logs service=<db|php|webserver>  # View specific service logs
make shell service=<php|db|webserver>  # Shell into container
make test              # HTTP + PHPUnit tests
make test-unit         # Unit tests only
make test-integration  # Integration tests only
make test-backup       # Backup script tests
make clean             # Remove containers and volumes
make status            # Show running containers
make backup            # Backup database to backup/*.sql.gz
make restore file=<backup>  # Restore from backup
```

## Run Laravel commands (inside php container)
```bash
cd /var/www/html && php artisan <command>
docker exec lapong-php-fpm-container composer <command>
```

## Endpoints
- http://localhost:8080/ — Laravel app
- http://localhost:8080/health — Nginx health check
- http://localhost:8080/up — Laravel health check
- http://localhost:8080/metrics.php — JSON metrics

## Host networking (loopback)
- HTTP: 8080 (nginx)
- PHP-FPM: 9000
- PostgreSQL: 5432

## PostgreSQL credentials
DB: lapongdb, User: lapong, Pass: lapong, Host: 127.0.0.1 (from PHP container / host)

## Architecture
- `database/` — PostgreSQL 17 (Alpine)
- `php/` — PHP 8.4-FPM (Alpine) with Composer and PHPUnit
- `webserver/` — Nginx 1.27 (Alpine), Laravel front controller
- `src/` — Laravel 12 application (mounted to /var/www/html)
- All services use **host networking** (aligned with minimal_viable)

## Key volume mounts
- `./src` → `/var/www/html` in php and nginx containers
- `./php/tests` → `/var/www/tests` (PHPUnit infra tests)
