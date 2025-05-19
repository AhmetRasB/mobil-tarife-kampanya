@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aboneler</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.subscribers.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni Abone
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
                                <th>Soyad</th>
                                <th>TC No</th>
                                <th>Telefon</th>
                                <th>E-posta</th>
                                <th>Kayıt Tarihi</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscribers as $subscriber)
                                <tr>
                                    <td>{{ $subscriber->id }}</td>
                                    <td>{{ $subscriber->ad }}</td>
                                    <td>{{ $subscriber->soyad }}</td>
                                    <td>{{ $subscriber->tc_no }}</td>
                                    <td>{{ $subscriber->telefon }}</td>
                                    <td>{{ $subscriber->eposta }}</td>
                                    <td>{{ $subscriber->kayit_tarihi->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $subscriber->aktif_mi ? 'success' : 'danger' }}">
                                            {{ $subscriber->aktif_mi ? 'Aktif' : 'Pasif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.subscribers.show', $subscriber) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.subscribers.edit', $subscriber) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST" class="d-inline">
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
                        {{ $subscribers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 