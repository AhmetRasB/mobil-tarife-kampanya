@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Abonelikler</h3>
                    <a href="{{ route('admin.abonelikler.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni Abonelik
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Müşteri ID</th>
                                    <th>Müşteri Adı</th>
                                    <th>Telefon</th>
                                    <th>Email</th>
                                    <th>Tarife</th>
                                    <th>Kampanya</th>
                                    <th>Başlangıç</th>
                                    <th>Bitiş</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($abonelikler as $abonelik)
                                <tr>
                                    <td>{{ $abonelik->id }}</td>
                                    <td>{{ $abonelik->user_id }}</td>
                                    <td>{{ $abonelik->musteri_adi }}</td>
                                    <td>{{ $abonelik->telefon }}</td>
                                    <td>{{ $abonelik->email }}</td>
                                    <td>{{ optional($abonelik->tarife)->ad ?? '-' }}</td>
                                    <td>{{ optional($abonelik->kampanya)->ad ?? '-' }}</td>
                                    <td>{{ $abonelik->baslangic_tarihi ? $abonelik->baslangic_tarihi->format('d.m.Y') : '-' }}</td>
                                    <td>{{ $abonelik->bitis_tarihi ? $abonelik->bitis_tarihi->format('d.m.Y') : '-' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $abonelik->aktif ? 'success' : 'danger' }}">
                                            {{ $abonelik->aktif ? 'Aktif' : 'Pasif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.abonelikler.show', $abonelik) }}" 
                                               class="btn btn-info btn-sm" 
                                               title="Detay">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.abonelikler.edit', $abonelik) }}" 
                                               class="btn btn-warning btn-sm" 
                                               title="Düzenle">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.abonelikler.destroy', $abonelik) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm" 
                                                        title="Sil"
                                                        onclick="return confirm('Bu aboneliği silmek istediğinize emin misiniz?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $abonelikler->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 