# Simple Api Quiz

## Requirements
- PHP Version >= 7.2
- MySQL Version 8
- Composer (Dependency Manager)
- Docker && docker-compose

## Installation
```bash
git clone https://github.com/alifjafar/api-quiz.git .
cp .env.example .env && nano .env
```

## Deployment
```bash
# Compile environment
docker-compose build app

# Run environment
docker-compose up -d

# Install dependency package
docker-compose exec app composer install

# Generate application key
docker-compose exec app php artisan key:generate

# Run Migrations
docker-compose exec app php artisan migrate:fresh --seed
```
