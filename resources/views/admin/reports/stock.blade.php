@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tablet-alt fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Cihazlar</h5>
                            <h3 class="mb-0">{{ $stockByType['devices']['available'] }} / {{ $stockByType['devices']['total'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-mobile-alt fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Telefonlar</h5>
                            <h3 class="mb-0">{{ $stockByType['phones']['available'] }} / {{ $stockByType['phones']['total'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-sim-card fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">SIM Kartlar</h5>
                            <h3 class="mb-0">{{ $stockByType['sim_cards']['available'] }} / {{ $stockByType['sim_cards']['total'] }}</h3>
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
                    <h3 class="card-title">Stok Durumu</h3>
                </div>
                <div class="card-body">
                    <canvas id="stockChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const stockLabels = ['Cihazlar', 'Telefonlar', 'SIM Kartlar'];
    const totalStock = [
        {{ $stockByType['devices']['total'] }},
        {{ $stockByType['phones']['total'] }},
        {{ $stockByType['sim_cards']['total'] }}
    ];
    const availableStock = [
        {{ $stockByType['devices']['available'] }},
        {{ $stockByType['phones']['available'] }},
        {{ $stockByType['sim_cards']['available'] }}
    ];
    new Chart(document.getElementById('stockChart'), {
        type: 'bar',
        data: {
            labels: stockLabels,
            datasets: [
                {
                    label: 'Toplam',
                    data: totalStock,
                    backgroundColor: 'rgba(0,123,255,0.5)'
                },
                {
                    label: 'Mevcut',
                    data: availableStock,
                    backgroundColor: 'rgba(40,167,69,0.5)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
            }
        }
    });
</script>
@endpush 