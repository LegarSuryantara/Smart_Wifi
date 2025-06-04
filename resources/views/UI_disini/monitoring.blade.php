@extends('layouts.app_2')

@section('title', 'Monitoring wifi')

@section('content')
    <div class="container py-4">
        <h5 class="mb-4">Monitoring</h5>
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
                <div class="chart-container">
                    <!-- Y-Axis -->
                    <div class="y-axis">
                        <div>750</div>
                        <div>600</div>
                        <div>450</div>
                        <div>300</div>
                        <div>150</div>
                        <div>0</div>
                    </div>

                    <!-- Grid Lines -->
                    <div class="chart-grid">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>

                    <!-- Bar Chart -->
                    <div class="bar-chart">
                        <!-- Repeat for each month -->
                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 60px;"></div>
                                <div class="bar-uptime" style="height: 120px;"></div>
                            </div>
                            <div class="month-label">Jan</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 50px;"></div>
                                <div class="bar-uptime" style="height: 130px;"></div>
                            </div>
                            <div class="month-label">Feb</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 70px;"></div>
                                <div class="bar-uptime" style="height: 110px;"></div>
                            </div>
                            <div class="month-label">Mar</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 80px;"></div>
                                <div class="bar-uptime" style="height: 90px;"></div>
                            </div>
                            <div class="month-label">Apr</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 90px;"></div>
                                <div class="bar-uptime" style="height: 80px;"></div>
                            </div>
                            <div class="month-label">Mei</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 100px;"></div>
                                <div class="bar-uptime" style="height: 70px;"></div>
                            </div>
                            <div class="month-label">Jun</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 60px;"></div>
                                <div class="bar-uptime" style="height: 120px;"></div>
                            </div>
                            <div class="month-label">Jul</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 85px;"></div>
                                <div class="bar-uptime" style="height: 100px;"></div>
                            </div>
                            <div class="bar-tooltip">59.7</div>
                            <div class="month-label fw-bold text-primary">Aug</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 75px;"></div>
                                <div class="bar-uptime" style="height: 90px;"></div>
                            </div>
                            <div class="month-label">Sep</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 78px;"></div>
                                <div class="bar-uptime" style="height: 88px;"></div>
                            </div>
                            <div class="month-label">Okt</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 82px;"></div>
                                <div class="bar-uptime" style="height: 92px;"></div>
                            </div>
                            <div class="month-label">Nov</div>
                        </div>

                        <div class="bar-group">
                            <div class="bar-pair">
                                <div class="bar-downtime" style="height: 90px;"></div>
                                <div class="bar-uptime" style="height: 80px;"></div>
                            </div>
                            <div class="month-label">Des</div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Tabel Status Jaringan -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="card-title mb-3">Tabel Status Jaringan Per Hari</h6>
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
                            <tr>
                                <td>18/05/2025</td>
                                <td><span class="badge bg-success me-2">●</span>Normal</td>
                                <td>23h 58m</td>
                                <td>2m</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>19/05/2025</td>
                                <td><span class="badge bg-warning text-dark me-2">▲</span>Gangguan</td>
                                <td>20h 10m</td>
                                <td>3h 50m</td>
                                <td>Pemadaman</td>
                            </tr>
                            <tr>
                                <td>20/05/2025</td>
                                <td><span class="badge bg-danger me-2">■</span>Gangguan berat</td>
                                <td>15h</td>
                                <td>9h</td>
                                <td>Pemadaman Berkala</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center">
                    <small>Showing data 1 to 8 of 256K entries</small>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">&lt;</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">40</a></li>
                            <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
