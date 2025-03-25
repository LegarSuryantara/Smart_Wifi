Langkah langkah menjalankan projek Smart_Wifi
Ketikan perintah-perintah berikut di terminal

git clone : Untuk Menduplikasi projek

composer install : digunakan untuk menginstall semua dependesi laravel. Jangan lupa masuk ke dalam projek laravel yang sudah kita clone sebelumnya "cd Smart_Wifi"

npm install : lakukan setelah composer install

cp .env.example .env : digunakan untuk membuat file konfigurasi .env

php artisan key:generate : Membuat kunci enkripsi untuk aplikasi Laravel

buat database mysql dengan nama "Smart_Wifi"

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" : wajib jalankan ini karena menggunakn SPATIE

php artisan migrate:fresh : jalankan jika ingin migrasi tabelnya saja / menghapus seluruh isi dari tabel migrasi

php artisan migrate, php artisan db:seed : ketikan perintah tersebut untuk membuat dan mengsi tabel

php artisan optimize:clear : jalankan agar chace dan lainnya di kosongkan

1.npm run dev
# atau untuk production : untuk menyalakan fungsi hot reload jalankan setidaknya sekali (npm run build) agar build nya berjalan karena kita menggunakan breeze
2.npm run build : untuk production dengan fitur hot reload berfungsi juga untuk Install & Compile Frontend Assets   

-

php artisan serve : menjalankan laravel


Troubleshoot umum : 
Error Spatie Not Found:
- composer require spatie/laravel-permission



