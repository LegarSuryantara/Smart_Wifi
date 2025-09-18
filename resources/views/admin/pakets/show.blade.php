@extends('layouts.app_1')

@section('title', 'Detail Paket')

@section('content')
<div class="container py-5 mt-5">
    <h1 class="fw-bold fs-5 mb-4">Detail Paket</h1>

    <!-- Paket yang dipilih -->
    <div class="paket-ekonomi">
      <div class="d-flex flex-wrap align-items-center gap-4 flex-grow-1">
        <div>
          <h5>Nama Paket</h5>
          <p>{{ $paket->nama_paket}}</p>
        </div>
        <div>
          <h5>Internet traffic</h5>
          <p>Unlimited</p>
        </div>
        <div>
          <h5>Kecepatan Internet</h5>
          <p>{{ $paket->kecepatan }}</p>
        </div>
        <div>
          <h5>harga bulanan</h5>
          <p>Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
        </div>
      </div>
    </div>

    <!-- Description and Purchase -->
    <div class="d-flex flex-column flex-sm-row justify-content-between gap-4 mt-4">
      <div class="desc-paket flex-grow-1" style="font-size: 0.75rem; color: #4a4a4a;">
        <div class="d-flex align-items-center mb-2">
          <i class="fas fa-check-square me-2"></i>
          <span>Deskripsi paket</span>
        </div>
        <ul>
          <li>Internet trafik tanpa batas</li>
          <li>Harga bulanan Rp{{ number_format($paket->harga, 0, ',', '.') }}</li>
          <li>Pembelian paket bisa berkali-kali</li>
          <li>Koneksi stabil {{ $paket->kecepatan }}</li>
          <li>dll</li>
        </ul>
      </div>
      <div class="purchase-box">
        <div class="subtotal">
          <span>Subtotal</span>
          <span>Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
        </div>
        <div class="qty-control">
          <div class="d-flex align-items-center gap-2">
            <button type="button">-</button>
            <span>1</span>
            <button type="button">+</button>
          </div>
          <span>Bulan</span>
        </div>
        <a href="{{ route('pakets.pembayaran', $paket->id) }}" class="btn btn-primary">Beli Paket</a>
      </div>
    </div>
  </div>
@endsection