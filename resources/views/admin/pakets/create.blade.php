<!-- resources/views/admin/pakets/create.blade.php -->
@extends('layouts.app_1')

@section('title', 'Tambah Paket')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Paket Baru</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pakets.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_paket" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Dasar">Dasar</option>
                                <option value="Reguler">Reguler</option>
                                <option value="Bisnis">Bisnis</option>
                                <option value="Eksekutif">Eksekutif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>

                        <div class="mb-3">
                            <label for="kecepatan" class="form-label">Kecepatan</label>
                            <input type="text" class="form-control" id="kecepatan" name="kecepatan" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection