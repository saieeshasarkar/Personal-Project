#!/usr/bin/env bash
echo "Running composer"
# composer global require kreait/firebase-php:6.9.6
composer global require kreait/firebase-php:6.1.0
# composer global require "kreait/firebase-php:^7.0" 
# composer global require kreait/firebase-php:7.10.0
composer install --no-dev --working-dir=/var/www/html
conf/nginx/nginx-site.conf
# composer update
#composer install
# conf/nginx/nginx-site.conf
# #!/usr/bin/env bash
# echo "Running composer"
# cp /etc/secrets/.env .env
# composer global require hirak/prestissimo
# composer install --no-dev --working-dir=/var/www/html

# echo "Clearing caches..."
# php artisan optimize:clear

# echo "Caching config..."
# php artisan config:cache

# echo "Caching routes..."
# php artisan route:cache

# echo "Running migrations..."
# php artisan migrate --force

 echo "done deploying"
