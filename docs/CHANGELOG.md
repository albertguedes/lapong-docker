# Changelog

## [v0.10.1] - 2026-05-22

### Changed
- Synced infrastructure with minimal_viable v0.10.1 (host networking, Dockerfile naming, backup/CI)
- Replaced bridge network + port mappings with `network_mode: host` (8080, 9000, 5432 on loopback)
- Renamed `*.dockerfile` → `Dockerfile` in database/, php/, webserver/
- PHP image: build from repo root, PHPUnit 11, `PHP_VERSION` build arg, `.dockerignore` for Laravel vendor
- Makefile: `test-unit`, `test-integration`, `test-backup`; Laravel endpoint checks in `make test`
- Backup: GPG/S3/B2/rsync support via `backup/config.sh`, `test_backup.sh`, `verify-restore.sh`
- Added `.github/workflows/ci.yml` and `cd.yml`, `VERSION`, `php/tests/` integration suite
- Nginx: listen 8080, FastCGI `127.0.0.1:9000`, mount full `./src` (Laravel `public` root unchanged)

### Added
- `AGENTS.md` updated for host networking and new make targets

### Fixed
- PHPUnit installed via Composer in PHP image (phar.phpunit.de returned 520 during build)

### Documentation
- Updated README, ARCHITECTURE, USER_MANUAL, CONTRIBUTING for host networking and test targets

### Verified
- `make test`: HTTP `/`, `/health`, `/up`, `/metrics.php`, `pg_isready` — OK
- `make test-unit`: 2 tests — OK
- `make test-integration`: 9 tests — OK

## [v0.9.5] - 2026-05-22

### Changed
- **RESTORED**: Tailwind CSS via CDN (`https://cdn.tailwindcss.com`) - page styling works again
- Removed Bootstrap 5.3.3 CDN (no longer needed for this project)
- Kept jQuery 3.7.1 + Alpine.js 3.14.8 for future interactivity

## [v0.9.4] - 2026-05-22

### Changed
- **BREAKING**: Removed NodeJS/Vite/Tailwind - no more `package.json`, `vite.config.js`
- Removed `src/resources/js/` and `src/resources/css/` (Vite asset pipeline)
- Removed `src/node_modules/` (5000+ npm vulnerability files)

### Added
- Bootstrap 5.3.3 via CDN for base styling
- jQuery 3.7.1 via CDN for DOM manipulation
- Alpine.js 3.14.8 via CDN for reactive behavior
- `public/assets/js/script.js` - Main JS initialization
- `public/assets/js/app.js` - Application JS
- `public/assets/css/style.css` - Main stylesheet
- Welcome page updated with CDN links instead of Vite

## [v0.9.3] - 2026-05-22

### Removed
- **BREAKING**: Removed `src/dockli` wrapper script - use `docker exec lapong-php-fpm-container` directly

## [v0.9.2] - 2026-05-22

### Changed
- **BREAKING**: Replaced old Laravel app with fresh Laravel 12.x installation
- Fixed container names in Makefile and backup scripts (`lapong-*` prefix)
- Fixed network name: `app-network` → `lapong-network`
- Updated nginx fastcgi_pass: `php-fpm-container` → `php`
- Updated crontab.txt health check command
- Updated docs/ARCHITECTURE.md with correct container names

### Added
- Fresh Laravel 12.x in src/ with PostgreSQL configuration
- src/public/metrics.php - JSON metrics endpoint
- src/storage and src/bootstrap/cache permissions (777)
- docs/TODO.md updated with completed items

## [v0.9.1] - 2026-05-21

### Added
- backup/backup.sh - PostgreSQL backup script with 7-day retention
- backup/restore.sh - PostgreSQL restore script with safety backup
- src/public/metrics.php - JSON metrics endpoint (db size, connections, php info)
- security/jail.local - Fail2ban configuration for nginx
- crontab.txt - Scheduled backup cron jobs
- make backup - Makefile target for database backup
- make restore - Makefile target for database restore

## [v0.9.0] - 2026-05-21

### Changed
- Infrastructure rebuilt from minimal_viable base
- docker-compose.yml → compose.yaml (V2 format)
- db/ → database/ (renamed)
- Added Makefile with developer commands
- Added healthchecks and depends_on conditions
- nginx:1.24.0 → nginx:1.27-alpine
- php:8.1.19-fpm → php:8.4-fpm-alpine
- postgres → postgres:17-alpine
- Added network: app-network

### Added
- .env and .env.example for postgres config
- webserver/nginx/nginx.conf (main nginx config)
- docs/ directory with ARCHITECTURE, USER_MANUAL, CONTRIBUTING