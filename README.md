# Lapong Docker

A production-ready Docker development environment for **Laravel 10+** applications with **PostgreSQL 17** database. Built for enterprise teams requiring consistent, isolated, and secure local development environments.

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP 8.4](https://img.shields.io/badge/PHP-8.4-blue.svg)](https://www.php.net/releases/8.4/en.php)
[![PostgreSQL 17](https://img.shields.io/badge/PostgreSQL-17-blue.svg)](https://www.postgresql.org/docs/17/)

---

## Why Lapong Docker?

| Feature | Benefit |
|---------|---------|
| **Zero Configuration** | `make build && make up` — fully operational in under 2 minutes |
| **Healthcheck-Guaranteed** | Services start only when dependencies are healthy (`depends_on` + `condition: service_healthy`) |
| **Production Mirror** | Same image versions (nginx:1.27, php:8.4, postgres:17) used in CI/CD pipelines |
| **Secrets Isolation** | Database credentials via `.env` file, never in code or Dockerfiles |
| **Network Isolation** | Custom bridge network (`app-network`) with DNS via container names |
| **Localhost-Only Ports** | All ports bound to `127.0.0.1` — no exposure to external networks |
| **Monorepo Ready** | Laravel source (`src/`) mounted as volume for real-time code iteration |

---

## Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                         HOST MACHINE                            │
│                      (127.0.0.1:8080, 2345)                     │
│                                                                 │
│   ┌──────────────────────────────────────────────────────────┐   │
│   │              Docker Network (app-network)                │   │
│   │                                                          │   │
│   │   ┌──────────────┐     ┌──────────────┐    ┌─────────┐ │   │
│   │   │  nginx:1.27  │────▶│  php:8.4     │────▶│pg:17   │ │   │
│   │   │  :8080→:80   │     │  :9090→:9000 │    │:2345→:5432│ │   │
│   │   └──────────────┘     └──────────────┘    └─────────┘ │   │
│   └──────────────────────────────────────────────────────────┘   │
│                                                                 │
│   ./src ──────────────────────────▶ /var/www/html (volume)       │
│   ./src/public ────────────────────▶ /var/www/html/public:ro     │
│   ./database/data ──────────────────▶ /var/lib/postgresql/data  │
└─────────────────────────────────────────────────────────────────┘
```

---

## Services

| Service | Image | Host Port | Container Port | Purpose |
|---------|-------|-----------|----------------|---------|
| **webserver** | nginx:1.27-alpine | 8080 | 80 | HTTP server, FastCGI proxy |
| **php** | php:8.4-fpm-alpine | 9090 | 9000 | PHP-FPM FastCGI processor |
| **db** | postgres:17-alpine | 2345 | 5432 | PostgreSQL database |

---

## Prerequisites

- Docker Engine 20.10+
- Docker Compose 2.0+
- GNU Make 3.81+

---

## Quick Start

```bash
# 1. Clone repository
git clone https://github.com/albertguedes/lapong-docker.git
cd lapong-docker

# 2. Configure environment
cp .env.example .env

# 3. Build and start
make build && make up

# 4. Verify
curl http://localhost:8080/
```

---

## Developer Commands

```bash
make help              # Show all commands
make build             # Build Docker images
make up                # Start all containers (detached)
make down              # Stop all containers
make logs              # View all logs
make logs service=db   # View specific service logs
make shell service=php # Shell into container
make test              # Run HTTP + DB tests
make clean             # Remove containers and volumes
make backup            # Backup database to backup/*.sql.gz
make restore file=<backup>  # Restore from backup
```

---

## Laravel Development

```bash
# Shell into PHP container
make shell service=php

# Inside container, run Laravel commands
cd /var/www/html
./dockli php artisan migrate
./dockli php artisan key:generate
./dockli composer require <package>
./dockli php artisan test
```

---

## Endpoints

| URL | Method | Description |
|-----|--------|-------------|
| http://localhost:8080/ | GET | Laravel application |
| http://localhost:8080/health | GET | Health check (returns "OK") |
| http://localhost:8080/metrics.php | GET | JSON metrics (db size, connections, php info) |

---

## Environment Configuration

```bash
# PostgreSQL (from .env)
POSTGRES_DB=lapongdb
POSTGRES_USER=lapong
POSTGRES_PASSWORD=lapong

# Laravel (from src/.env)
DB_CONNECTION=pgsql
DB_HOST=postgresql-container
DB_PORT=5432
DB_DATABASE=lapongdb
DB_USERNAME=lapong
DB_PASSWORD=lapong
```

---

## Project Structure

```
.
├── backup/                 # Backup/restore scripts
│   ├── backup.sh
│   └── restore.sh
├── database/                # PostgreSQL service
│   ├── postgresql.dockerfile
│   └── data/               # Persistent volume
├── docs/                   # Documentation
│   ├── ARCHITECTURE.md     # Technical architecture
│   ├── USER_MANUAL.md      # User guide
│   ├── CONTRIBUTING.md     # Contribution guidelines
│   └── CHANGELOG.md       # Version history
├── php/                    # PHP-FPM service
│   └── php.dockerfile
├── security/               # Security configs
│   └── jail.local          # Fail2ban configuration
├── src/                    # Laravel application
│   ├── public/
│   │   └── metrics.php    # JSON metrics endpoint
│   ├── .env               # Laravel configuration
│   └── dockli             # Artisan/composer wrapper
├── webserver/              # Nginx service
│   ├── nginx.dockerfile
│   └── nginx/
│       ├── nginx.conf     # Main nginx config
│       └── default.conf   # Server config
├── compose.yaml            # Docker Compose v2
├── Makefile                # Developer commands
├── crontab.txt             # Cron jobs for backups
└── .env.example            # Environment template
```

---

## Health Checks

| Service | Check | Interval | Timeout | Retries |
|---------|-------|----------|---------|---------|
| db | `pg_isready` | 10s | 5s | 5 |
| php | `pg_isready` via network | 10s | 5s | 3 |
| webserver | `wget -qO- http://localhost:80/` | 10s | 5s | 3 |

Services with `depends_on` wait for health checks via `condition: service_healthy` before starting dependents.

---

## Security

- **Network Isolation**: Custom bridge network (`lapong-network`) with DNS via container names
- **Localhost Ports**: All ports bound to `127.0.0.1` (localhost only)
- **Secrets Management**: Database credentials via `.env` file, never in code
- **Read-Only Volumes**: `src/public` mounted as `:ro` (read-only) in nginx
- **No Root Containers**: php-fpm runs as `www-data`, nginx as `nginx`

**For production deployments**, consider:
- Docker Secrets for credential management
- SSL/TLS termination via reverse proxy
- Resource limits and quotas
- Audit logging

---

## Troubleshooting

**Containers won't start:**
```bash
docker compose ps
make logs
cat .env
```

**Database connection fails:**
```bash
make shell service=php
pg_isready -h postgresql-container -U lapong -d lapongdb
```

**Port already in use:**
```bash
lsof -i :8080
```

---

## Contributing

Contributions are welcome. Please see [docs/CONTRIBUTING.md](./docs/CONTRIBUTING.md) for guidelines.

---

## License

This project is distributed under the [MIT License](./LICENSE). See [LICENSE](./LICENSE) for more information.