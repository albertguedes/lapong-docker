# Architecture

Technical documentation for Lapong Docker (Laravel 12 + PostgreSQL, v0.10.1).

---

## Overview

Three services run on the host network: **nginx** (HTTP), **PHP-FPM** (Laravel), and **PostgreSQL** (data). Nginx serves Laravel from `/var/www/html/public` and forwards PHP to FastCGI on `127.0.0.1:9000`. PHP and Laravel connect to PostgreSQL on `127.0.0.1:5432`.

Only **Docker** and **Make** are required on the host; Composer, PHPUnit, and Artisan run inside the PHP image.

This stack follows the **minimal_viable** template (host networking, Makefile, backup/CI patterns) with Laravel-specific nginx and `src/` layout.

---

## System Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                         HOST MACHINE                            │
│                                                                 │
│   127.0.0.1:8080  ── nginx (lapong-nginx-container)             │
│                         │ fastcgi_pass 127.0.0.1:9000           │
│                         ▼                                       │
│   127.0.0.1:9000  ── PHP-FPM (lapong-php-fpm-container)         │
│                         │ Laravel / PDO → 127.0.0.1:5432        │
│                         ▼                                       │
│   127.0.0.1:5432  ── PostgreSQL (lapong-postgresql-container)    │
│                                                                 │
│   ./src ──────────────────────▶ /var/www/html (php + nginx)     │
│   ./database/data ────────────▶ /var/lib/postgresql/data        │
└─────────────────────────────────────────────────────────────────┘
```

All services use **`network_mode: host`**. Compose `ports:` mappings are not used.

---

## Services

### 1. Web Server (nginx)

| Property | Value |
|----------|-------|
| Image | nginx:1.27-alpine |
| Container | lapong-nginx-container |
| Listen | `127.0.0.1:8080` |
| Document root | `/var/www/html/public` |
| Dockerfile | `webserver/Dockerfile` |

**Laravel routing:** `try_files` → `index.php`; inline `/health` (nginx only).

### 2. PHP Processor (php-fpm)

| Property | Value |
|----------|-------|
| Image | php:8.4-fpm-alpine (8.2/8.3 via build arg) |
| Container | lapong-php-fpm-container |
| Dockerfile | `php/Dockerfile` (build context: repository root) |
| Tools | Composer, PHPUnit 11 |

**Volumes:** `./src`, `./php/phpunit.xml.dist`, `./php/tests`

### 3. Database (PostgreSQL)

| Property | Value |
|----------|-------|
| Image | postgres:17-alpine |
| Container | lapong-postgresql-container |
| Defaults | `lapongdb` / `lapong` / from `.env` |

---

## Network

| From | To | Address |
|------|-----|---------|
| Browser | nginx | `http://127.0.0.1:8080` |
| nginx | PHP-FPM | `127.0.0.1:9000` |
| PHP / Laravel | PostgreSQL | `127.0.0.1:5432` |

Laravel `src/.env`: `DB_HOST=127.0.0.1`, `DB_PORT=5432`.

---

## Endpoints

| URL | Handler |
|-----|---------|
| `/` | Laravel welcome |
| `/up` | Laravel health |
| `/health` | Nginx static OK |
| `/metrics.php` | JSON metrics (uses `POSTGRES_*` env) |

---

## Build context

| Service | Context | Dockerfile |
|---------|---------|------------|
| database | `./database/` | `Dockerfile` |
| php | `.` | `php/Dockerfile` |
| webserver | `./webserver/` | `Dockerfile` |

`.dockerignore` excludes `src/vendor` and `src/node_modules` from image builds.

---

## CI/CD

| Workflow | Trigger |
|----------|---------|
| `ci.yml` | push/PR to `master` |
| `cd.yml` | tag `v*` |

---

## Differences from minimal_viable

| Area | minimal_viable | lapong_docker |
|------|----------------|---------------|
| Application | Plain PHP in `src/` | Laravel 12 in `src/` |
| Nginx root | `/var/www/html` | `/var/www/html/public` |
| DB defaults | `dockerdb` / `docker` | `lapongdb` / `lapong` |
| Container prefix | `mv-` | `lapong-` |
| PHPUnit | Demo PHP endpoints | Laravel `/up`, `/metrics.php` |
