#!/bin/bash

# Update Laravel .env with MySQL service credentials
sed -i "s/DB_HOST=.*$/DB_HOST=db/g" .env
sed -i "s/DB_PORT=.*$/DB_PORT=3306/g" .env
sed -i "s/DB_DATABASE=.*$/DB_DATABASE=finance_tracker/g" .env
sed -i "s/DB_USERNAME=.*$/DB_USERNAME=root/g" .env
sed -i "s/DB_PASSWORD=.*$/DB_PASSWORD=mysql123@/g" .env

# Wait for MySQL to be ready
while ! mysqladmin ping -h"db" --silent; do
    sleep 1
done

# Run migrations and seeders
php artisan migrate --force
php artisan db:seed --force

# Keep the container running
apache2-foreground
