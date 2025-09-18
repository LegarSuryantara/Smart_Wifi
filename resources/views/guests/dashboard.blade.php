<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Alief Smart Wifi</title>
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="image/profile.jpg" alt="profile" width="40" class="rounded-circle me-2">
                Alif Smart Wifi
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#paket-internet">Paket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#informasi">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang-kami">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sosial-media">Hubungi Kami</a>
                    </li>
                    
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item ms-lg-2">
                                <a href="{{ auth()->user()->hasAnyPermission('admin-access') ? route('admin.index') : route('user.index') }}" class="btn btn-outline-primary">
                                    Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item ms-lg-2 mb-2 mb-lg-0">
                                <a href="{{ route('login') }}" type="button" class="btn btn-primary w-100">
                                    Log in
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item ms-lg-2">
                                    <a href="{{ route('register') }}" type="button" class="btn btn-danger w-100">
                                        Daftar Sekarang
                                    </a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <section class="hero-section">

        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-7 offset-lg-5 text-center text-lg-start">
                    <h1>Selamat Datang di Era Internet Ngebut...</h1>
                    <h2>Apapun aktivitas digitalmu streaming film 4K, meeting online, atau push rank pastikan koneksi WiFi kami yang jadi andalanmu</h2>
                </div>
            </div>
        </div>

        <div class="animated-cards-container">
            <div class="animated-card-wrapper">
                @for ($i = 0; $i < 2; $i++) 
                    <div class="feature-card">
                        <i class="fas fa-globe"></i>
                        <div class="text-content">
                            <span class="title">Unlimited</span>
                            <span class="description">Nikmati internetan tanpa batas</span>
                        </div>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-credit-card"></i>
                        <div class="text-content">
                            <span class="title">Kemudahan Pembayaran</span>
                            <span class="description">Pembayaran bisa lewat mana saja</span>
                        </div>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-user-shield"></i>
                        <div class="text-content">
                            <span class="title">Privasi Pelanggan</span>
                            <span class="description">Keamanan wifi terjamin</span>
                        </div>
                    </div>
                    @endfor
            </div>
        </div>
    </section>

    <section id="paket-internet" class="package-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
            <h2 class="fw-bold">Pilihan Paket Internet Terbaik</h2>
            <p class="text-muted">Temukan paket yang paling sesuai dengan kebutuhan Anda.</p>
            </div>
            <div class="row">
                @foreach($pakets as $paket)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-center h-100 shadow">
                        <div class="card-header bg-primary text-white">
                            <h3 class="h4 mb-0">{{ $paket['nama_paket'] }}</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Kecepatan Internet</p>
                            <p class="h2 fw-bold text-primary">{{ $paket['kecepatan'] }}</p>
                            <p class="text-muted mt-3">Harga Bulanan</p>
                            <p class="h3 fw-bold">Rp {{ number_format($paket['harga'], 0, ',', '.') }}</p>
                            <p class="badge bg-success">Unlimited</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg w-100">
                                Berlangganan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>

<footer class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div id="alamat" class="col-lg-4 col-md-6 mb-4">
                <h5>Alamat</h5>
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15795.74839818817!2d114.358296!3d-8.209192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd145f4702f3a69%3A0x33355348d28a3473!2sBanyuwangi%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1663412345678!5m2!1sen!2sid" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            
            <div id="informasi" class="col-lg-4 col-md-6 mb-4">
                <h5>Informasi</h5>
                <ul class="list-unstyled">
                    <li><p><i class="fa-solid fa-phone me-2"></i>+6285730902001</p></li>
                    <li><p><i class="fa-solid fa-envelope me-2"></i>Faturalief15@gmail.com</p></li>
                    <li><p><i class="fa-solid fa-location-dot me-2"></i>Perumahan Pakis Kalirejo Blok N no 1</p></li>
                </ul>
            </div>

            <div id="sosial-media" class="col-lg-4 col-12 mb-4">
                <h5>Sosial Media</h5>
                <ul class="list-unstyled">
                    <li><p><i class="fa-brands fa-telegram me-2"></i>085730902001</p></li>
                    <li><p><i class="fa-brands fa-facebook me-2"></i>faturalief17</p></li>
                    <li><p><i class="fa-brands fa-twitter me-2"></i>aliefcahyono15</p></li>
                    <li><p><i class="fa-brands fa-instagram me-2"></i>aliefchn203</p></li>
                </ul>
            </div>
        </div>
        <div class="text-center pt-3 border-top border-secondary">
            <p>© {{ date('Y') }} Alif Smart Wifi. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>