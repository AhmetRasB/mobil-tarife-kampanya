@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Abonelikler</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.abonelikler.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni Abonelik
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
                                <th>Abone</th>
                                <th>Tarife</th>
                                <th>Aylık Ücret</th>
                                <th>Başlangıç</th>
                                <th>Bitiş</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscriptions as $subscription)
                                <tr>
                                    <td>{{ $subscription->id }}</td>
                                    <td>
                                        @if($subscription->subscriber)
                                            {{ $subscription->subscriber->ad }} {{ $subscription->subscriber->soyad }}
                                        @else
                                            <span class="text-muted">Atanmamış</span>
                                        @endif
                                    </td>
                                    <td>{{ $subscription->tarife_adi }}</td>
                                    <td>{{ number_format($subscription->aylik_ucret, 2) }} ₺</td>
                                    <td>{{ $subscription->baslangic_tarihi ? $subscription->baslangic_tarihi->format('d.m.Y') : '-' }}</td>
                                    <td>{{ $subscription->bitis_tarihi ? $subscription->bitis_tarihi->format('d.m.Y') : '-' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $subscription->aktif_mi ? 'success' : 'danger' }}">
                                            {{ $subscription->aktif_mi ? 'Aktif' : 'Pasif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.abonelikler.show', $subscription) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.abonelikler.edit', $subscription) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.abonelikler.destroy', $subscription) }}" method="POST" class="d-inline">
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
                        {{ $subscriptions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 