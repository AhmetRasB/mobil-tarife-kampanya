@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kampanyalar</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.kampanyalar.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni Kampanya
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>İndirim Oranı</th>
                                <th>Başlangıç</th>
                                <th>Bitiş</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kampanyalar as $kampanya)
                            <tr>
                                <td>{{ $kampanya->id }}</td>
                                <td>{{ $kampanya->ad }}</td>
                                <td>%{{ $kampanya->indirim_orani }}</td>
                                <td>{{ $kampanya->baslangic_tarihi->format('d.m.Y') }}</td>
                                <td>{{ $kampanya->bitis_tarihi->format('d.m.Y') }}</td>
                                <td>
                                    @if($kampanya->aktif)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Pasif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.kampanyalar.edit', $kampanya) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.kampanyalar.destroy', $kampanya) }}" method="POST" class="d-inline">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 