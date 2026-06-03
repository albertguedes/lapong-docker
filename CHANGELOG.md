# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.10.0] - 2026-06-03

### Added

- **Dual API Architecture**
  - Laravel API on port 8001 (`/laravel/*`)
  - Lumen API on port 8002 (`/lumen/*`)
  - Main gateway on port 8080 with routing to both APIs

- **JWT Authentication - Laravel**
  - Registration endpoint (`POST /api/register`)
  - Login endpoint (`POST /api/login`)
  - Protected routes: me, refresh, logout
  - JWT tokens with configurable TTL
  - `tymon/jwt-auth` package integration

- **JWT Authentication - Lumen**
  - Registration endpoint (`POST /api/v1/auth/register`)
  - Login endpoint (`POST /api/v1/auth/login`)
  - Protected routes: me, refresh, logout
  - JWT tokens with 60-minute TTL
  - `tymon/jwt-auth` package integration

- **Lumen API Structure**
  - `App\Models\User` model with JWT subject interface
  - `App\Http\Controllers\Api\V1\AuthController`
  - `App\Http\Middleware\Authenticate` middleware
  - Auth config with JWT guard
  - Database config for PostgreSQL

- **Testing Infrastructure**
  - Pest PHP testing framework on Laravel
  - `Tests\Feature\AuthApiTest` with 7 test cases
  - Integration tests for register, login, protected routes, token refresh, logout

### Changed

- **Nginx Configuration**
  - Multi-port setup (8080, 8000, 8001, 8002)
  - Dedicated server blocks for Laravel and Lumen
  - Proper PATH_INFO handling for Laravel routing
  - Static assets caching with 1-year expiry

- **Environment Configuration**
  - Separate `.env` files for Laravel and Lumen
  - `lapong_testdb` database for Lumen
  - JWT secrets with proper key length (256+ bits)

- **Gitignore Updates**
  - Ignore `src/laravel/vendor/`
  - Ignore `src/lumen/vendor/`
  - Ignore `src/lumen/storage/logs/*.log`
  - Ignore `src.laravel.backup/`

### Fixed

- Lumen Dotenv loading issue (using `Dotenv::createImmutable()`)
- JWT secret key length requirement (HS256 requires 256+ bits)
- Auth guard configuration (missing `providers` array)
- Model namespace in auth config (`App\User` → `App\Models\User`)

## [0.9.2] - 2025-01-15

### Added

- Laravel 12.x complete installation
- Container naming refactor (`lapong-*` prefix)
- Backup and restore scripts
- Metrics endpoint (`/metrics.php`)
- Fail2ban configuration

### Changed

- PostgreSQL 17 (Alpine-based)
- Nginx 1.27
- PHP 8.4
- Host networking alignment with minimal_viable

## [0.9.1] - 2025-01-10

### Added

- Backup script with rsync support
- Metrics collection (db size, connections, PHP info)
- CI/CD GitHub Actions workflow
- Hadolint and Trivy security scanning

## [0.9.0] - 2025-01-05

### Added

- Initial project setup
- Docker Compose with nginx, PHP-FPM, PostgreSQL
- Laravel application skeleton
- Node.js, Vite, Tailwind CSS stack
- jQuery + Alpine.js alternative stack