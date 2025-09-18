@extends('layouts.app_1')

@section('title', 'Checkout')

@section('content')
    <div class="container py-4 mt-4">
        <div class="row gx-4 gy-4">
            <div class="col-12 col-md-8 bg-white p-4 shadow-sm">
                <h4 class="fw-semibold mb-4" >Detail Pesanan</h4>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td> : {{ $order->name }}</td>
                    </tr>
                    <tr>
                        <td>No Tlp</td>
                        <td> : {{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <td>Nama Paket</td>
                        <td> : {{ $order->paket->nama_paket }}</td>
                    </tr>
                    <tr>
                        <td>qty</td>
                        <td> : {{ $order->qty }}</td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td> : {{ $order->total_price }}</td>
                    </tr>
                </table>
                <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column gap-3">
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

    {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
      const paymentForm = document.getElementById('paymentForm');
      const successModal = new bootstrap.Modal(document.getElementById('successModal'));
      
      paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi form sebelum menampilkan modal
        const alamat = document.getElementById('address').value;
        
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
  </script> --}}

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{$snapToken}}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    /*alert("payment success!");*/
                    window.location.href= "{{ route('user.index')}}"
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection
