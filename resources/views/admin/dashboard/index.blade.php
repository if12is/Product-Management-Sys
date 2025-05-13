@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Dashboard Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fade-in">Welcome, {{ Auth::user()->name }}</h1>
        <a href="{{ route('admin.products.create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm fade-in">
            <i class="bi bi-plus-circle me-1"></i> Add New Product
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Products Card -->
        <div class="col-xl-3 col-md-6 mb-4 fade-in delay-1">
            <div class="card stat-card primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Products Card -->
        <div class="col-xl-3 col-md-6 mb-4 fade-in delay-2">
            <div class="card stat-card success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Active Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inactive Products Card -->
        <div class="col-xl-3 col-md-6 mb-4 fade-in delay-3">
            <div class="card stat-card warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Inactive Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inactiveProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-x-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Categories Card -->
        <div class="col-xl-3 col-md-6 mb-4 fade-in delay-4">
            <div class="card stat-card info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Categories
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCategories }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Products by Category Chart -->
        <div class="col-xl-8 col-lg-7 fade-in delay-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Products by Category</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="productsByCategoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Status Distribution Chart -->
        <div class="col-xl-4 col-lg-5 fade-in delay-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Product Status</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="productStatusChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="me-2">
                            <i class="bi bi-circle-fill text-success"></i> Active
                        </span>
                        <span class="me-2">
                            <i class="bi bi-circle-fill text-warning"></i> Inactive
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row fade-in delay-3">
        <!-- Latest Products -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Products</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestProducts as $product)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.products.show', $product->id) }}">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        <td>{{ $product->category }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            @if ($product->status == 'Active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary">
                            View All Products
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Price Range Analysis -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Price Range Analysis</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="priceRangeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Products by Category Chart
            var ctxCategory = document.getElementById('productsByCategoryChart').getContext('2d');
            var productsByCategoryChart = new Chart(ctxCategory, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($categoryLabels) !!},
                    datasets: [{
                        label: 'Number of Products',
                        data: {!! json_encode($categoryData) !!},
                        backgroundColor: [
                            'rgba(78, 115, 223, 0.5)',
                            'rgba(28, 200, 138, 0.5)',
                            'rgba(54, 185, 204, 0.5)',
                            'rgba(246, 194, 62, 0.5)',
                            'rgba(231, 74, 59, 0.5)'
                        ],
                        borderColor: [
                            'rgba(78, 115, 223, 1)',
                            'rgba(28, 200, 138, 1)',
                            'rgba(54, 185, 204, 1)',
                            'rgba(246, 194, 62, 1)',
                            'rgba(231, 74, 59, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Product Status Chart
            var ctxStatus = document.getElementById('productStatusChart').getContext('2d');
            var productStatusChart = new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Inactive'],
                    datasets: [{
                        data: [{{ $activeProducts }}, {{ $inactiveProducts }}],
                        backgroundColor: ['#1cc88a', '#f6c23e'],
                        hoverBackgroundColor: ['#17a673', '#dda20a'],
                        hoverBorderColor: 'rgba(234, 236, 244, 1)',
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    cutout: '70%',
                },
            });

            // Price Range Chart
            var ctxPrice = document.getElementById('priceRangeChart').getContext('2d');
            var priceRangeChart = new Chart(ctxPrice, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($priceRangeLabels) !!},
                    datasets: [{
                        label: 'Number of Products',
                        data: {!! json_encode($priceRangeData) !!},
                        backgroundColor: 'rgba(54, 185, 204, 0.5)',
                        borderColor: 'rgba(54, 185, 204, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
