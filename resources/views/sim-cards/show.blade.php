@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SIM Kart Detayları</h3>
                    <div class="card-tools">
                        <a href="{{ route('sim-cards.edit', $simCard) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                        <a href="{{ route('sim-cards.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Geri
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Numara</th>
                                    <td>{{ $simCard->numara }}</td>
                                </tr>
                                <tr>
                                    <th>PUK</th>
                                    <td>{{ $simCard->puk }}</td>
                                </tr>
                                <tr>
                                    <th>PIN</th>
                                    <td>{{ $simCard->pin }}</td>
                                </tr>
                                <tr>
                                    <th>Aktivasyon Tarihi</th>
                                    <td>{{ $simCard->aktivasyon_tarihi->format('d.m.Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Durum</th>
                                    <td>
                                        <span class="badge badge-{{ $simCard->durum === 'aktif' ? 'success' : ($simCard->durum === 'pasif' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($simCard->durum) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Abone</th>
                                    <td>
                                        @if($simCard->subscriber)
                                            <a href="{{ route('subscribers.show', $simCard->subscriber) }}">
                                                {{ $simCard->subscriber->ad }} {{ $simCard->subscriber->soyad }}
                                            </a>
                                        @else
                                            <span class="text-muted">Atanmamış</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($simCard->callLogs->count() > 0)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>Arama Kayıtları</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>Numara</th>
                                            <th>Süre</th>
                                            <th>Tip</th>
                                            <th>Durum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($simCard->callLogs as $log)
                                            <tr>
                                                <td>{{ $log->tarih->format('d.m.Y H:i') }}</td>
                                                <td>{{ $log->numara }}</td>
                                                <td>{{ $log->sure }} saniye</td>
                                                <td>{{ ucfirst($log->tip) }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $log->durum === 'basarili' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($log->durum) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if($simCard->smsLogs->count() > 0)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>SMS Kayıtları</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>Alıcı</th>
                                            <th>Mesaj</th>
                                            <th>Durum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($simCard->smsLogs as $log)
                                            <tr>
                                                <td>{{ $log->tarih->format('d.m.Y H:i') }}</td>
                                                <td>{{ $log->alici }}</td>
                                                <td>{{ Str::limit($log->mesaj, 50) }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $log->durum === 'gonderildi' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($log->durum) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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