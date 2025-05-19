@extends(Auth::user() && Auth::user()->is_admin ? 'layouts.admin' : 'layouts.app')

@section('title', 'Teklifler')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Teklifler') }}</span>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ad Soyad</th>
                                    <th>Tarife</th>
                                    <th>Kampanya</th>
                                    <th>Durum</th>
                                    <th>Tarih</th>
                                    <th width="150">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teklifs as $teklif)
                                <tr>
                                    <td>{{ $teklif->id }}</td>
                                    <td>{{ $teklif->ad_soyad }}</td>
                                    <td>
                                        @if($teklif->tarife)
                                            {{ $teklif->tarife->ad }}
                                        @else
                                            <span class="text-muted">Tarife bulunamadı</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($teklif->kampanya)
                                            {{ $teklif->kampanya->ad }}
                                        @else
                                            <span class="text-muted">Yok</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($teklif->durum == 'beklemede')
                                            <span class="badge bg-warning">Beklemede</span>
                                        @elseif($teklif->durum == 'onaylandi')
                                            <span class="badge bg-success">Onaylandı</span>
                                        @elseif($teklif->durum == 'reddedildi')
                                            <span class="badge bg-danger">Reddedildi</span>
                                        @endif
                                    </td>
                                    <td>{{ $teklif->created_at->format('d.m.Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('teklifs.show', $teklif->id) }}" class="btn btn-info btn-sm">Detay</a>
                                            
                                            @if(Auth::user() && (Auth::user()->is_admin || $teklif->user_id == Auth::id()))
                                                <form action="{{ route('teklifs.destroy', $teklif->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu teklifi silmek istediğinizden emin misiniz?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Henüz teklif bulunmuyor.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $teklifs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 