FROM richarvey/nginx-php-fpm:1.9.1

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1