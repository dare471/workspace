# Используем образ PHP 8.2 с предустановленным FPM
FROM php:8.2-fpm

# Установка зависимостей для PHP и расширений
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    curl \
    unzip \
    git \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd  # Изменено с pdo_mysql на pdo_pgsql

# Установка Composer в контейнер
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копирование приложения Laravel в контейнер
COPY . /var/www

# Установка рабочей директории
WORKDIR /var/www

# Установка зависимостей через Composer
RUN composer install --no-interaction --no-plugins --no-scripts

# Открытие порта 8000 для внешних подключений к серверу
EXPOSE 8000

# Запуск Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
