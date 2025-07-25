# Project Makefile for Laravel + Orchid

# Run the Laravel container (can be docker-compose, or whatever fits)
first:
	docker compose build --no-cache && docker compose up -d

up:
	docker compose up -d

# Build the Docker image
down:
	docker compose down

kill:
	docker compose down -v

keygen:
	docker compose exec app php artisan key:generate

# Rebuild from scratch
reset:
	docker compose down -v
	docker compose build
	docker compose up -d
	make setup


make bash:
	docker exec -it app /bin/bash
