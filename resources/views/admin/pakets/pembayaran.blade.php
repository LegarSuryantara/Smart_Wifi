@extends('layouts.app_1')

@section('title', 'halaman Pembayaran')

@section('content')
<div class="container py-4 mt-4">
    <div class="row gx-4 gy-4">
        <div class="col-12 col-md-8 bg-white p-4 shadow-sm">
            <h2 class="fw-semibold mb-4" style="font-size:13px;">DETAIL PESANAN!</h2>
            <form action="{{ route('pakets.checkout') }}" class="w-100" style="max-width: 320px;" id="paymentForm"
                method="POST">
                @csrf

                {{-- Hidden paket_id untuk dikirim ke database --}}
                <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                <div class="mb-3">
                    <label for="paketPilihan" class="form-label">Paket yang dipilih</label>
                    <input id="paketPilihan" type="text" class="form-control" value="{{ $paket->nama_paket }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input id="name" name="name" type="text" class="form-control" aria-describedby="name"
                        value="{{ auth()->user()->name }}" required readonly />
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ auth()->user()->address }}" required readonly />
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ auth()->user()->phone }}" required readonly />
                </div>

                <div class="mb-3">
                    <label for="qty" class="form-label">Maksimal pemesanan 12 paket (1 Tahun)</label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" id="decrement-btn">-</button>
                        <input type="number" class="form-control text-center" id="qty" name="qty"
                            value="1" required min="1" max="12" readonly />
                        <button type="button" class="btn btn-outline-secondary" id="increment-btn">+</button>
                    </div>
                </div>

                <button type="submit" class="btn text-white px-3 py-1"
                    style="background-color: #0d6efd;">Lanjutkan</button>
            </form>
        </div>
        <div class="col-12 col-md-4 d-flex flex-column gap-3">
            <!-- Bagian metode pembayaran tetap sama -->
            <div class="sidebar-box">
                <h3>METODE PEMBAYARAN</h3>
                <p>Kami menerima metode pembayaran aman berikut:</p>
                <div class="d-flex gap-2">
                    <img src="{{ asset('image\danalogo.png') }}"
                        alt="Logo Dana payment method, blue and white text logo" height="20" width="40" />
                    <img src="{{ asset('image\qrislogo.jpg') }}"
                        alt="Logo QRIS payment method, black and white text logo" height="20" width="40" />
                    <img src="{{ asset('image\bnilogo.jpg') }}" alt="Logo BNI payment method, red and orange text logo"
                        height="20" width="40" />
                </div>
            </div>
            <div class="sidebar-box">
                <h3>METODE PEMBAYARAN OFFLINE</h3>
                <p>Anda dapat melakukan pembayaran secara langsung</p>
                <button type="button" class="offline-btn">
                    <img src="https://storage.googleapis.com/a1aa/image/ba986f73-56d2-4f98-2d82-92fa6f83e58c.jpg"
                        alt="Offline payment button with black text on white background" height="20"
                        width="80" />
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745"
                        class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </div>
                <h5 class="modal-title mb-3" id="successModalLabel">Pembayaran Berhasil!</h5>
                <p>Terima kasih telah melakukan pembayaran. Pesanan Anda sedang diproses.</p>
                <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Menghilangkan tombol spinner pada input number */
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Untuk Firefox */
    input[type=number] {
        appearance: '';
        -moz-appearance: textfield;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decrementBtn = document.getElementById('decrement-btn');
        const incrementBtn = document.getElementById('increment-btn');
        const qtyInput = document.getElementById('qty');

        // Fungsi untuk mengurangi jumlah
        decrementBtn.addEventListener('click', function() {
            let currentValue = parseInt(qtyInput.value);
            if (currentValue > 1) {
                qtyInput.value = currentValue - 1;
            }
        });

        // Fungsi untuk menambah jumlah (maksimal 12)
        incrementBtn.addEventListener('click', function() {
            let currentValue = parseInt(qtyInput.value);
            if (currentValue < 12) {
                qtyInput.value = currentValue + 1;
            }
        });
    });
</script>
@endsection