@extends('layouts.app_1')

@section('title', 'halaman Pembayaran')

@section('content')
<div class="container py-4">
    <div class="row gx-4 gy-4">
      <div class="col-12 col-md-8 bg-white p-4 shadow-sm">
        <h2 class="fw-semibold mb-4" style="font-size:13px;">METODE PEMBAYARAN</h2>
        <form class="w-100" style="max-width: 320px;" id="paymentForm">
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
          <button type="submit" class="btn text-white px-3 py-1" style="background-color: #0d6efd;">Lanjutkan</button>
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

  <!-- Modal Success -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center p-4">
          <div class="mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
          </div>
          <h5 class="modal-title mb-3" id="successModalLabel">Pembayaran Berhasil!</h5>
          <p>Terima kasih telah melakukan pembayaran. Pesanan Anda sedang diproses.</p>
          <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const paymentForm = document.getElementById('paymentForm');
      const successModal = new bootstrap.Modal(document.getElementById('successModal'));
      
      paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi form sebelum menampilkan modal
        const alamat = document.getElementById('alamat').value;
        
        if (!alamat) {
          alert('Silakan isi alamat terlebih dahulu');
          return;
        }
        
        // Tampilkan modal sukses
        successModal.show();
        
        // Optional: Reset form setelah submit
        // paymentForm.reset();
      });
    });
  </script>
@endsection