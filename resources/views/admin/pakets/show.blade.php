<!-- resources/views/admin/pakets/show.blade.php
@extends('layouts.app_1')

@section('title', 'Detail Paket')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Detail Paket</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Paket</label>
                        <p>{{ $paket->nama_paket }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kecepatan</label>
                        <p>{{ $paket->kecepatan }} Mbps</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <p>Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->