create project
composer create-project --prefer-dist laravel/laravel .
run project 
## chay du an
php artisan serve
## create migration
php artisan make:migration add_role_to_users_table --table=users
## run migration
php artisan migrate
## create middleware
php artisan make:middleware CheckAdmin
## clearn
```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```
## create model
php artisan make:model Blog -m
## create controller
php artisan make:controller BlogController --resource
## create command and run schedule
### install laravel
composer install --ignore-platform-reqs
https://stackoverflow.com/questions/40815984/how-to-install-all-required-php-extensions-for-laravel



# View logs
docker-compose logs

# Stop containers
docker-compose down

# Rebuild containers
docker-compose up -d --build

# Access PHP container
docker-compose exec app bash

# Run artisan commands
docker-compose exec app php artisan <command>


# Build and start containers
docker-compose up -d

# Install Laravel dependencies
docker-compose exec app composer install

# Generate application key
docker-compose exec app php artisan key:generate

# Run migrations
docker-compose exec app php artisan migrate

# View logs
docker-compose logs

# Stop containers
docker-compose down

# Rebuild containers
docker-compose up -d --build

# Access PHP container
docker-compose exec app bash

# Run artisan commands
docker-compose exec app php artisan <command>