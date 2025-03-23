<!-- resources/views/admin/pakets/index.blade.php -->
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
<section class="package-section p-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Paket Internet</h2>
            <a href="{{ route('pakets.create') }}" class="btn btn-primary">Tambah Paket</a>
        </div>
        <div class="row">
            @foreach($pakets as $paket)
            <div class="col-md-3 mb-4">
                <div class="package-card bg-primary text-white position-relative">
                    <h3>{{ $paket->nama_paket }}</h3>
                    <p class="text-danger price">Unlimited</p>
                    <p>Kategori</p>
                    <p class="text-danger price">{{ $paket->kategori }}</p>
                    <p>Kecepatan Internet</p>
                    <p class="text-danger price">{{ $paket->kecepatan }} Mbps</p>
                    <p>Harga Bulanan</p>
                    <p class="text-danger price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('pakets.edit', $paket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pakets.destroy', $paket->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection