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
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('profile') }}">
                    <img src="image/profile.jpg" alt="profile" width="50" class="rounded-circle">
                    Alif Smart Wifi
                  </a>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Paket</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Informasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Tentang Kami</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Hubungi Kami</a>
                  </li>
                  <li>
                    <button type="button" class="btn btn-danger">Daftar Sekarang</button>
                  </li>
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
                <h2>paket internet</h2>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="package-card bg-success text-white position-relative">
                            <h3>Paket dasar</h3>
                            <p class="text-danger price">Unlimited</p>
                            <p>Kecepatan Internet</p>
                            <p class="text-danger price">10 Mbps</p>
                            <p>harga bulanan</p>
                            <p class="text-danger price">Rp 100.000</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="package-card bg-info text-white position-relative">
                            <h3>Paket Reguler</h3>
                            <p class="text-danger price">Unlimited</p>
                            <p>Kecepatan Internet</p>
                            <p class="text-danger price">20 Mbps</p>
                            <p>harga bulanan</p>
                            <p class="text-danger price">Rp 150.000</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="package-card bg-primary text-white position-relative">
                            <h3>Paket Bisnis</h3>
                            <p class="text-danger price">Unlimited</p>
                            <p>Kecepatan Internet</p>
                            <p class="text-danger price">40 Mbps</p>
                            <p>harga bulanan</p>
                            <p class="text-danger price">Rp 200.000</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="package-card bg-warning text-white position-relative">
                            <h3>Paket Eksekutif</h3>
                            <p class="text-danger price">Unlimited</p>
                            <p>Kecepatan Internet</p>
                            <p class="text-danger price">80 Mbps</p>
                            <p>harga bulanan</p>
                            <p class="text-danger price">Rp 250.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="container-fluid text-left">
            <div class="row">
              <div class="col">
                <div class="title">
                    <h5>Alamat</h5>
                </div>
                <div class="content">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d544.3376387748079!2d114.3445059!3d-8.2492684!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd15a9a3deb8e39%3A0x690a6afba6b12d2d!2sJl.%20Nangka%20No.1%2C%20Dusun%20Jurang%20Jero%2C%20Kalirejo%2C%20Kec.%20Kabat%2C%20Kabupaten%20Banyuwangi%2C%20Jawa%20Timur%2068461!5e1!3m2!1sid!2sid!4v1742567472544!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>
              <div class="col">
                <div class="title">
                    <h5>Informasi</h5>
                </div>
                <div class="content">
                    <p><i class="fa-solid fa-phone"></i>+6285730902001</p>
                    <p><i class="fa-solid fa-envelope"></i>Faturalief15@gmail.com</p>
                    <p><i class="fa-solid fa-location-dot"></i>Perumahan Pakis Kalirejo Blok N no 1</p>
                </div>
              </div>
              <div class="col">
                <div class="title">
                    <h5>Sosial media</h5>
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