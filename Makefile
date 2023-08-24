MAKEFLAGS += --silent
SHELL := /bin/bash

start:
	docker-compose up -d

stop:
	docker-compose stop

bash: ##Executes bash command and jumps into the container
	docker-compose exec web bash

build:
	docker-compose build