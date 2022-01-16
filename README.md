Cài đặt mysql workbench theo đường link : https://dev.mysql.com/downloads/workbench/

Tiếp theo cần cài đặt composer với câu lệnh

composer install


Tạo key cho ứng dụng với câu lệnh

php artisan generate:key

Cấu hình môi trường cho ứng dụng qua file .env

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=warehouse

DB_USERNAME=root

DB_PASSWORD=

Tạo CSDL trong mysql workbench và chạy lệnh 

php artisan migrate 

để tạo các bảng cho CSDL.

Khởi tạo dữ liệu cần thiết ban đầu với câu lệnh dưới đây

php artisan db:seed

Chạy ứng dụng với câu lệnh dưới đây và bắt đầu sử dụng

php artisan serve


