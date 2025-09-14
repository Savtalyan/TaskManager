# Project Makefile for Laravel + Orchid Task Manager

# Colors for output
RED=\033[0;31m
GREEN=\033[0;32m
YELLOW=\033[1;33m
NC=\033[0m # No Color

# Default target
.DEFAULT_GOAL := help

# Help target
help: ## Show this help message
	@echo "$(GREEN)Task Manager - Available Commands:$(NC)"
	@echo ""
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  $(YELLOW)%-15s$(NC) %s\n", $$1, $$2}'

# Initial setup
first: ## First time setup - build and start containers
	@echo "$(GREEN)🚀 Starting first-time setup...$(NC)"
	docker compose build --no-cache
	docker compose up -d
	@echo "$(GREEN)✅ Setup complete! Access the application at http://localhost:8080$(NC)"
	@echo "$(YELLOW)📝 Admin credentials: admin@admin.com / password$(NC)"

# Start containers
up: ## Start all containers
	@echo "$(GREEN)🚀 Starting containers...$(NC)"
	docker compose up -d
	@echo "$(GREEN)✅ Containers started!$(NC)"

# Stop containers
down: ## Stop all containers
	@echo "$(YELLOW)🛑 Stopping containers...$(NC)"
	docker compose down
	@echo "$(GREEN)✅ Containers stopped!$(NC)"

# Stop and remove volumes
kill: ## Stop containers and remove volumes
	@echo "$(RED)💥 Stopping containers and removing volumes...$(NC)"
	docker compose down -v
	@echo "$(GREEN)✅ Containers stopped and volumes removed!$(NC)"

# Generate application key
keygen: ## Generate Laravel application key
	@echo "$(YELLOW)🔑 Generating application key...$(NC)"
	docker compose exec app php artisan key:generate
	@echo "$(GREEN)✅ Application key generated!$(NC)"

# Rebuild from scratch
reset: ## Complete reset - rebuild and restart everything
	@echo "$(RED)🔄 Resetting everything...$(NC)"
	docker compose down -v
	docker compose build --no-cache
	docker compose up -d
	@echo "$(GREEN)✅ Reset complete!$(NC)"

# Access container bash
bash: ## Access app container bash
	@echo "$(YELLOW)🐚 Accessing container bash...$(NC)"
	docker compose exec app /bin/bash

# Run migrations
migrate: ## Run database migrations
	@echo "$(YELLOW)📂 Running migrations...$(NC)"
	docker compose exec app php artisan migrate
	@echo "$(GREEN)✅ Migrations completed!$(NC)"

# Seed database
seed: ## Seed database with sample data
	@echo "$(YELLOW)🌱 Seeding database...$(NC)"
	docker compose exec app php artisan db:seed
	@echo "$(GREEN)✅ Database seeded!$(NC)"

# Clear caches
clear: ## Clear all caches
	@echo "$(YELLOW)🧹 Clearing caches...$(NC)"
	docker compose exec app php artisan config:clear
	docker compose exec app php artisan cache:clear
	docker compose exec app php artisan route:clear
	docker compose exec app php artisan view:clear
	@echo "$(GREEN)✅ Caches cleared!$(NC)"

# Install dependencies
install: ## Install PHP and Node dependencies
	@echo "$(YELLOW)📦 Installing dependencies...$(NC)"
	docker compose exec app composer install
	docker compose exec app npm install
	@echo "$(GREEN)✅ Dependencies installed!$(NC)"

# Build assets
build: ## Build frontend assets
	@echo "$(YELLOW)🔨 Building assets...$(NC)"
	docker compose exec app npm run build
	@echo "$(GREEN)✅ Assets built!$(NC)"

# Show logs
logs: ## Show container logs
	docker compose logs -f

# Show app logs
app-logs: ## Show application logs
	docker compose exec app tail -f storage/logs/laravel.log

# Database operations
db-reset: ## Reset database (migrate fresh + seed)
	@echo "$(RED)🗑️  Resetting database...$(NC)"
	docker compose exec app php artisan migrate:fresh --seed
	@echo "$(GREEN)✅ Database reset complete!$(NC)"

# Status check
status: ## Show container status
	@echo "$(GREEN)📊 Container Status:$(NC)"
	docker compose ps

# Quick setup for development
dev: ## Quick development setup
	@echo "$(GREEN)🛠️  Setting up development environment...$(NC)"
	make up
	sleep 10
	make migrate
	make seed
	@echo "$(GREEN)✅ Development environment ready!$(NC)"
	@echo "$(YELLOW)🌐 Access: http://localhost:8080$(NC)"
	@echo "$(YELLOW)👤 Admin: admin@admin.com / password$(NC)"
