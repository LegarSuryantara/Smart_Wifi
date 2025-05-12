@extends('layouts.app_2')

@section('title', 'Tambah Paket')

@section('content')
<div class="container">
    <h1 class="mb-4" style="font-weight: 600; font-size: 10px; color: #2E3A59;">Tambah Paket</h1>
      <div class="d-flex justify-content-center">
        <div class="card p-4 shadow-sm" style="width: 100vh;">
          <form>
            <div class="mb-3">
              <label for="namaPaket" class="form-label">Nama Paket</label>
              <input type="text" class="form-control" id="namaPaket" placeholder="Nama paket" />
            </div>
            <div class="mb-3">
              <label for="kecepatan" class="form-label">Kecepatan</label>
              <input type="text" class="form-control" id="kecepatan" placeholder="Kecepata" />
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="text" class="form-control" id="harga" placeholder="Harga" />
            </div>
            <div class="mb-3">
              <label for="deskripsiPaket" class="form-label">Deskripsi Paket</label>
              <input type="text" class="form-control" id="deskripsiPaket" placeholder="Deskripsi" />
            </div>
            <button type="submit" class="btn btn-submit">Submit</button>
          </form>
        </div>
      </div>
</div>
@endsection