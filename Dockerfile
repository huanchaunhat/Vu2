# 1. Dùng PHP 8.1 kèm Apache
FROM php:8.1-apache

# 2. Cài đặt extension bắt buộc cho MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 3. Bật chế độ Rewrite (để chạy MVC/Router)
RUN a2enmod rewrite

# 4. Copy toàn bộ code vào trong server ảo
COPY . /var/www/html/

# 5. Cấu hình để Apache trỏ thẳng vào thư mục public (nơi chứa index.php)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 6. Mở cổng 80
EXPOSE 80