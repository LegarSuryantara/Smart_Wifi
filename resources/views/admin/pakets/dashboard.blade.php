@extends('layouts.app_1')

@section('title', 'Daftar Paket')

@section('content')
<section class="hero-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 model">
                <!-- Gambar atau ilustrasi bisa ditambahkan di sini -->
            </div>
            <div class="col-6">
                <h2>Mari Bergabung Bersama Kami</h2>
                <p>Get more of what matters to you</p>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="bg-white p-4 rounded shadow">
                            <i class="fas fa-globe mb-2"></i>
                            <h3 class="h5">Unlimited</h3>
                            <p class="small font-weight-light">Nikmati internetan tanpa batas</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="bg-white p-4 rounded shadow">
                            <i class="fas fa-credit-card mb-2"></i>
                            <h3 class="h5">Kemudahan Pembayaran</h3>
                            <p class="small font-weight-light">Pembayaran bisa lewat mana saja</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="bg-white p-4 rounded shadow">
                            <i class="fas fa-user-shield mb-2"></i>
                            <h3 class="h5">Privasi Pelanggan</h3>
                            <p class="small font-weight-light">Keamanan wifi terjamin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Menampilkan paket -->
<section class="package-section p-4">
    <div class="container">
        <h2 class="text-2xl font-bold mb-6 text-left">Paket Internet</h2>
        <div class="row">
            @foreach($pakets as $paket)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">{{ $paket->nama_paket }}</h3>
                            <p class="card-text">
                                <strong>Kategori:</strong> {{ $paket->kategori }}<br>
                                <strong>Kecepatan:</strong> {{ $paket->kecepatan }}<br>
                                <strong>Harga:</strong> Rp {{ number_format($paket->harga, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="#" class="btn btn-primary btn-block">Pilih Paket</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection