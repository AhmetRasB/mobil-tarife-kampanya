@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SIM Kartlar</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.sim-cards.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni SIM Kart
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
                                <th>Numara</th>
                                <th>PUK</th>
                                <th>PIN</th>
                                <th>Aktivasyon Tarihi</th>
                                <th>Durum</th>
                                <th>Abone</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($simCards as $simCard)
                                <tr>
                                    <td>{{ $simCard->id }}</td>
                                    <td>{{ $simCard->numara }}</td>
                                    <td>{{ $simCard->puk }}</td>
                                    <td>{{ $simCard->pin }}</td>
                                    <td>{{ \Carbon\Carbon::parse($simCard->aktivasyon_tarihi)->format('d.m.Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $simCard->durum === 'aktif' ? 'success' : ($simCard->durum === 'pasif' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($simCard->durum) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($simCard->subscriber)
                                            {{ $simCard->subscriber->ad }} {{ $simCard->subscriber->soyad }}
                                        @else
                                            <span class="text-muted">Atanmamış</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.sim-cards.show', $simCard) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.sim-cards.edit', $simCard) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.sim-cards.destroy', $simCard) }}" method="POST" class="d-inline">
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
                        {{ $simCards->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 