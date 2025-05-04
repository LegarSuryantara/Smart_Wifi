@extends('layouts.app_1')

@section('title', 'detail paket')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold fs-6 mb-3">Paket Internet</h1>

    <!-- Paket Ekonomi -->
    <div class="paket-ekonomi">
      <div class="d-flex flex-wrap align-items-center gap-4 flex-grow-1">
        <div>
          <p>Internet traffic</p>
          <p>Unlimited</p>
        </div>
        <div>
          <p>Kecepatan Internet</p>
          <p>10 Mbps</p>
        </div>
        <div>
          <p>harga bulanan</p>
          <p>Rp 100.000</p>
        </div>
      </div>
      <div class="flex-shrink-0">
        <img src="https://storage.googleapis.com/a1aa/image/215092b5-aaea-483a-ad32-4a547096278e.jpg" alt="Waving flag of Uzbekistan with blue, white, and green stripes and red lines" width="120" height="80" style="object-fit: contain;" />
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
          <li>Harga bulanan hanya Rp100.000</li>
          <li>Pembelian paket bisa berkali-kali</li>
          <li>Koneksi stabil 10 mbps</li>
          <li>dll</li>
        </ul>
      </div>
      <div class="purchase-box">
        <div class="subtotal">
          <span>Subtotal</span>
          <span>Rp.100.000</span>
        </div>
        <div class="qty-control">
          <div class="d-flex align-items-center gap-2">
            <button type="button">-</button>
            <span>1</span>
            <button type="button">+</button>
          </div>
          <span>GB</span>
        </div>
        <a href="{{ route('pakets.pembayaran')}}" class="btn btn-primary" type="button">Beli Paket</a>
      </div>
    </div>

    <!-- Recommendation -->
    <div class="recommendation mt-5" style="font-size: 0.75rem; color: #4a4a4a;">
      <div class="d-flex align-items-center mb-3">
        <i class="fas fa-check-square me-2"></i>
        <span>Rekomendasi paket untukmu</span>
      </div>
      <div class="row g-3">
        <div class="col-sm-6">
          <div class="paket-card paket-popular position-relative">
            <div class="badge-popular">POPULAR</div>
            <h2>Paket Reguler</h2>
            <p>Internet traffic</p>
            <p class="unlimited-reguler">Unlimited</p>
            <p>Kecepatan Internet</p>
            <p class="speed">20 Mbps</p>
            <p>harga bulanan</p>
            <p class="price">Rp 150.000</p>
            <img src="https://storage.googleapis.com/a1aa/image/9110091d-9bbc-4fe9-bcd2-3ddf095b0a4b.jpg" alt="Image of a turtle with a brown shell and greenish background" class="paket-image" width="100" height="80" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="paket-card paket-bisnis position-relative">
            <h2>Paket Bisnis</h2>
            <p>Internet traffic</p>
            <p class="unlimited-bisnis">Unlimited</p>
            <p>Kecepatan Internet</p>
            <p class="speed">40 Mbps</p>
            <p>harga bulanan</p>
            <p class="price">Rp 200.000</p>
            <img src="https://storage.googleapis.com/a1aa/image/f44275a1-28ab-443d-17c6-98d6832ab21e.jpg" alt="Image of a red and white vintage van with blue windows" class="paket-image" width="100" height="80" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection