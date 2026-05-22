# TODO

## v0.9.2 - Laravel 12.x Installation ✅

- [x] Install Laravel 12.x in src/
- [x] Configure PostgreSQL connection (DB_HOST=db)
- [x] Create metrics.php endpoint
- [x] Create dockli wrapper script
- [x] Fix storage/framework permissions
- [x] Fix Makefile container names
- [x] Fix backup script container names
- [x] Update ARCHITECTURE.md network name
- [x] Update crontab.txt to use local health.sh

## v0.9.1 - Backup, Metrics & Security ✅

- [x] Add backup/restore scripts
- [x] Add backup commands to Makefile
- [x] Add crontab.txt for scheduled backups
- [x] Add metrics endpoint (/metrics.php)
- [x] Add fail2ban configuration

## v0.9.0 - Infrastructure Rebuild ✅

- [x] Migrate from docker-compose.yml to compose.yaml
- [x] Add healthchecks and depends_on conditions
- [x] Update to modern images (nginx:1.27, php:8.4, postgres:17)
- [x] Add Makefile for developer commands
- [x] Add docs (ARCHITECTURE, USER_MANUAL, CONTRIBUTING)