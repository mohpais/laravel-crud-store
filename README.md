# Cara menggunakan aplikasi

### 1. Spesifikasi teknologi:
- Laravel 8
- PHP 7.x
- Composer.

### 2. Clone project

    Pertama clone terlebih dahulu project laravel pada github: https://github.com/mohpais/laravel-crud-store.git dengan menggunakan script dibawah:

> `$ git clone https://github.com/mohpais/laravel-crud-store.git`

    Buka direktori project menggunakan CMD lalu Install package menggunakan

>`$ cd <folder_name>`

> `$ composer install`

    Copy file .env.example yang terdapat di dalam folder, lalu paste dan rename menjadi .env saja. 

    Kemudian set konfigurasi database dan sesuaikan dengan database local seperti nama database, db user, dll. 

    Lalu jalankan script dibawah ini untuk mereset konfigurasi sebelumnya menggunakan terminal dengan pastikan direktorinya mengarah pada project.

> `$ php artisan config:cache`

    Lalu jalankan script dibawah ini untuk menggenerate APP_KEY baru pada file .env.

> `$ php artisan key:generate`

    Dan jalankan program menggunakan

> `$ php artisan serve`

    Jalankan script dibawah ini utnuk membuat table yang diperlukan:

> `$ php artisan migrate`

    Buatlah sebuah akun pada menu register (bukan untuk akun admin) untuk dapat mengakses website secara penuh atau jalankan script dibawah ini untuk membuat fake user

> `$ php artisan db:seed --class=CreateUsersSeeder`

    Lalu untuk login pada gunakan akun ini:
    1. Admin:
       Username: admin_store
       Password: 123456
    2. Guest:
       Username: guest_1
       Password: 123456

    Dalam project ini dibutuhkan data produk untuk data pengorderan, buat sebuah produk menggunakan akun admin di atas di menu product, atau jalankan script dibawah ini untuk membuat fake produk:

> `$ php artisan db:seed --class=CreateProductsSeeder`



















