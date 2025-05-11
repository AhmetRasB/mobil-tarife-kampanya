@extends('layouts.app')

@section('title', 'Tarifeler')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tarifeler</h5>
                    @if(Auth::user() && Auth::user()->is_admin)
                    <a href="{{ route('admin.tarifeler.create') }}" class="btn btn-primary btn-sm">Yeni Tarife</a>
                    @endif
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tarife Adı</th>
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
                                    <td>{{ number_format($tarife->fiyat, 2) }} TL</td>
                                    <td>{{ $tarife->internet_miktari }} GB</td>
                                    <td>{{ $tarife->dakika_miktari }} DK</td>
                                    <td>{{ $tarife->sms_miktari }} SMS</td>
                                    <td>
                                        <span class="badge {{ $tarife->aktif ? 'bg-success' : 'bg-danger' }}">
                                            {{ $tarife->aktif ? 'Aktif' : 'Pasif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('tarifeler.show', $tarife) }}" class="btn btn-sm btn-info">Detay</a>
                                            @if(Auth::user() && Auth::user()->is_admin)
                                            <a href="{{ route('admin.tarifeler.edit', $tarife) }}" class="btn btn-sm btn-primary">Düzenle</a>
                                            <form action="{{ route('admin.tarifeler.destroy', $tarife->id) }}" method="POST" onsubmit="return confirm('Bu tarifeyi silmek istediğinize emin misiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $tarifeler->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection