.PHONY: help build up down logs shell clean test test-backup backup restore crontab test-unit test-integration status

DOCKER := docker
COMPOSE := $(DOCKER) compose

help:
	@echo "Lapong Docker Development Environment (Laravel 12)"
	@echo ""
	@echo "3 containers: nginx + php-fpm + postgresql"
	@echo ""
	@echo "Commands:"
	@echo "  make build          Build Docker images"
	@echo "  make up             Start all containers"
	@echo "  make down           Stop all containers"
	@echo "  make logs           View logs"
	@echo "  make shell          Shell into container (service=php|db|webserver)"
	@echo "  make clean          Remove containers and volumes"
	@echo "  make test           Run all tests (curl + phpunit)"
	@echo "  make test-unit      Run unit tests only"
	@echo "  make test-integration  Run integration tests only"
	@echo "  make test-backup    Run backup script tests"
	@echo "  make backup         Backup database"
	@echo "  make restore        Restore database (file=<backup>)"
	@echo "  make crontab        Install crontab jobs"
	@echo "  make status         Show running containers"

build:
	$(COMPOSE) build --build-arg PHP_VERSION=8.4

up:
	$(COMPOSE) up -d

down:
	$(COMPOSE) down

logs:
ifdef service
	$(COMPOSE) logs $(service)
else
	$(COMPOSE) logs
endif

shell:
	@if [ -z "$(service)" ]; then \
		echo "Usage: make shell service=<db|php|webserver>"; \
		exit 1; \
	fi
	@case "$(service)" in \
		db) container="lapong-postgresql-container";; \
		php) container="lapong-php-fpm-container";; \
		webserver) container="lapong-nginx-container";; \
		*) echo "Invalid service: $(service)"; exit 1;; \
	esac
	$(DOCKER) exec -it $$container /bin/sh

clean:
	$(COMPOSE) down -v

status:
	$(COMPOSE) ps

test:
	@echo "Testing endpoints..."
	@curl -sf http://localhost:8080/ > /dev/null && echo "OK: /"
	@curl -sf http://localhost:8080/health > /dev/null && echo "OK: /health"
	@curl -sf http://localhost:8080/up > /dev/null && echo "OK: /up"
	@curl -sf http://localhost:8080/metrics.php > /dev/null && echo "OK: /metrics.php"
	@$(DOCKER) exec lapong-postgresql-container pg_isready -U lapong -d lapongdb && echo "OK: db"
	@echo ""
	@echo "Running PHPUnit tests..."
	@$(COMPOSE) run --rm php php /usr/local/bin/phpunit --configuration /var/www/phpunit.xml.dist

test-unit:
	@$(COMPOSE) run --rm php php /usr/local/bin/phpunit --configuration /var/www/phpunit.xml.dist --testsuite=Unit

test-integration:
	@$(COMPOSE) run --rm php php /usr/local/bin/phpunit --configuration /var/www/phpunit.xml.dist --testsuite=Integration

test-backup:
	@bash backup/test_backup.sh

backup:
	@bash backup/backup.sh

restore:
	@bash backup/restore.sh $(file)

crontab:
	@echo "Installing crontab..."
	@cat crontab.txt | crontab -
	@echo "Done. Crontab installed:"
	@crontab -l
