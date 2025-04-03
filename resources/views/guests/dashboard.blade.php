<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Alief Smart Wifi</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
</head>
<body>
<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="image/profile.jpg" alt="profile" width="50" class="rounded-circle">
                    Alif Smart Wifi
                  </a>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#paket internet">Paket</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#informasi">Informasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Tentang Kami</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#sosial media">Hubungi Kami</a>
                  </li>
                    @if (Route::has('login'))
                        <nav class="flex items-center justify-end gap-4">
                            @auth
                                <a
                                    href="{{ auth()->user()->hasAnyRole('admin') ? route('admin.index') : route('user.index') }}"
                                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a type="button"
                                        href="{{ route('register') }}"
                                        class="btn btn-danger">
                                        Daftar Sekarang
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
        <section class="hero-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 model">
                        
                    </div>
                    <div class="col-6">
                        <h2>Mari Bergabung Bersama Kami</h2>
                        <p>Get more of what matters to you</p>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="bg-white p-4 rounded shadow">
                                    <i class="fas fa-globe mb-2"></i>
                                    <h3 class="h5 ">unlimited</h3>
                                    <p class="small font-weight-light">nikmati internetan tanpa batas</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="bg-white p-4 rounded shadow">
                                    <i class="fas fa-credit-card  mb-2"></i>
                                    <h3 class="h5">kemudahan pembayaran</h3>
                                    <p class="small font-weight-light">pembayaran bisa lewat mana saja</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="bg-white p-4 rounded shadow">
                                    <i class="fas fa-user-shield mb-2"></i>
                                    <h3 class="h5">privasi pelanggan</h3>
                                    <p class="small font-weight-light">keamanan wifi terjamin</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>  
            </section>
            <section class="package-section p-4">
                <div class="container">
                    <h2 id="paket internet">Paket Internet</h2>
                    <div class="row">
                        @foreach($pakets as $paket)
                        <div class="col-md-3 mb-4">
                            <div class="package-card text-white position-relative">
                                <h3 class="text-black">{{ $paket['nama_paket'] }}</h3>
                                <p class="text-danger price">Unlimited</p>
                                <p class="text-black">Kecepatan Internet</p>
                                <p class="text-danger price">{{ $paket['kecepatan'] }}</p>
                                <p class="text-black">Harga Bulanan</p>
                                <p class="text-danger price">Rp {{ number_format($paket['harga'], 0, ',', '.') }}</p>
                                <div class="card-footer bg-transparent">
                                    <a href="{{ route('register') }}" class="btn btn-light btn-block">
                                        Daftar untuk Berlangganan
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>
            <footer>
                <div class="container-fluid text-left">
                    <div class="row">
                    <div class="col">
                        <div class="title">
                            <h5 id="alamat">Alamat</h5>
                        </div>
                        <div class="content">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d544.3376387748079!2d114.3445059!3d-8.2492684!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd15a9a3deb8e39%3A0x690a6afba6b12d2d!2sJl.%20Nangka%20No.1%2C%20Dusun%20Jurang%20Jero%2C%20Kalirejo%2C%20Kec.%20Kabat%2C%20Kabupaten%20Banyuwangi%2C%20Jawa%20Timur%2068461!5e1!3m2!1sid!2sid!4v1742567472544!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col">
                        <div class="title">
                            <h5 id="informasi">Informasi</h5>
                        </div>
                        <div class="content">
                            <p><i class="fa-solid fa-phone"></i>+6285730902001</p>
                            <p><i class="fa-solid fa-envelope"></i>Faturalief15@gmail.com</p>
                            <p><i class="fa-solid fa-location-dot"></i>Perumahan Pakis Kalirejo Blok N no 1</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="title">
                            <h5 id="sosial media">Sosial media</h5>
                        </div>
                        <div class="content">
                            <p><i class="fa-brands fa-telegram"></i>085730902001</p>
                            <p><i class="fa-brands fa-facebook"></i>faturalief17@yahoo.com</p>
                            <p><i class="fa-brands fa-twitter"></i>aliefcahyono15@yahoo.com</p>
                            <p><i class="fa-brands fa-instagram"></i>aliefchn203</p>
                        </div>
                    </div>
                    </div>
                </div>
            </footer>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
</html>