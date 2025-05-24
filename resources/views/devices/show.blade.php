@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cihaz Detayları</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.devices.edit', $device) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                        <a href="{{ route('admin.devices.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Geri
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Ad</th>
                            <td>{{ $device->ad }}</td>
                        </tr>
                        <tr>
                            <th>Marka</th>
                            <td>{{ $device->marka }}</td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td>{{ $device->model }}</td>
                        </tr>
                        <tr>
                            <th>Seri No</th>
                            <td>{{ $device->seri_no }}</td>
                        </tr>
                        <tr>
                            <th>Satış Tarihi</th>
                            <td>{{ $device->satis_tarihi ? $device->satis_tarihi->format('d.m.Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Fiyat</th>
                            <td>{{ number_format($device->fiyat, 2) }} ₺</td>
                        </tr>
                        <tr>
                            <th>Durum</th>
                            <td>
                                <span class="badge badge-{{ $device->durum === 'aktif' ? 'success' : ($device->durum === 'pasif' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($device->durum) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Abone</th>
                            <td>
                                @if($device->subscriber)
                                    {{ $device->subscriber->ad }} {{ $device->subscriber->soyad }}
                                @else
                                    <span class="text-muted">Atanmamış</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 