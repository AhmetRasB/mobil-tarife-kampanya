@extends(Auth::user() && Auth::user()->is_admin ? 'layouts.admin' : 'layouts.app')

@section('title', Auth::user() && !Auth::user()->is_admin ? 'Aboneliklerim' : 'Abonelikler')

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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Abonelikler</h3>
                    @if(Auth::user() && Auth::user()->is_admin)
                        <a href="{{ route('abonelikler.create') }}" class="btn btn-primary btn-sm">Yeni Abonelik</a>
                    @endif
                </div>
                <div class="card-body">
                    @if(count($abonelikler) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        
                                        <th>Tarife</th>
                                        <th>Kampanya</th>
                                        <th>Başlangıç</th>
                                        <th>Bitiş</th>
                                        <th>Durum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($abonelikler as $abonelik)
                                    <tr>
                                        <td>{{ $abonelik->id }}</td>
                                       
                                        <td>{{ $abonelik->tarife ? $abonelik->tarife->ad : '-' }}</td>
                                        <td>{{ $abonelik->kampanya ? $abonelik->kampanya->ad : '-' }}</td>
                                        <td>{{ $abonelik->baslangic_tarihi ? $abonelik->baslangic_tarihi->format('d.m.Y') : '-' }}</td>
                                        <td>{{ $abonelik->bitis_tarihi ? $abonelik->bitis_tarihi->format('d.m.Y') : '-' }}</td>
                                        <td>
                                            <span class="badge {{ $abonelik->aktif ? 'bg-success' : 'bg-danger' }}">
                                                {{ $abonelik->aktif ? 'Aktif' : 'Pasif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                @if(Auth::user() && Auth::user()->is_admin)
                                                    <a href="{{ route('admin.abonelikler.show', $abonelik) }}" class="btn btn-info btn-sm">Detay</a>
                                                    <a href="{{ route('admin.abonelikler.edit', $abonelik) }}" class="btn btn-primary btn-sm">Düzenle</a>
                                                    <form action="{{ route('admin.abonelikler.destroy', $abonelik) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu aboneliği silmek istediğinizden emin misiniz?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Sil</button>
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
                            {{ $abonelikler->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            Abonelik bulunamadı.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 