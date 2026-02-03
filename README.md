git clone https://github.com/yourusername/book-author-management.git
cd book-author-management

composer install


cp .env.example .env

php artisan key:generate

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_author_db
DB_USERNAME=root
DB_PASSWORD=your_password


CREATE DATABASE book_author_db;