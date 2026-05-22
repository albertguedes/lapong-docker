# Changelog

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

### Preserved
- src/ - Laravel application
- src/dockli - Laravel artisan/composer wrapper