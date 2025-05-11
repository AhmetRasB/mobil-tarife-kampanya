@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Telefonlar</h3>
                    <div class="card-tools">
                        <a href="{{ route('phones.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni Telefon
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
                                <th>Marka</th>
                                <th>Model</th>
                                <th>IMEI</th>
                                <th>Seri No</th>
                                <th>Satış Tarihi</th>
                                <th>Fiyat</th>
                                <th>Durum</th>
                                <th>Abone</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($phones as $phone)
                                <tr>
                                    <td>{{ $phone->id }}</td>
                                    <td>{{ $phone->marka }}</td>
                                    <td>{{ $phone->model }}</td>
                                    <td>{{ $phone->imei }}</td>
                                    <td>{{ $phone->seri_no }}</td>
                                    <td>{{ $phone->satis_tarihi->format('d.m.Y') }}</td>
                                    <td>{{ number_format($phone->fiyat, 2) }} ₺</td>
                                    <td>
                                        <span class="badge badge-{{ $phone->durum === 'aktif' ? 'success' : ($phone->durum === 'pasif' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($phone->durum) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($phone->subscriber)
                                            {{ $phone->subscriber->ad }} {{ $phone->subscriber->soyad }}
                                        @else
                                            <span class="text-muted">Atanmamış</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('phones.show', $phone) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('phones.edit', $phone) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('phones.destroy', $phone) }}" method="POST" class="d-inline">
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
                        {{ $phones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 