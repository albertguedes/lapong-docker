# User Manual

## Quick Start

```bash
# 1. Clone and enter directory
git clone https://github.com/albertguedes/lapong-docker.git
cd lapong-docker

# 2. Build and start
make build && make up

# 3. Verify
curl http://localhost:8080/
```

## Services

| Service | Port | Description |
|---------|------|-------------|
| nginx | 8080 | HTTP server |
| php-fpm | 9090 | PHP FastCGI (debug) |
| postgresql | 2345 | Database |

## Common Commands

```bash
make up          # Start containers
make down        # Stop containers
make build       # Rebuild images
make logs         # View logs
make shell        # Shell into container (service=php|db|webserver)
make clean        # Remove everything
make test         # Run tests
make backup       # Backup database
make restore      # Restore database (file=<backup>)
```

## Laravel Commands

```bash
make shell service=php
cd /var/www/html
./dockli php artisan <command>
./dockli composer <command>
```

## Endpoints

| URL | Description |
|-----|-------------|
| http://localhost:8080/ | Laravel app |
| http://localhost:8080/health | Health check |
| http://localhost:8080/index.php | PHP info |
| http://localhost:8080/metrics.php | JSON metrics |

## Backup & Restore

```bash
# Create backup
make backup

# Restore from backup
make restore file=backup/postgresql_20260521_120000.sql.gz
```

## Troubleshooting

**Services won't start:**
```bash
docker compose ps
make logs
cat .env
```

**Database connection fails:**
```bash
make shell service=php
pg_isready -h postgresql-container -U lapong
```