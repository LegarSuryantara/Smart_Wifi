@extends('layouts.app_1')

@section('title', 'halaman Pembayaran')

@section('content')
<div class="container py-4">
    <div class="row gx-4 gy-4">
      <div class="col-12 col-md-8 bg-white p-4 shadow-sm">
        <h2 class="fw-semibold mb-4" style="font-size:13px;">METODE PEMBAYARAN</h2>
        <form class="w-100" style="max-width: 320px;">
          <div class="mb-3">
            <label for="metode" class="form-label">Pilih metode pembayaran</label>
            <select id="metode" class="form-select custom-select" aria-label="Pilih metode pembayaran">
              <option selected>OFFLINE</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="cara" class="form-label">Pilih cara pembayaran</label>
            <select id="cara" class="form-select custom-select" aria-label="Pilih cara pembayaran">
              <option selected>COD</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat *contoh</label>
            <input type="text" class="form-control" id="alamat" />
          </div>
          <button type="submit" class="btn btn-blue px-3 py-1">Lanjutkan</button>
        </form>
      </div>
      <div class="col-12 col-md-4 d-flex flex-column gap-3">
        <div class="sidebar-box">
          <h3>METODE PEMBAYARAN</h3>
          <p>Kami menerima metode pembayaran aman berikut:</p>
          <div class="d-flex gap-2">
            <img src="image/danalogo.png" alt="Logo Dana payment method, blue and white text logo" height="20" width="40" />
            <img src="image/qrislogo.jpg" alt="Logo QRIS payment method, black and white text logo" height="20" width="40" />
            <img src="image/bnilogo.jpg" alt="Logo BNI payment method, red and orange text logo" height="20" width="40" />
          </div>
        </div>
        <div class="sidebar-box">
          <h3>METODE PEMBAYARAN OFFLINE</h3>
          <p>Anda dapat melakukan pembayaran secara langsung</p>
          <button type="button" class="offline-btn">
            <img src="https://storage.googleapis.com/a1aa/image/ba986f73-56d2-4f98-2d82-92fa6f83e58c.jpg" alt="Offline payment button with black text on white background" height="20" width="80" />
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection