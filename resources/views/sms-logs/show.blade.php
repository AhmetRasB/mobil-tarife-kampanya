@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SMS Kaydı Detayları</h3>
                    <div class="card-tools">
                        <a href="{{ route('sms-logs.edit', $smsLog) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                        <a href="{{ route('sms-logs.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Geri
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">ID</th>
                                    <td>{{ $smsLog->id }}</td>
                                </tr>
                                <tr>
                                    <th>SIM Kart</th>
                                    <td>
                                        @if($smsLog->simCard)
                                            <a href="{{ route('sim-cards.show', $smsLog->simCard) }}">
                                                {{ $smsLog->simCard->numara }}
                                            </a>
                                        @else
                                            <span class="text-muted">Silinmiş SIM Kart</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Alıcı</th>
                                    <td>{{ $smsLog->alici }}</td>
                                </tr>
                                <tr>
                                    <th>Mesaj</th>
                                    <td>{{ $smsLog->mesaj }}</td>
                                </tr>
                                <tr>
                                    <th>Tarih</th>
                                    <td>{{ $smsLog->tarih->format('d.m.Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Durum</th>
                                    <td>
                                        <span class="badge badge-{{ $smsLog->durum === 'gonderildi' ? 'success' : 'danger' }}">
                                            {{ ucfirst($smsLog->durum) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($smsLog->simCard && $smsLog->simCard->subscriber)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>Abone Bilgileri</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 200px;">Ad Soyad</th>
                                        <td>{{ $smsLog->simCard->subscriber->ad }} {{ $smsLog->simCard->subscriber->soyad }}</td>
                                    </tr>
                                    <tr>
                                        <th>TC No</th>
                                        <td>{{ $smsLog->simCard->subscriber->tc_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telefon</th>
                                        <td>{{ $smsLog->simCard->subscriber->telefon }}</td>
                                    </tr>
                                    <tr>
                                        <th>E-posta</th>
                                        <td>{{ $smsLog->simCard->subscriber->eposta }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 