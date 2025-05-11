@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- User Info Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hoş Geldiniz, {{ auth()->user()->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Abone Bilgileriniz</h5>
                            @if(auth()->user()->subscriber)
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Ad Soyad</th>
                                        <td>{{ auth()->user()->subscriber->ad }} {{ auth()->user()->subscriber->soyad }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telefon</th>
                                        <td>{{ auth()->user()->subscriber->telefon }}</td>
                                    </tr>
                                    <tr>
                                        <th>E-posta</th>
                                        <td>{{ auth()->user()->subscriber->eposta }}</td>
                                    </tr>
                                </table>
                            @else
                                <p>Henüz abone bilgileriniz bulunmamaktadır.</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5>Aktif Abonelikleriniz</h5>
                            @if(auth()->user()->subscriber && auth()->user()->subscriber->subscriptions->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tarife</th>
                                                <th>Başlangıç</th>
                                                <th>Bitiş</th>
                                                <th>Durum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(auth()->user()->subscriber->subscriptions as $subscription)
                                                <tr>
                                                    <td>{{ $subscription->tarife_adi }}</td>
                                                    <td>{{ $subscription->baslangic_tarihi->format('d.m.Y') }}</td>
                                                    <td>{{ $subscription->bitis_tarihi->format('d.m.Y') }}</td>
                                                    <td>
                                                        @if($subscription->aktif_mi)
                                                            <span class="badge badge-success">Aktif</span>
                                                        @else
                                                            <span class="badge badge-danger">Pasif</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Aktif aboneliğiniz bulunmamaktadır.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Buttons -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hızlı Erişim</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Abone İşlemleri -->
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Abone İşlemleri</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block mb-2">
                                        <i class="fas fa-user-edit"></i> Profil Düzenle
                                    </a>
                                    <a href="{{ route('subscriptions.my-subscriptions') }}" class="btn btn-info btn-block">
                                        <i class="fas fa-list"></i> Aboneliklerim
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Cihaz İşlemleri -->
                        <div class="col-md-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Cihaz İşlemleri</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('phones.my-phones') }}" class="btn btn-success btn-block mb-2">
                                        <i class="fas fa-mobile-alt"></i> Telefonlarım
                                    </a>
                                    <a href="{{ route('sim-cards.my-sim-cards') }}" class="btn btn-success btn-block">
                                        <i class="fas fa-sim-card"></i> SIM Kartlarım
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- İletişim Servisleri -->
                        <div class="col-md-4">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">İletişim Servisleri</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('sms-logs.my-sms-logs') }}" class="btn btn-warning btn-block mb-2">
                                        <i class="fas fa-sms"></i> SMS Geçmişim
                                    </a>
                                    <a href="{{ route('call-logs.my-call-logs') }}" class="btn btn-warning btn-block">
                                        <i class="fas fa-phone"></i> Arama Geçmişim
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Destek -->
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Destek</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('support.tickets.create') }}" class="btn btn-info btn-block mb-2">
                                        <i class="fas fa-ticket-alt"></i> Yeni Destek Talebi
                                    </a>
                                    <a href="{{ route('support.tickets.index') }}" class="btn btn-info btn-block">
                                        <i class="fas fa-list"></i> Destek Taleplerim
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Faturalar -->
                        <div class="col-md-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Faturalar</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('invoices.index') }}" class="btn btn-danger btn-block mb-2">
                                        <i class="fas fa-file-invoice"></i> Faturalarım
                                    </a>
                                    <a href="{{ route('payments.index') }}" class="btn btn-danger btn-block">
                                        <i class="fas fa-credit-card"></i> Ödemelerim
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
@endsection
