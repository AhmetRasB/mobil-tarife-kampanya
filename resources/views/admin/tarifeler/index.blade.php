@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tarifeler</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.tarifeler.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni Tarife
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>Fiyat</th>
                                <th>İnternet</th>
                                <th>Dakika</th>
                                <th>SMS</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tarifeler as $tarife)
                            <tr>
                                <td>{{ $tarife->id }}</td>
                                <td>{{ $tarife->ad }}</td>
                                <td>{{ $tarife->fiyat }} TL</td>
                                <td>{{ $tarife->internet_miktari }} GB</td>
                                <td>{{ $tarife->dakika_miktari }} DK</td>
                                <td>{{ $tarife->sms_miktari }} SMS</td>
                                <td>
                                    @if($tarife->aktif)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Pasif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.tarifeler.edit', $tarife) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.tarifeler.destroy', $tarife) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Emin misiniz?')">
                                            <i class="fas fa-trash"></i> Sil
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $tarifeler->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 