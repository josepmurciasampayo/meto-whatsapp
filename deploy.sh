#!/bin/sh
# update source code
git pull
# update PHP dependencies
composer install --no-interaction --no-dev --prefer-dist
# --no-interaction Do not ask any interactive question
# --no-dev  Disables installation of require-dev packages.
# --prefer-dist  Forces installation from package dist even for dev versions.
# update database
php artisan migrate --force
chown -R www-data *
# --force  Required to run when in production.
