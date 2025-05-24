@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Abonelik Detayları</h3>
                    <div class="card-tools">
                        <a href="{{ route('subscriptions.edit', $subscription) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                        <a href="{{ route('admin.abonelikler.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Geri
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Abone</th>
                            <td>
                                @if($subscription->subscriber)
                                    {{ $subscription->subscriber->ad }} {{ $subscription->subscriber->soyad }}
                                @else
                                    <span class="text-muted">Atanmamış</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tarife Adı</th>
                            <td>{{ $subscription->tarife_adi }}</td>
                        </tr>
                        <tr>
                            <th>Aylık Ücret</th>
                            <td>{{ number_format($subscription->aylik_ucret, 2) }} ₺</td>
                        </tr>
                        <tr>
                            <th>Başlangıç Tarihi</th>
                            <td>{{ $subscription->baslangic_tarihi ? $subscription->baslangic_tarihi->format('d.m.Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Bitiş Tarihi</th>
                            <td>{{ $subscription->bitis_tarihi ? $subscription->bitis_tarihi->format('d.m.Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Durum</th>
                            <td>
                                <span class="badge badge-{{ $subscription->aktif_mi ? 'success' : 'danger' }}">
                                    {{ $subscription->aktif_mi ? 'Aktif' : 'Pasif' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 