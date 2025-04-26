# Smart WiFi Management System - Laravel

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![Breeze](https://img.shields.io/badge/Laravel_Breeze-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Spatie](https://img.shields.io/badge/Spatie-4A154B?style=for-the-badge)

## 📝 Deskripsi Sistem
Sistem manajemen WiFi berbasis web yang dibangun dengan Laravel untuk mengelola:
- User management dengan autentikasi
- Role-based access control
- Manajemen paket WiFi

## 🛠️ Teknologi Utama
- **Framework**: Laravel 12
- **Database**: MySQL/MariaDB
- **Autentikasi**: Laravel Breeze
- **Authorization**: Spatie 

## 🚀 Panduan Instalasi

### Prasyarat
- PHP 8.1+
- Composer 2.5+
- Node.js 18+
- Database server (MySQL 8+/MariaDB 10.6+)

### Langkah-langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/LegarSuryantara/Smart_Wifi.git
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Konfigurasi Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Setup Database**
- Buat database baru di MySQL/MariaDB
- Update konfigurasi di `.env`:
```ini
DB_DATABASE=smart_wifi
DB_USERNAME=root
DB_PASSWORD=
```

5. **Migrasi Database**
```bash
 php artisan migrate:fresh --seed
```

6. **Setup Storage Link**
```bash
php artisan storage:link
```

7. **Build Assets**

jalanakan ini secara berkala:
```bash
npm run build
```

-------------

```bash
npm run dev  -(optional)-
```

8. **Jalankan Aplikasi**
```bash
php artisan serve
```

 ## *Jangan lupa untuk melakukan pull berkala tiap kali ada perubahan.*

## 🔐 Akun Default Utama
**Admin**
- Email: admin@wifi.com
- Password: administrator_default

**User Biasa**
- Email: user@wifi.com
- Password: user_default

## 🏗️ Struktur Projek
```
smart_wifi/
├── app/
│   ├── Models/         # Model database
│   ├── Http/          # Controller & Middleware
│   └── Providers/     # Service providers
├── config/            # File konfigurasi
├── database/          # Migrasi & seeder
├── public/            # Assets publik
├── resources/         # View & assets frontend
├── routes/            # Definisi route
└── tests/             # Unit testing
```

## 🧑‍💻 Panduan Kontribusi

### Aturan Umum
1. Buat branch baru untuk setiap fitur

2. Commit message yang jelas:

3. Lakukan pull request ke branch main

### Workflow Tim
1. **Sebelum memulai**:
   - Pull perubahan terbaru
   - Diskusikan fitur besar di grup

2. **Selama pengembangan**:
   - Update dokumentasi jika diperlukan
   - Tulis unit test untuk fitur baru

3. **Setelah selesai**:
   - Lakukan testing menyeluruh
   - Buat PR dan minta review
   - Merge setelah disetujui pereview

## 🐛 Troubleshooting

**Masalah Cache**
```bash
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

**Error Migrasi**
```bash
php artisan migrate:fresh --seed
```

**Asset tidak muncul**
```bash
npm run build
php artisan storage:link
```

---

**Tim Pengembang**  
[Tim Smart WiFi] - © 2025