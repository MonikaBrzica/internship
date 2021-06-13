#!/bin/sh
. /application/.docker/run/wait-for-service.sh
. /application/.docker/run/init-database.sh

# Wait until database is ready
wait_for_service "127.0.0.1" "3306"

# Set permissions for app folder
chown -R www-data:www-data /application

# Install dependencies
cd /application || exit

while  [ ! -f  "package.json" ]
do
    echo "Missing package.json"
done

if [ ! -d "node_modules" ]
then
  npm install --no-package-lock || exit
  npm run dev || exit
fi

while  [ ! -f  "composer.json" ]
do
    echo "Missing composer.json"
done

if [ ! -d "vendor" ]
then
  composer install || exit
fi

initialize_databases

# Start application
php-fpm -F -R
