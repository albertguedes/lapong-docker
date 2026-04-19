# LAPONG Docker

A Docker development environment with **Laravel**, **PostgreSQL**, and **Nginx** — containerized for easy local development.

## Architecture

```
┌─────────────┐
│    Nginx    │  (Port 8080)
├─────────────┤
│  PHP-FPM    │
├─────────────┤
│ PostgreSQL  │
└─────────────┘
```

Three containers connected via internal network:
- **webserver**: Nginx Alpine with persistent config
- **php**: PHP-FPM with Composer
- **db**: PostgreSQL with persistent data

## Quick Start

```bash
git clone https://github.com/albertguedes/lapong-docker.git
cd lapong-docker
docker-compose up -d
```

Access at `http://localhost:8080`

## Common Commands

```bash
# Run artisan inside PHP container
./_dockcli_ composer install
./_dockcli_ php artisan migrate
./_dockcli_ php artisan key:generate

# Shell into container
docker exec -it lapong-docker-php-1 /bin/sh
```

## Tech Stack

- Nginx (Alpine)
- PHP 8.x with Composer
- PostgreSQL (Alpine)
- Laravel

## License

MIT License - see [LICENSE](LICENSE)
