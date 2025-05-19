@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Hızlı Erişim (Quick Access) -->
    <div class="row mb-4">
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.users.index') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-users fa-2x mb-2"></i>
                    <div>Kullanıcılar</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.roles.index') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-user-shield fa-2x mb-2"></i>
                    <div>Roller</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.subscribers.index') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-user-friends fa-2x mb-2"></i>
                    <div>Aboneler</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.abonelikler.index') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-file-contract fa-2x mb-2"></i>
                    <div>Abonelikler</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.phones.index') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-mobile-alt fa-2x mb-2"></i>
                    <div>Telefonlar</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.sim-cards.index') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-sim-card fa-2x mb-2"></i>
                    <div>SIM Kartlar</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.devices.index') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-tablet-alt fa-2x mb-2"></i>
                    <div>Cihazlar</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.invoices.index') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-file-invoice fa-2x mb-2"></i>
                    <div>Faturalar</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.reports.subscribers') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-chart-bar fa-2x mb-2"></i>
                    <div>Abone Raporları</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.reports.stock') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-boxes fa-2x mb-2"></i>
                    <div>Stok Raporları</div>
                </div>
            </a>
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.settings.general') }}" class="card text-center shadow-sm h-100 text-decoration-none text-dark">
                <div class="card-body">
                    <i class="fas fa-cog fa-2x mb-2"></i>
                    <div>Ayarlar</div>
                </div>
            </a>
        </div>
    </div>
    <!-- END Hızlı Erişim -->

    @yield('dashboard_stats')
    <!-- The rest of the dashboard content follows... -->

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
                            <span>{{ $user->name ?? '-' }}</span>
                            <span class="badge bg-primary">{{ $user->created_at ? $user->created_at->format('d.m.Y') : '-' }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Statistics Row -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalInvoices }}</h3>
                    <p>Toplam Fatura</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <a href="{{ route('admin.invoices.index') }}" class="small-box-footer">
                    Detayları Gör <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $paidInvoices }}</h3>
                    <p>Ödenmiş Fatura</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="{{ route('admin.invoices.index', ['status' => 'paid']) }}" class="small-box-footer">
                    Detayları Gör <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $unpaidInvoices }}</h3>
                    <p>Ödenmemiş Fatura</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <a href="{{ route('admin.invoices.index', ['status' => 'unpaid']) }}" class="small-box-footer">
                    Detayları Gör <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $suspendedInvoices }}</h3>
                    <p>Askıya Alınmış</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ban"></i>
                </div>
                <a href="{{ route('admin.invoices.index', ['status' => 'suspended']) }}" class="small-box-footer">
                    Detayları Gör <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Invoices -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Son Faturalar</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.invoices.index') }}" class="btn btn-tool">
                            <i class="fas fa-list"></i> Tümünü Gör
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Fatura No</th>
                                <th>Müşteri</th>
                                <th>Tutar</th>
                                <th>Son Ödeme Tarihi</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentInvoices as $invoice)
                                <tr>
                                    <td>#{{ $invoice->id }}</td>
                                    <td>{{ optional($invoice->subscriber)->name ?? '-' }}</td>
                                    <td>{{ number_format($invoice->amount, 2) }} ₺</td>
                                    <td>{{ $invoice->due_date ? $invoice->due_date->format('d.m.Y') : '-' }}</td>
                                    <td>
                                        @if($invoice->status === 'paid')
                                            <span class="badge badge-success">Ödendi</span>
                                        @elseif($invoice->status === 'suspended')
                                            <span class="badge badge-danger">Askıya Alındı</span>
                                        @else
                                            <span class="badge badge-warning">Ödenmedi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.invoices.index') }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Henüz fatura bulunmuyor.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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