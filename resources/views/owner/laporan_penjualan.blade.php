@extends('layouts.owner-template')
@section('content')
<div class="container-fluid">
    <h6 class="box-title">Laporan Penjualan</h6>

    <form method="GET" action="{{ route('owner.laporan_penjualan') }}" class="row mb-4">
        <div class="col-md-4">
            <label for="from_date">Dari Tanggal</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ $startDate }}" required>
        </div>
        <div class="col-md-4">
            <label for="to_date">Sampai Tanggal</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ $endDate }}" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <a href="{{ route('owner.laporan_penjualan') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Penjualan</h5>
                <p class="fw-bold">Rp. {{ number_format($stats['total_sales'], 0) }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Jumlah Pesanan</h5>
                <p class="fw-bold">{{ $stats['order_count'] }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Rata-rata Pesanan</h5>
                <p class="fw-bold">Rp. {{ number_format($stats['avg_order_value'], 0) }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Pertumbuhan</h5>
                <p class="fw-bold {{ $stats['sales_growth'] >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ number_format($stats['sales_growth'], 1) }}%
                </p>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Penjualan Harian</h5>
                <canvas id="dailySalesChart" height="100"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Penjualan Bulanan</h5>
                <canvas id="monthlySalesChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Produk Terlaris</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Terjual</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stats['top_products'] as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->total_quantity }}</td>
                                <td>Rp. {{ number_format($product->total_revenue, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Penjualan per Kategori</h5>
                <canvas id="categorySalesChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <div class="card p-3">
        <h5>Distribusi Status Pesanan</h5>
        <div style="max-width: 250px; margin: 0 auto;">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Penjualan Harian
    const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
    new Chart(dailySalesCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($stats['daily_sales'])) !!},
            datasets: [{
                label: 'Penjualan Harian (Rp)',
                data: {!! json_encode(array_values($stats['daily_sales'])) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // Grafik Penjualan Bulanan
    const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
    new Chart(monthlySalesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($stats['monthly_sales'])) !!},
            datasets: [{
                label: 'Penjualan Bulanan (Rp)',
                data: {!! json_encode(array_values($stats['monthly_sales'])) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // Grafik Penjualan per Kategori
    const categorySalesCtx = document.getElementById('categorySalesChart').getContext('2d');
    new Chart(categorySalesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($stats['sales_by_category'])) !!},
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: {!! json_encode(array_values($stats['sales_by_category'])) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // Pie Chart Distribusi Status (Diperkecil)
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($stats['status_distribution'])) !!},
            datasets: [{
                data: {!! json_encode(array_values($stats['status_distribution'])) !!},
                backgroundColor: ['#dc3545', '#ffc107', '#28a745', '#6c757d']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection