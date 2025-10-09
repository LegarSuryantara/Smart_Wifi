@extends('layouts.app_1')

@section('title', 'Checkout')

@section('content')
<div class="container py-4 mt-4">
    <div class="row gx-4 gy-4">
        <div class="col-12 col-md-8 bg-white p-4 shadow-sm">
            <h4 class="fw-semibold mb-4">Detail Pesanan</h4>
            <table class="table table-borderless">
                <tr>
                    <td>Nama</td>
                    <td>: {{ $order->user->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td>No. Tlp</td>
                    <td>: {{ $order->user->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Nama Paket</td>
                    <td>: {{ $order->paket->nama_paket ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>: {{ $order->qty }}</td>
                </tr>
                <tr>
                    <td>Total Harga</td>
                    <td>: Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</td>
                </tr>
            </table>
            <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
        </div>

        <div class="col-12 col-md-4 d-flex flex-column gap-3">
            <div class="sidebar-box">
                <h3>METODE PEMBAYARAN</h3>
                <div class="d-flex gap-2">
                    <img src="{{ asset('image/danalogo.png') }}" alt="Dana" height="20" width="40" />
                    <img src="{{ asset('image/qrislogo.jpg') }}" alt="QRIS" height="20" width="40" />
                    <img src="{{ asset('image/bnilogo.jpg') }}" alt="BNI" height="20" width="40" />
                </div>
            </div>

            <div class="sidebar-box">
                <h3>METODE PEMBAYARAN OFFLINE</h3>
                <p>Anda dapat melakukan pembayaran secara langsung.</p>
                <button type="button" class="btn btn-outline-secondary w-100">
                    Bayar di Lokasi
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = "{{ route('user.index') }}";
            },
            onPending: function(result) {
                alert("Menunggu pembayaran Anda!");
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
            },
            onClose: function() {
                alert('Anda menutup popup tanpa menyelesaikan pembayaran.');
            }
        });
    });
</script>
@endsection