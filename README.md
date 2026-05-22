# Lapong Docker

A production-ready Docker development environment for **Laravel 12** applications with **PostgreSQL 17**. Based on [minimal_viable](https://github.com/albertguedes/minimal-viable-docker-development-environment) with Laravel-specific nginx and `src/` layout.

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP 8.4](https://img.shields.io/badge/PHP-8.4-blue.svg)](https://www.php.net/releases/8.4/en.php)
[![PostgreSQL 17](https://img.shields.io/badge/PostgreSQL-17-blue.svg)](https://www.postgresql.org/docs/17/)

---

## Why Lapong Docker?

| Feature | Benefit |
|---------|---------|
| **Zero Configuration** | `make build && make up` — fully operational in under 2 minutes |
| **Host-Independent** | Only Docker needed on host; Composer and PHPUnit run in containers |
| **Production Mirror** | Same image versions (nginx:1.27, php:8.4, postgres:17) used in CI/CD pipelines |
| **Secrets Isolation** | Database credentials via `.env` file, never in code or Dockerfiles |
| **Host Networking** | Services bind on loopback (8080, 9000, 5432) — aligned with minimal_viable |
| **CI/CD Ready** | GitHub Actions for tests, Hadolint, Trivy, and GHCR releases |
| **Monorepo Ready** | Laravel source (`src/`) mounted as volume for real-time code iteration |

---

## Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                         HOST MACHINE                            │
│                                                                 │
│   127.0.0.1:8080  ── nginx (lapong-nginx-container)             │
│                         │ fastcgi_pass 127.0.0.1:9000           │
│                         ▼                                       │
│   127.0.0.1:9000  ── PHP-FPM (lapong-php-fpm-container)         │
│                         ▼                                       │
│   127.0.0.1:5432  ── PostgreSQL (lapong-postgresql-container)   │
│                                                                 │
│   ./src ──────────────────────▶ /var/www/html (php + nginx)     │
│   ./database/data ────────────▶ /var/lib/postgresql/data        │
└─────────────────────────────────────────────────────────────────┘
```

All services use **host networking** (see `compose.yaml`).

---

## Services

| Service | Image | Port (loopback) | Purpose |
|---------|-------|-----------------|---------|
| **webserver** | nginx:1.27-alpine | 8080 | HTTP server, Laravel front controller |
| **php** | php:8.4-fpm-alpine | 9000 | PHP-FPM FastCGI processor |
| **db** | postgres:17-alpine | 5432 | PostgreSQL database |

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
make test              # Run HTTP + DB + PHPUnit tests
make test-unit         # Unit tests only
make test-integration  # Integration tests only
make test-backup       # Backup script tests
make clean             # Remove containers and volumes
make backup            # Backup database to backup/*.sql.gz
make restore file=<backup>  # Restore from backup
```

---

## Laravel Development

```bash
# Run Laravel artisan commands directly
docker exec lapong-php-fpm-container php artisan <command>

# Shell into PHP container
make shell service=php
cd /var/www/html && php artisan <command>

# Run composer commands
docker exec -it lapong-php-fpm-container composer require <package>
```

---

## Endpoints

| URL | Method | Description |
|-----|--------|-------------|
| http://localhost:8080/ | GET | Laravel application |
| http://localhost:8080/health | GET | Nginx health check (returns "OK") |
| http://localhost:8080/up | GET | Laravel health check |
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
DB_HOST=127.0.0.1
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
│   ├── config.sh
│   └── restore.sh
├── database/               # PostgreSQL service
│   ├── Dockerfile
│   └── data/               # Persistent volume
├── docs/                   # Documentation
│   ├── ARCHITECTURE.md     # Technical architecture
│   ├── USER_MANUAL.md      # User guide
│   ├── CONTRIBUTING.md     # Contribution guidelines
│   └── CHANGELOG.md       # Version history
├── php/                    # PHP-FPM service
│   ├── Dockerfile
│   ├── phpunit.xml.dist
│   └── tests/
├── security/               # Security configs
│   └── jail.local          # Fail2ban configuration
├── src/                    # Laravel application
│   ├── public/
│   │   └── metrics.php    # JSON metrics endpoint
│   └── .env               # Laravel configuration
├── webserver/              # Nginx service
│   ├── Dockerfile
│   └── nginx/
│       ├── nginx.conf     # Main nginx config
│       └── default.conf   # Server config
├── compose.yaml            # Docker Compose v2
├── Makefile                # Developer commands
├── crontab.txt             # Cron jobs for backups
└── .env.example            # Environment template
```

---

## Security

- **Host networking**: Services listen on loopback (not exposed on all interfaces by default)
- **Secrets Management**: Database credentials via `.env` file, never in code
- **Read-Only Volumes**: `./src` mounted read-only in nginx
- **No Root Containers**: php-fpm runs as `www-data`
- **CI**: Hadolint on Dockerfiles, Trivy filesystem scan

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
pg_isready -h 127.0.0.1 -p 5432 -U lapong -d lapongdb
```

**Port already in use (8080, 9000, or 5432):**

Only one host-networked stack can run at a time. Stop other projects (e.g. minimal_viable) first:

```bash
make down   # in the other project
lsof -i :8080
```

---

## Contributing

Contributions are welcome. Please see [docs/CONTRIBUTING.md](./docs/CONTRIBUTING.md) for guidelines.

---

## License

This project is distributed under the [MIT License](./LICENSE). See [LICENSE](./LICENSE) for more information.