@extends('layouts.app_2')

@section('title', 'Dashboard Pakets')

@section('content')
 <section>
<div class="container py-4">
    <h2 class="text-secondary small fw-medium mb-4">Daftar Paket</h2>
    <div class="bg-white rounded-2xl p-4 p-md-5 shadow-sm">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
          <h3 class="fw-semibold fs-5 text-dark mb-1">
            Daftar <span class="fw-bold">Paket</span>
          </h3>
          <p class="text-teal mb-0">Active Paket</p>
        </div>
        <div class="d-flex gap-5 w-100 w-md-auto" style="max-width: 50rem;">
          <div class="position-relative flex-grow-1 " >
            <input
              type="text"
              class="form-control ps-5"
              placeholder="Search"
              aria-label="Search"
            />
            <span class="input-group-text">
              <i class="fas fa-search"></i>
            </span>
          </div>
          <select class="form-select" style="max-width: 16rem;" aria-label="Sort by">`
            <option selected>Sort by : Newest</option>
            <option>Newest</option>
            <option>Oldest</option>
          </select>
        </div>
      </div>
      <table class="table mb-4" style="border-spacing: 0 1.5rem; border-collapse: separate;">
        <thead>
          <tr>
            <th scope="col" class="ps-3">No</th>
            <th scope="col">Nama Paket</th>
            <th scope="col">Kecepatan</th>
            <th scope="col">Harga</th>
            <th scope="col" class="pe-3">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ps-3">1</td>
            <td>Ekonomi</td>
            <td>10 MBPS</td>
            <td>Rp. 100.000</td>
            <td class="pe-3">
              <a href="{{ route('dashboard.editPaket')}}"><i class="fas fa-edit icon-edit me-3" role="button" aria-label="Edit Ekonomi"></i></a>
              <i class="fas fa-trash-alt icon-delete" role="button" aria-label="Delete Ekonomi"></i>
            </td>
          </tr>
          <tr>
            <td class="ps-3">2</td>
            <td>Reguler</td>
            <td>20 MBPS</td>
            <td>Rp. 150.000</td>
            <td class="pe-3">
              <i class="fas fa-edit icon-edit me-3" role="button" aria-label="Edit Reguler"></i>
              <i class="fas fa-trash-alt icon-delete" role="button" aria-label="Delete Reguler"></i>
            </td>
          </tr>
          <tr>
            <td class="ps-3">3</td>
            <td>Bisnis</td>
            <td>40 MBPS</td>
            <td>Rp. 200.000</td>
            <td class="pe-3">
              <i class="fas fa-edit icon-edit me-3" role="button" aria-label="Edit Bisnis"></i>
              <i class="fas fa-trash-alt icon-delete" role="button" aria-label="Delete Bisnis"></i>
            </td>
          </tr>
          <tr>
            <td class="ps-3">4</td>
            <td>Eksekutif</td>
            <td>80 MBPS</td>
            <td>Rp. 250.000</td>
            <td class="pe-3">
              <i class="fas fa-edit icon-edit me-3" role="button" aria-label="Edit Eksekutif"></i>
              <i class="fas fa-trash-alt icon-delete" role="button" aria-label="Delete Eksekutif"></i>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-end">
        <a href="{{ route('dashboard.tambahPaket')}}" type="button" class="btn btn-purple">
          <i class="fas fa-plus" style="font-size: 10px;"></i>
          <span>Tambah Paket</span>
        </a>
      </div>
    </div>
  </div>
    </section>
@endsection
