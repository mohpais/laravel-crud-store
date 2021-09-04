# Cara menggunakan aplikasi

### 1. Spesifikasi teknologi:
- Laravel 8
- PHP 7.x
- Composer.

### 2. Clone project

Pertama clone terlebih dahulu project laravel pada github: https://github.com/mohpais/laravel-crud-store.git dengan menggunakan script dibawah:

`$ git clone https://github.com/mohpais/laravel-crud-store.git`

Buka direktori menggunakan CMD lalu Install package menggunakan

`$ cd <folder_name>`

`$ composer install`

Copy file .env.example yang terdapat di dalam folder, lalu paste dan rename menjadi .env saja. 

Kemudian set konfigurasi database dan sesuaikan dengan database local seperti nama database, db user, dll. 

Lalu jalankan script dibawah ini untuk mereset konfigurasi sebelumnya menggunakan terminal dengan pastikan direktorinya mengarah pada project.

`$ php artisan config:cache`

Langkah terakhir jalankan script dibawah ini untuk menggenerate APP_KEY pada file .env.

`$ php artisan key:generate`

Dan jalankan program menggunakan

`$ php artisan serve`