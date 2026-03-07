ARG PHP_VERSION=8.4
FROM php:${PHP_VERSION}-fpm

# Встановлення системних залежностей
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libpq-dev libzip-dev supervisor \
    && docker-php-ext-install intl opcache pdo pdo_mysql zip

# Змінюємо UID/GID для існуючого користувача www-data
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data


RUN mkdir -p /var/log/supervisor /var/run/supervisor && \
    chown -R www-data:www-data /var/log/supervisor /var/run/supervisor
    
# Встановлення Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копіюємо конфігурацію Supervisor
COPY docker/php/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

# Встановлюємо права на робочу директорію
RUN chown -R www-data:www-data /var/www/html

# Перемикаємося на www-data
USER www-data

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
