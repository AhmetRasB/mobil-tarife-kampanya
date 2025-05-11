@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Quick Stats Row -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\Subscriber::count() }}</h3>
                    <p>Toplam Abone</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('subscribers.index') }}" class="small-box-footer">
                    Detaylar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ \App\Models\Phone::count() }}</h3>
                    <p>Toplam Telefon</p>
                </div>
                <div class="icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <a href="{{ route('phones.index') }}" class="small-box-footer">
                    Detaylar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\SimCard::count() }}</h3>
                    <p>Toplam SIM Kart</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sim-card"></i>
                </div>
                <a href="{{ route('sim-cards.index') }}" class="small-box-footer">
                    Detaylar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\Organization::count() }}</h3>
                    <p>Toplam Kurum</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{ route('organizations.index') }}" class="small-box-footer">
                    Detaylar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Access Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hızlı Erişim</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Abone İşlemleri -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="card-title">
                                        <i class="fas fa-users"></i> Abone İşlemleri
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('subscribers.create') }}" class="btn btn-primary btn-block mb-2">
                                        <i class="fas fa-user-plus"></i> Yeni Abone Ekle
                                    </a>
                                    <a href="{{ route('subscriptions.create') }}" class="btn btn-info btn-block mb-2">
                                        <i class="fas fa-plus-circle"></i> Yeni Abonelik Oluştur
                                    </a>
                                    <a href="{{ route('subscribers.index') }}" class="btn btn-secondary btn-block">
                                        <i class="fas fa-list"></i> Abone Listesi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Cihaz İşlemleri -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-success">
                                    <h3 class="card-title">
                                        <i class="fas fa-mobile-alt"></i> Cihaz İşlemleri
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('phones.create') }}" class="btn btn-success btn-block mb-2">
                                        <i class="fas fa-plus"></i> Yeni Telefon Ekle
                                    </a>
                                    <a href="{{ route('sim-cards.create') }}" class="btn btn-info btn-block mb-2">
                                        <i class="fas fa-plus"></i> Yeni SIM Kart Ekle
                                    </a>
                                    <a href="{{ route('devices.index') }}" class="btn btn-secondary btn-block">
                                        <i class="fas fa-list"></i> Cihaz Listesi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- İletişim Servisleri -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h3 class="card-title">
                                        <i class="fas fa-comments"></i> İletişim Servisleri
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('sms-logs.create') }}" class="btn btn-info btn-block mb-2">
                                        <i class="fas fa-sms"></i> Yeni SMS Gönder
                                    </a>
                                    <a href="{{ route('fax-logs.create') }}" class="btn btn-secondary btn-block mb-2">
                                        <i class="fas fa-fax"></i> Yeni Faks Gönder
                                    </a>
                                    <a href="{{ route('sms-logs.index') }}" class="btn btn-secondary btn-block">
                                        <i class="fas fa-list"></i> SMS Logları
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Stok İşlemleri -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-warning">
                                    <h3 class="card-title">
                                        <i class="fas fa-boxes"></i> Stok İşlemleri
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('assets.create') }}" class="btn btn-warning btn-block mb-2">
                                        <i class="fas fa-plus"></i> Yeni Varlık Ekle
                                    </a>
                                    <a href="{{ route('stock-movements.create') }}" class="btn btn-info btn-block mb-2">
                                        <i class="fas fa-exchange-alt"></i> Stok Hareketi
                                    </a>
                                    <a href="{{ route('assets.index') }}" class="btn btn-secondary btn-block">
                                        <i class="fas fa-list"></i> Stok Listesi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Organizasyon -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-danger">
                                    <h3 class="card-title">
                                        <i class="fas fa-building"></i> Organizasyon
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('organizations.create') }}" class="btn btn-danger btn-block mb-2">
                                        <i class="fas fa-plus"></i> Yeni Organizasyon
                                    </a>
                                    <a href="{{ route('locations.create') }}" class="btn btn-info btn-block mb-2">
                                        <i class="fas fa-map-marker-alt"></i> Yeni Lokasyon
                                    </a>
                                    <a href="{{ route('organizations.index') }}" class="btn btn-secondary btn-block">
                                        <i class="fas fa-list"></i> Organizasyon Listesi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Sistem Ayarları -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-secondary">
                                    <h3 class="card-title">
                                        <i class="fas fa-cogs"></i> Sistem Ayarları
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('api-settings.index') }}" class="btn btn-info btn-block mb-2">
                                        <i class="fas fa-plug"></i> API Ayarları
                                    </a>
                                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-block mb-2">
                                        <i class="fas fa-users-cog"></i> Kullanıcı Yönetimi
                                    </a>
                                    <a href="{{ route('system-settings.general') }}" class="btn btn-secondary btn-block">
                                        <i class="fas fa-cog"></i> Genel Ayarlar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Raporlar -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-bar"></i> Raporlar
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('reports.subscribers') }}" class="btn btn-primary btn-block mb-2">
                                        <i class="fas fa-users"></i> Abone Raporları
                                    </a>
                                    <a href="{{ route('reports.stock') }}" class="btn btn-warning btn-block mb-2">
                                        <i class="fas fa-boxes"></i> Stok Raporları
                                    </a>
                                    <a href="{{ route('reports.financial') }}" class="btn btn-success btn-block">
                                        <i class="fas fa-money-bill-wave"></i> Finansal Raporlar
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Rol ve İzin Yönetimi -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-purple">
                                    <h3 class="card-title">
                                        <i class="fas fa-user-shield"></i> Rol ve İzin Yönetimi
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('roles.index') }}" class="btn btn-purple btn-block mb-2">
                                        <i class="fas fa-user-tag"></i> Roller
                                    </a>
                                    <a href="{{ route('roles.create') }}" class="btn btn-info btn-block mb-2">
                                        <i class="fas fa-plus"></i> Yeni Rol Oluştur
                                    </a>
                                    <a href="{{ route('users.create') }}" class="btn btn-secondary btn-block">
                                        <i class="fas fa-user-plus"></i> Yeni Kullanıcı Ekle
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.bg-purple {
    background-color: #6f42c1 !important;
}
.btn-purple {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: white;
}
.btn-purple:hover {
    background-color: #5a32a3;
    border-color: #5a32a3;
    color: white;
}
</style>
@endpush
@endsection 