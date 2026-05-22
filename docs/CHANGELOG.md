# Changelog

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