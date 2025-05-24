@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Telefon Detayları</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.phones.edit', $phone) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                        <a href="{{ route('admin.phones.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Geri
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Marka</th>
                                    <td>{{ $phone->marka }}</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td>{{ $phone->model }}</td>
                                </tr>
                                <tr>
                                    <th>IMEI</th>
                                    <td>{{ $phone->imei }}</td>
                                </tr>
                                <tr>
                                    <th>Seri No</th>
                                    <td>{{ $phone->seri_no }}</td>
                                </tr>
                                <tr>
                                    <th>Satış Tarihi</th>
                                    <td>{{ $phone->satis_tarihi->format('d.m.Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Fiyat</th>
                                    <td>{{ number_format($phone->fiyat, 2) }} ₺</td>
                                </tr>
                                <tr>
                                    <th>Durum</th>
                                    <td>
                                        <span class="badge badge-{{ $phone->durum === 'aktif' ? 'success' : ($phone->durum === 'pasif' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($phone->durum) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Abone</th>
                                    <td>
                                        @if($phone->subscriber)
                                            <a href="{{ route('admin.subscribers.show', $phone->subscriber) }}">
                                                {{ $phone->subscriber->ad }} {{ $phone->subscriber->soyad }}
                                            </a>
                                        @else
                                            <span class="text-muted">Atanmamış</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($phone->callLogs->count() > 0)
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
                                        @foreach($phone->callLogs as $log)
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 