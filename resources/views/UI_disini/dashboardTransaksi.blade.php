@extends('layouts.app_2')

@section('title', 'Dashboard Transaksi')

@section('content')
    <div class="container">
    <h2 class="text-secondary small fw-medium mb-4">Transaksi</h2>
    <div class="card-custom">
      <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <h2>All Transaksi</h2>
        <div class="d-flex gap-3 flex-column flex-sm-row w-40 w-sm-auto">
          <div class="search-input-wrapper flex-grow-1 flex-sm-grow-0">
            <i class="fas fa-search"></i>
            <input
              type="search"
              class="form-control"
              placeholder="Search"
              aria-label="Search"
            />
          </div>
          <select class="form-select" aria-label="Sort by newest" aria-placeholder="Short by">
            <option>Newest</option>
            <option>Oldest</option>
            <option>Alphabetical</option>
          </select>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead>
            <tr>
              <th scope="col" class="ps-3">Tanggal pembayaran</th>
              <th scope="col">Nomor transaksi</th>
              <th scope="col">Metode pembayaran</th>
              <th scope="col">Jumlah pembayaran</th>
              <th scope="col" class="pe-3">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="ps-3 text-dark fw-normal">5 May 2025, 23.00 AM</td>
              <td class="fw-semibold">TASW-1-012345</td>
              <td class="fw-semibold">Dana</td>
              <td class="fw-semibold">IDR 150.000</td>
              <td class="pe-3">
                <span class="status-badge status-success">Success</span>
              </td>
            </tr>
            <tr>
              <td class="ps-3 text-dark fw-normal">5 May 2025, 23.30 AM</td>
              <td class="fw-semibold">TASW-2-012345</td>
              <td class="fw-semibold">Qris</td>
              <td class="fw-semibold">IDR 100.000</td>
              <td class="pe-3">
                <span class="status-badge status-pending">Pending</span>
              </td>
            </tr>
            <tr>
              <td class="ps-3 text-dark fw-normal">5 May 2025, 24.00 AM</td>
              <td class="fw-semibold">TASW-3-012345</td>
              <td class="fw-semibold">Cash</td>
              <td class="fw-semibold">IDR 200.000</td>
              <td class="pe-3">
                <span class="status-badge status-cancelled">Cancelled</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div
        class="d-flex justify-content-between align-items-center mt-4 text-muted"
        style="font-size: 11px; user-select:none;"
      >
        <div>Showing data 1 to 8 of 256K entries</div>
        <nav aria-label="Page navigation example">
          <ul class="pagination mb-0">
            <li class="page-item">
              <button class="page-link" aria-label="Previous">
                <i class="fas fa-chevron-left"></i>
              </button>
            </li>
            <li class="page-item active" aria-current="page">
              <button class="page-link">1</button>
            </li>
            <li class="page-item">
              <button class="page-link">2</button>
            </li>
            <li class="page-item">
              <button class="page-link">3</button>
            </li>
            <li class="page-item">
              <button class="page-link">4</button>
            </li>
            <li class="page-item disabled">
              <span class="page-link">..</span>
            </li>
            <li class="page-item">
              <button class="page-link">40</button>
            </li>
            <li class="page-item">
              <button class="page-link" aria-label="Next">
                <i class="fas fa-chevron-right"></i>
              </button>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
    
@endsection