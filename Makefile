export PROJECT_IP = 127.0.0.1
export PROJECT_NAME = globalsoft-mvc

DOCKER_COMPOSE = docker-compose
SYMFONY_CONSOLE = docker exec globalsoft-mvc-php php bin/console
PHP = docker exec -it globalsoft-mvc-php

.PHONY: start
start:  ##@development bring up dev environment
	$(DOCKER_COMPOSE) up

.PHONY: stop
stop:   ##@development bring down dev environment
	$(DOCKER_COMPOSE) down

.PHONY: setup
setup:
	$(DOCKER_COMPOSE) build
	$(DOCKER_COMPOSE) up

.PHONY: run-migrations
run-migrations:
	$(SYMFONY_CONSOLE) doctrine:migrations:migrate --no-interaction

.PHONY: clear-cache
clear-cache:
	$(SYMFONY_CONSOLE) cache:clear

.PHONY: seed
seed:
	$(SYMFONY_CONSOLE) doctrine:fixtures:load --no-interaction

.PHONY: recreate-database
recreate-database:
	$(SYMFONY_CONSOLE) doctrine:database:drop --force
	$(SYMFONY_CONSOLE) doctrine:database:create
	$(SYMFONY_CONSOLE) doctrine:migrations:migrate --no-interaction
	$(SYMFONY_CONSOLE) doctrine:fixtures:load --no-interaction

.PHONY: composer-install
composer-install:
	$(PHP) composer install
