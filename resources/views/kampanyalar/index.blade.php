@extends('layouts.app')

@section('title', 'Kampanyalar')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Kampanyalar</h5>
                    @if(Auth::user() && Auth::user()->is_admin)
                    <a href="{{ route('admin.kampanyalar.create') }}" class="btn btn-primary btn-sm">Yeni Kampanya</a>
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
                                    <th>Kampanya Adı</th>
                                    <th>Başlangıç</th>
                                    <th>Bitiş</th>
                                    <th>İndirim</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kampanyalar as $kampanya)
                                <tr>
                                    <td>{{ $kampanya->id }}</td>
                                    <td>{{ $kampanya->ad }}</td>
                                    <td>{{ $kampanya->baslangic_tarihi->format('d.m.Y') }}</td>
                                    <td>{{ $kampanya->bitis_tarihi->format('d.m.Y') }}</td>
                                    <td>%{{ $kampanya->indirim_orani }}</td>
                                    <td>
                                        <span class="badge {{ $kampanya->aktif ? 'bg-success' : 'bg-danger' }}">
                                            {{ $kampanya->aktif ? 'Aktif' : 'Pasif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('kampanyalar.show', $kampanya) }}" class="btn btn-sm btn-info">Detay</a>
                                            @if(Auth::user() && Auth::user()->is_admin)
                                            <a href="{{ route('admin.kampanyalar.edit', $kampanya) }}" class="btn btn-sm btn-primary">Düzenle</a>
                                            <form action="{{ route('admin.kampanyalar.destroy', $kampanya->id) }}" method="POST" onsubmit="return confirm('Bu kampanyayı silmek istediğinize emin misiniz?');">
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
                        {{ $kampanyalar->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection