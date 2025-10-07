@extends('layouts.app_1')

@section('title', 'halaman Pembayaran')

@section('content')
<div class="container py-4 mt-4">
    <div class="row gx-4 gy-4">
        <div class="col-12 col-md-8 bg-white p-4 shadow-sm">
            <h2 class="fw-semibold mb-4" style="font-size: 13px;">DETAIL PESANAN</h2>

            <form action="{{ route('pakets.checkout') }}" method="POST" id="paymentForm" class="w-100" style="max-width: 360px;">
                @csrf

                {{-- Hidden paket_id --}}
                <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                {{-- Hidden harga satuan untuk JavaScript --}}
                <input type="hidden" id="hargaSatuan" value="{{ $paket->harga }}">

                {{-- Nama Paket --}}
                <div class="mb-3">
                    <label for="paketPilihan" class="form-label fw-semibold">Paket yang Dipilih</label>
                    <input id="paketPilihan" type="text" class="form-control" value="{{ $paket->nama_paket }}" readonly>
                </div>

                {{-- Harga Paket --}}
                <div class="mb-3">
                    <label for="hargaPaket" class="form-label fw-semibold">Harga Paket</label>
                    <input id="hargaPaket" type="text" class="form-control"
                        value="Rp {{ number_format($paket->harga, 0, ',', '.') }}" readonly>
                </div>

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama</label>
                    <input id="name" name="name" type="text" class="form-control"
                        value="{{ auth()->user()->name }}" readonly>
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ auth()->user()->address }}" readonly>
                </div>

                {{-- Nomor Telepon --}}
                <div class="mb-3">
                    <label for="phone" class="form-label fw-semibold">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ auth()->user()->phone }}" readonly>
                </div>

                {{-- Jumlah Pesanan --}}
                <div class="mb-3">
                    <label for="qty" class="form-label fw-semibold">Jumlah Paket (maks. 12)</label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" id="decrement-btn">-</button>
                        <input type="number" class="form-control text-center" id="qty" name="qty"
                            value="1" min="1" max="12" required>
                        <button type="button" class="btn btn-outline-secondary" id="increment-btn">+</button>
                    </div>
                </div>

                {{-- Total Harga --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Total Pembayaran</label>
                    <input type="text" id="totalHarga" class="form-control fw-bold"
                        value="Rp {{ number_format($paket->harga, 0, ',', '.') }}" readonly>
                </div>

                <button type="submit" class="btn text-white px-3 py-2 w-100 fw-semibold" style="background-color: #0d6efd;">
                    Lanjutkan ke Pembayaran
                </button>
            </form>
        </div>

        {{-- Sidebar --}}
        <div class="col-12 col-md-4 d-flex flex-column gap-3">
            <div class="sidebar-box">
                <h3>METODE PEMBAYARAN</h3>
                <p>Kami menerima metode pembayaran aman berikut:</p>
                <div class="d-flex gap-2">
                    <img src="{{ asset('image/danalogo.png') }}" alt="Dana" height="20" width="40" />
                    <img src="{{ asset('image/qrislogo.jpg') }}" alt="QRIS" height="20" width="40" />
                    <img src="{{ asset('image/bnilogo.jpg') }}" alt="BNI" height="20" width="40" />
                </div>
            </div>
            <div class="sidebar-box">
                <h3>METODE PEMBAYARAN OFFLINE</h3>
                <p>Anda dapat melakukan pembayaran secara langsung</p>
                <button type="button" class="offline-btn">
                    <img src="https://storage.googleapis.com/a1aa/image/ba986f73-56d2-4f98-2d82-92fa6f83e58c.jpg"
                        alt="Offline payment" height="20" width="80" />
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
        appearance: none;
        -moz-appearance: textfield;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const decrementBtn = document.getElementById('decrement-btn');
    const incrementBtn = document.getElementById('increment-btn');
    const qtyInput = document.getElementById('qty');
    const totalHargaInput = document.getElementById('totalHarga');
    const hargaSatuan = parseInt(document.getElementById('hargaSatuan').value);

    // Fungsi format ke Rupiah
    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Fungsi update total harga
    function updateTotal() {
        const qty = parseInt(qtyInput.value);
        const total = hargaSatuan * qty;
        totalHargaInput.value = formatRupiah(total);
    }

    // Tombol -
    decrementBtn.addEventListener('click', function() {
        let currentValue = parseInt(qtyInput.value);
        if (currentValue > 1) {
            qtyInput.value = currentValue - 1;
            updateTotal();
        }
    });

    // Tombol +
    incrementBtn.addEventListener('click', function() {
        let currentValue = parseInt(qtyInput.value);
        if (currentValue < 12) {
            qtyInput.value = currentValue + 1;
            updateTotal();
        }
    });

    // Update total kalau user ubah manual di input
    qtyInput.addEventListener('input', function() {
        if (qtyInput.value < 1) qtyInput.value = 1;
        if (qtyInput.value > 12) qtyInput.value = 12;
        updateTotal();
    });
});
</script>
@endsection
