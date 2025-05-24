@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cihazlar</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.devices.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni Cihaz
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>Marka</th>
                                <th>Model</th>
                                <th>Seri No</th>
                                <th>Satış Tarihi</th>
                                <th>Fiyat</th>
                                <th>Durum</th>
                                <th>Abone</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    <td>{{ $device->id }}</td>
                                    <td>{{ $device->ad }}</td>
                                    <td>{{ $device->marka }}</td>
                                    <td>{{ $device->model }}</td>
                                    <td>{{ $device->seri_no }}</td>
                                    <td>{{ $device->satis_tarihi ? $device->satis_tarihi->format('d.m.Y') : '-' }}</td>
                                    <td>{{ number_format($device->fiyat, 2) }} ₺</td>
                                    <td>
                                        <span class="badge badge-{{ $device->durum === 'aktif' ? 'success' : ($device->durum === 'pasif' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($device->durum) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($device->subscriber)
                                            {{ $device->subscriber->ad }} {{ $device->subscriber->soyad }}
                                        @else
                                            <span class="text-muted">Atanmamış</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.devices.show', $device) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.devices.edit', $device) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.devices.destroy', $device) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Emin misiniz?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $devices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 