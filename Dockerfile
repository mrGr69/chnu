# Используем официальный образ PHP с Apache
FROM php:8.0-apache

# Копируем все файлы из вашего локального проекта в контейнер
COPY ./ /var/www/html/

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install mysqli

# Открываем порт 80 для доступа к веб-серверу
EXPOSE 80
