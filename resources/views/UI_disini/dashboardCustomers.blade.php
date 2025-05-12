@extends('layouts.app_2')


@section('title', 'Dasboard Data Customer')

@section('content')
        <div class="container">
    <h2 class="text-secondary small fw-medium mb-4">Customer</h2>
    <div class="card-custom">
      <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <h2>All Customer</h2>
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
              <th scope="col" class="ps-3">Customers Name</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Email</th>
              <th scope="col">Country</th>
              <th scope="col" class="pe-3">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="ps-3 text-dark fw-normal">Jane Cooper</td>
              <td class="fw-semibold">(225) 555-0118</td>
              <td class="fw-semibold">jane@microsoft.com</td>
              <td class="fw-semibold">America</td>
              <td class="pe-3">
                <span class="status-badge status-online">Online</span>
              </td>
            </tr>
            <tr>
              <td class="ps-3 text-dark fw-normal">Floyd Miles</td>
              <td class="fw-semibold">(205) 555-0100</td>
              <td class="fw-semibold">floyd@yahoo.com</td>
              <td class="fw-semibold">Canada</td>
              <td class="pe-3">
                <span class="status-badge status-offline">Offline</span>
              </td>
            </tr>
            <tr>
              <td class="ps-3 text-dark fw-normal">Ronald Richards</td>
              <td class="fw-semibold">(302) 555-0107</td>
              <td class="fw-semibold">ronald@adobe.com</td>
              <td class="fw-semibold">Thailand</td>
              <td class="pe-3">
                <span class="status-badge status-offline">Offline</span>
              </td>
            </tr>
            <tr>
              <td class="ps-3 text-dark fw-normal">Marvin McKinney</td>
              <td class="fw-semibold">(252) 555-0126</td>
              <td class="fw-semibold">marvin@tesla.com</td>
              <td class="fw-semibold">Indonesia</td>
              <td class="pe-3">
                <span class="status-badge status-active">Active</span>
              </td>
            </tr>
            <tr>
              <td class="ps-3 text-dark fw-normal">Jerome Bell</td>
              <td class="fw-semibold">(629) 555-0129</td>
              <td class="fw-semibold">jerome@google.com</td>
              <td class="fw-semibold">Spain</td>
              <td class="pe-3">
                <span class="status-badge status-online">Online</span>
              </td>
            </tr>
            <tr>
              <td class="ps-3 text-dark fw-normal">Kathryn Murphy</td>
              <td class="fw-semibold">(406) 555-0120</td>
              <td class="fw-semibold">kathryn@microsoft.com</td>
              <td class="fw-semibold">England</td>
              <td class="pe-3">
                <span class="status-badge status-online">Online</span>
              </td>
            </tr>
            <tr>
              <td class="ps-3 text-dark fw-normal">Jacob Jones</td>
              <td class="fw-semibold">(208) 555-0112</td>
              <td class="fw-semibold">jacob@yahoo.com</td>
              <td class="fw-semibold">Pakistan</td>
              <td class="pe-3">
                <span class="status-badge status-offline">Offline</span>
              </td>
            </tr>
            <tr>
              <td class="ps-3 text-dark fw-normal">Kristin Watson</td>
              <td class="fw-semibold">(704) 555-0127</td>
              <td class="fw-semibold">kristin@facebook.com</td>
              <td class="fw-semibold">America</td>
              <td class="pe-3">
                <span class="status-badge status-offline">Offline</span>
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
