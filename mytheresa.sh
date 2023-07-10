#!/usr/bin/env bash
echo "Setting up env file"
cp ./mytheresa/.env.example ./mytheresa/.env

echo "Starting docker containers"
cd docker/dev
docker-compose up -d --build

echo "Installing composer dependencies"
docker exec mytheresa php composer.phar install

echo "Populating Database"
sleep 10
docker exec mytheresa php artisan migrate;
docker exec mytheresa php artisan db:seed --class=DiscountSeeder;
docker exec mytheresa php artisan db:seed --class=CategorySeeder;
docker exec mytheresa php artisan db:seed --class=ProductSeeder;
