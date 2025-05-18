<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <div class="container">
                            <h2 class="fw-semibold fs-6 mb-4 text-dark dark:text-white">Dashboard</h2>
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                                <div>
                                    <p class="small-text fw-semibold mb-1 dark:text-gray-300">Revenue</p>
                                    <p class="fw-bold fs-5 mb-1 text-dark dark:text-white">IDR 7.852.000</p>
                                    <p class="text-green d-flex align-items-center gap-1 mb-0">
                                        <i class="fas fa-arrow-up"></i> 2.1%
                                        <span class="fw-normal text-muted ms-1">vs last week</span>
                                    </p>
                                    <p class="small-text text-muted mt-1 mb-0">Sales from 1-12 Dec, 2020</p>
                                </div>
                                <button class="btn btn-sm text-primary bg-light rounded-2 fw-semibold px-3 py-1 dark:bg-gray-700 dark:text-primary-300" type="button">View Report</button>
                            </div>
                            
                            <svg aria-label="Bar chart showing sales data from 1 to 12" class="bar-chart" fill="none" viewbox="0 0 360 100" xmlns="http://www.w3.org/2000/svg" role="img" width="100%" height="100">
                                <rect fill="#5C5EDD" height="50" width="15" x="10" y="40"></rect>
                                <rect fill="#B3B7F5" height="40" width="15" x="35" y="50"></rect>
                                <rect fill="#5C5EDD" height="55" width="15" x="60" y="35"></rect>
                                <rect fill="#B3B7F5" height="35" width="15" x="85" y="55"></rect>
                                <rect fill="#5C5EDD" height="60" width="15" x="110" y="30"></rect>
                                <rect fill="#5C5EDD" height="65" width="15" x="135" y="25"></rect>
                                <rect fill="#5C5EDD" height="50" width="15" x="160" y="40"></rect>
                                <rect fill="#B3B7F5" height="40" width="15" x="185" y="50"></rect>
                                <rect fill="#5C5EDD" height="45" width="15" x="210" y="45"></rect>
                                <rect fill="#B3B7F5" height="35" width="15" x="235" y="55"></rect>
                                <rect fill="#5C5EDD" height="60" width="15" x="260" y="30"></rect>
                                <rect fill="#5C5EDD" height="65" width="15" x="285" y="25"></rect>
                            </svg>
                            
                            <div class="bar-labels">
                                <span>01</span>
                                <span>02</span>
                                <span>03</span>
                                <span>04</span>
                                <span>05</span>
                                <span>06</span>
                                <span>07</span>
                                <span>08</span>
                                <span>09</span>
                                <span>10</span>
                                <span>11</span>
                                <span>12</span>
                            </div>
                            
                            <div class="legend">
                                <div class="d-flex align-items-center gap-1">
                                    <span class="legend-dot legend-dot-1"></span> Last 6 days
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="legend-dot legend-dot-2"></span> Last Week
                                </div>
                            </div>
                            
                            <div class="card-container p-4 d-flex flex-column flex-md-row justify-content-between gap-4">
                                <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle card-icon-bg-1" style="width:56px; height:56px;">
                                        <i class="fas fa-dollar-sign fs-4"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="card-text-small mb-1 dark:text-gray-300">Earning</p>
                                        <p class="fw-bold fs-4 mb-1 text-dark dark:text-white text-truncate">Rp.2.5JT</p>
                                        <p class="card-text-green mb-0">
                                            <i class="fas fa-arrow-up"></i>
                                            <span class="underline-green">37.8%</span> this month
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle card-icon-bg-2" style="width:56px; height:56px;">
                                        <i class="fas fa-wallet fs-4"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="card-text-small mb-1 dark:text-gray-300">Balance</p>
                                        <p class="fw-bold fs-4 mb-1 text-dark dark:text-white text-truncate">Rp.200k</p>
                                        <p class="card-text-red mb-0">
                                            <i class="fas fa-arrow-down"></i> 2% this month
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center gap-3 flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle card-icon-bg-3" style="width:56px; height:56px;">
                                        <i class="fas fa-lock fs-4"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="card-text-small mb-1 dark:text-gray-300">Total Sales</p>
                                        <p class="fw-bold fs-4 mb-1 text-dark dark:text-white text-truncate">Rp600k</p>
                                        <p class="card-text-green mb-0">
                                            <i class="fas fa-arrow-up"></i> 11% this week
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>