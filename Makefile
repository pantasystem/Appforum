UID := $(shell id -u)
GID := $(shell id -g)
USER := $(UID):$(GID)
DOCKER_COMPOSE := user=$(USER) docker-compose


.PHONY: init
init:
	$(DOCKER_COMPOSE) up -d --build
	$(DOCKER_COMPOSE) exec php composer install
	$(DOCKER_COMPOSE) exec php cp .env.example .env
	$(DOCKER_COMPOSE) exec php php artisan key:generate
	$(DOCKER_COMPOSE) exec php php artisan migrate

.PHONY: up
up:
	$(DOCKER_COMPOSE) up -d

.PHONY: down
down:
	$(DOCKER_COMPOSE) down

.PHONY: rm
rm:
	$(DOCKER_COMPOSE) down --rmi all

.PHONY: logs
logs:
	$(DOCKER_COMPOSE) logs -f

.PHONY: shPHP
shPHP:
	$(DOCKER_COMPOSE) exec php /bin/bash

.PHONY: shDB
shDB:
	$(DOCKER_COMPOSE) exec db /bin/bash

.PHONY: runTest
runTest:
	$(DOCKER_COMPOSE) exec php ./vendor/bin/phpunit

.PHONY: seed
seed:
	$(DOCKER_COMPOSE) exec php php artisan migrate:fresh --seed