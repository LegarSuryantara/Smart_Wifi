<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Monitorings') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 fw-semibold">Kesehatan Jaringan</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center">
                            <div class="me-1"
                                style="width: 12px; height: 12px; background-color: #cfcaf4; border-radius: 2px;"></div>
                            <small class="text-muted me-3">DownTime</small>
                            <div class="me-1"
                                style="width: 12px; height: 12px; background-color: #3b32f1; border-radius: 2px;"></div>
                            <small class="text-muted">UpTime</small>
                        </div>
                        <select class="form-select form-select-sm w-auto">
                            <option selected>This Month</option>
                        </select>
                    </div>
                </div>

                <!-- Chart Area -->
                <div class="chart-container mb-4" style="padding: 0 5px;">
                    <canvas id="networkChart" height="250px" style="width: 100%;"></canvas>
                </div>
                <!-- CDN Chart.js -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    const ctx = document.getElementById('networkChart').getContext('2d');
                    const networkChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: @json($chartLabels),
                            datasets: [
                                {
                                    label: 'Downtime',
                                    data: @json($downtimeData),
                                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                                    stack: 'total',
                                },
                                {
                                    label: 'Uptime',
                                    data: @json($uptimeData),
                                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                    stack: 'total',
                                }
                            ]
                        },
                        options: {
                            animation: false, 
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Statistik Uptime & Downtime per Bulan'
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    stacked: true,
                                    title: {
                                        display: true,
                                        text: 'Jam'
                                    }
                                },
                                x: {
                                    stacked: true
                                }
                            }
                        }
                    });

                </script>


            </div>
        </div>

        <!-- Tabel Status Jaringan -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="card-title mb-0">Tabel Status Jaringan Per Hari</h6>
                    <a href="{{ route('monitorings.create') }}" class="btn btn-primary btn-sm">+ Tambah Status</a>
                </div>


                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Uptime</th>
                                <th>Downtime</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($monitorings as $monitoring)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($monitoring->tanggal)->format('d/m/Y') }}</td>
                                    <td>
                                        @if(strtolower($monitoring->status) == 'normal')
                                            <span class="badge bg-success me-2">●</span>{{ $monitoring->status }}
                                        @elseif(strtolower($monitoring->status) == 'gangguan')
                                            <span class="badge bg-warning text-dark me-2">▲</span>{{ $monitoring->status }}
                                        @else
                                            <span class="badge bg-danger me-2">■</span>{{ $monitoring->status }}
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($monitoring->uptime)->format('H\h i\m') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($monitoring->downtime)->format('H\h i\m') }}</td>
                                    <td>{{ $monitoring->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center">
                    <small>
                        Showing {{ $monitorings->firstItem() }} to {{ $monitorings->lastItem() }} of {{ $monitorings->total() }} entries
                    </small>
                    {{ $monitorings->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
