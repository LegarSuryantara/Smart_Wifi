@extends('layouts.app_1')

@section('title', 'Daftar Paket')

@section('content')

{{-- HERO SECTION BARU YANG RESPONSIF --}}
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

{{-- BAGIAN PAKET INTERNET YANG DIPERBARUI --}}
<section id="paket-internet" class="package-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Pilihan Paket Internet Terbaik</h2>
            <p class="text-muted">Temukan paket yang paling sesuai dengan kebutuhan Anda.</p>
        </div>
        
        <div class="row">
            @forelse($pakets as $paket)
                <div class="col-lg-3 col-md-6 mb-4">
                    {{-- Menggunakan komponen Card dari Bootstrap --}}
                    <div class="card text-center h-100 shadow-sm border-0">
                        <div class="card-header bg-primary text-white border-0">
                            <h3 class="h5 mb-0 fw-bold">{{ $paket->nama_paket }}</h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p class="text-muted mb-0">Kecepatan hingga</p>
                            <p class="display-5 fw-bold text-primary">{{ $paket->kecepatan }}</p>
                            
                            <p class="text-muted mt-3 mb-0">Harga Bulanan</p>
                            <p class="h4 fw-bold">Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
                            
                            <span class="badge bg-success align-self-center mb-3">Unlimited</span>
                            
                            <div class="mt-auto">
                                <a href="{{ route('pakets.show', $paket->id) }}" class="btn btn-primary w-100 fw-bold">
                                    Pilih Paket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Tampilan jika tidak ada data paket --}}
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Saat ini belum ada paket yang tersedia.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Anda bisa menambahkan sedikit CSS kustom di sini jika perlu */
    .hero-section-baru {
        background-color: #f8f9fa; /* Warna latar yang lembut */
    }
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.2s ease-in-out;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
</style>
@endpush