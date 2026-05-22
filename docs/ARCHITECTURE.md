# Architecture

Lapong Docker development environment for Laravel + PostgreSQL.

---

## System Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                         HOST MACHINE                            │
│                      (macOS / Linux / Windows)                  │
│                                                                 │
│   127.0.0.1:8080 ─────── nginx webserver                        │
│   127.0.0.1:9090 ─────── php-fpm (debug port)                   │
│   127.0.0.1:2345 ─────── postgresql (direct access)             │
│                                                                 │
│   ┌──────────────────────────────────────────────────────────┐  │
│   │              Docker Network (app-network)                │  │
│   │                                                          │  │
│   │   ┌──────────────┐     ┌──────────────┐    ┌───────────┐ │  │
│   │   │    nginx     │───▶│  php-fpm     │──▶ │postgres   │ │  │
│   │   │  container   │     │  container   │    │ container │ │  │
│   │   └──────────────┘     └──────────────┘    └───────────┘ │  │
│   └──────────────────────────────────────────────────────────┘  │
│                                                                 │
│   ./src ──────────────────────────▶ /var/www/html (volume)      │
│   ./src/public ───────────────────▶ /var/www/html/public:ro    │
│   ./database/data ────────────────▶ /var/lib/postgresql/data    │
└─────────────────────────────────────────────────────────────────┘
```

---

## Services

### Web Server (nginx)

| Property | Value |
|----------|-------|
| Image | nginx:1.27-alpine |
| Container | nginx-container |
| Host Port | 8080 |
| Container Port | 80 |
| Configuration | webserver/nginx/default.conf |
| Health Check | HTTP GET / |

### PHP Processor (php-fpm)

| Property | Value |
|----------|-------|
| Image | php:8.4-fpm-alpine |
| Container | php-fpm-container |
| Host Port | 9090 |
| Container Port | 9000 |
| Volume Mount | ./src → /var/www/html |
| Extensions | pgsql, pdo, pdo_pgsql |

### Database (PostgreSQL)

| Property | Value |
|----------|-------|
| Image | postgres:17-alpine |
| Container | postgresql-container |
| Host Port | 2345 |
| Container Port | 5432 |
| Volume Mount | `./database/data` → `/var/lib/postgresql/data` |
| Health Check | pg_isready |

---

## Health Checks

| Service | Check Method | Interval | Timeout | Retries |
|---------|--------------|----------|---------|---------|
| db | pg_isready | 10s | 5s | 5 |
| php | pg_isready (via network) | 10s | 5s | 3 |
| webserver | wget -qO- | 10s | 5s | 3 |

Services with `depends_on` wait for health checks via `condition: service_healthy`.

---

## Network Architecture

Custom bridge network `app-network` with DNS via container names:
- `postgresql-container` (db service)
- `php-fpm-container` (php service)
- `nginx-container` (webserver service)