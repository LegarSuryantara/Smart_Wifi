Langkah langkah menjalankan projek Smart_Wifi
Ketikan perintah-perintah berikut di terminal

git clone : Untuk Menduplikasi projek

composer install : digunakan untuk menginstall semua dependesi laravel. Jangan lupa masuk ke dalam projek laravel yang sudah kita clone sebelumnya "cd Smart_Wifi"

cp .env.example .env : digunakan untuk membuat file konfigurasi .env

php artisan key:generate : Membuat kunci enkripsi untuk aplikasi Laravel

buat database mysql dengan nama "Smart_Wifi"

php artisan migrate, php artisan db:seed : ketikan perintah tersebut untuk membuat dan mengsi tabel

php artisan serve : menjalankan laravel
