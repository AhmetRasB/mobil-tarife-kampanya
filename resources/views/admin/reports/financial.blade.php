@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-invoice fa-2x me-3"></i>
                        <div>
                            <h6 class="card-title mb-0">Toplam Fatura</h6>
                            <h3 class="mb-0">{{ $totalInvoices }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-2x me-3"></i>
                        <div>
                            <h6 class="card-title mb-0">Ödenen Fatura</h6>
                            <h3 class="mb-0">{{ $paidInvoices }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-times-circle fa-2x me-3"></i>
                        <div>
                            <h6 class="card-title mb-0">Bekleyen Fatura</h6>
                            <h3 class="mb-0">{{ $unpaidInvoices }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-coins fa-2x me-3"></i>
                        <div>
                            <h6 class="card-title mb-0">Toplam Gelir</h6>
                            <h3 class="mb-0">₺{{ number_format($totalRevenue, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aylık Gelir</h3>
                </div>
                <div class="card-body">
                    <canvas id="monthlyRevenueChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const revenueLabels = [
        'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran',
        'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'
    ];
    const revenueData = Array(12).fill(0);
    @foreach($monthlyRevenue as $item)
        revenueData[{{ $item->month - 1 }}] = {{ $item->total }};
    @endforeach
    new Chart(document.getElementById('monthlyRevenueChart'), {
        type: 'line',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Aylık Gelir',
                data: revenueData,
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23,162,184,0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            }
        }
    });
</script>
@endpush 