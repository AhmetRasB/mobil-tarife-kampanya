@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="info-box bg-primary text-white">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Toplam Kullanıcı</span>
                    <span class="info-box-number">{{ $totalUsers }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-success text-white">
                <span class="info-box-icon"><i class="fas fa-percent"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Toplam Kampanya</span>
                    <span class="info-box-number">{{ $totalKampanyalar }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-info text-white">
                <span class="info-box-icon"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Toplam Tarife</span>
                    <span class="info-box-number">{{ $totalTarifeler }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-warning text-white">
                <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Toplam Abonelik</span>
                    <span class="info-box-number">{{ $totalAbonelikler }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Son 30 Günde Yeni Kullanıcılar</h5>
                </div>
                <div class="card-body">
                    <canvas id="userChart" height="120"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Son 5 Yeni Kullanıcı</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($recentUsers as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $user->name }}</span>
                            <span class="badge bg-primary">{{ $user->created_at->format('d.m.Y') }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart').getContext('2d');
    const userStats = @json($userStats);
    const labels = userStats.map(item => item.date);
    const data = userStats.map(item => item.count);
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Yeni Kullanıcı',
                data: data,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0,123,255,0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { title: { display: true, text: 'Tarih' } },
                y: { title: { display: true, text: 'Kullanıcı Sayısı' }, beginAtZero: true }
            }
        }
    });
</script>
@endpush 