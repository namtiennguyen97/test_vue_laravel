<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Description
### Triển khai dự án mẫu, đã tích hợp sẵn các thành phần cơ bản
```
Module Api tích hợp Swagger doc
Module tích hợp Token Jwt
Module tích hợp công cụ xem log requset Clockwork
```


### Các bước triển khai
```
cp -rf .env.example .env
npm install
composer install
```
- Nếu chạy composer lỗi "PHP Fatal error:  Allowed memory size of ..." thì chạy lại như sau
```
COMPOSER_MEMORY_LIMIT=-1 composer install
```

### Tạo cơ sở dữ liệu sau đó sửa cấu hình cơ sở dữ liệu của các bạn trong file .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### Chạy lệnh khởi chạy ứng dụng
```
php artisan migrate
php artisan db:seed (Optional)
npm run dev
npm run watch
```

### Chỉnh sửa API_HOST trong file swagger-constants.php, nếu triển khai api lên domain khác
```
define("API_HOST", 'localhost:8000');
```

### Chạy script gen swagger mỗi lần có update doc api
```
cd development
./swagger.sh
```

### Link swagger mặc định
```
http://127.0.0.1:8000/swagger/index.html#/
```
### Link xem log resquset mặc định
```
http://127.0.0.1:8000/__clockwork/app#
```
