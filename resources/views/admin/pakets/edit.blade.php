<!-- resources/views/admin/pakets/edit.blade.php -->
@extends('layouts.app_1')

@section('title', 'Edit Paket')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Paket</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pakets.update', $paket->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_paket" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control" id="nama_paket" name="nama_paket" value="{{ $paket->nama_paket }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="Dasar" {{ $paket->kategori == 'Dasar' ? 'selected' : '' }}>Dasar</option>
                                <option value="Reguler" {{ $paket->kategori == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                                <option value="Bisnis" {{ $paket->kategori == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                                <option value="Eksekutif" {{ $paket->kategori == 'Eksekutif' ? 'selected' : '' }}>Eksekutif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" value="{{ $paket->harga }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="kecepatan" class="form-label">Kecepatan</label>
                            <input type="text" class="form-control" id="kecepatan" name="kecepatan" value="{{ $paket->kecepatan }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection