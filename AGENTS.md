# Agents

## Start environment
```bash
make build && make up
```
App: http://localhost:8080

## Developer Commands
```bash
make help          # Show all commands
make build         # Build Docker images
make up            # Start all containers
make down          # Stop all containers
make logs          # View all logs
make logs service=<db|php|webserver>  # View specific service logs
make shell service=<php|db|webserver>  # Shell into container
make test          # Test HTTP endpoints and DB
make clean         # Remove containers and volumes
```

## Run Laravel commands (inside php container)
```bash
cd src
./dockli php artisan <command>
./dockli composer <command>
```

## Container ports (bound to 127.0.0.1)
- nginx: 8080 → 80
- php-fpm: 9090 → 9000
- postgresql: 2345 → 5432

## PostgreSQL credentials
DB: lapongdb, User: lapong, Pass: lapong, Host: postgresql-container

## Architecture
- `database/` — PostgreSQL 17 (Alpine)
- `php/` — PHP 8.4-FPM (Alpine) with Composer
- `webserver/` — Nginx 1.27 (Alpine)
- `src/` — Laravel app source (mounted to /var/www/html in php container)
- Nginx serves static files from `src/public`; PHP-FPM handles PHP via FastCGI

## Key volume mounts
- `./src` → `/var/www/html` in php container
- `./src/public` → `/var/www/html/public:ro` in nginx container (read-only)