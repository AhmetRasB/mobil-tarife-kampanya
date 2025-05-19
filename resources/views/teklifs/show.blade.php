@extends(Auth::user() && Auth::user()->is_admin ? 'layouts.admin' : 'layouts.app')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('title', 'Teklif Detayları')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Teklif Detayları</h5>
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

                    <div class="mb-3">
                        <label class="form-label fw-bold">Teklif No</label>
                        <p>{{ $teklif->id }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Durum</label>
                        <p>
                            @if($teklif->durum == 'beklemede')
                                <span class="badge bg-warning">Beklemede</span>
                            @elseif($teklif->durum == 'onaylandi')
                                <span class="badge bg-success">Onaylandı</span>
                            @elseif($teklif->durum == 'reddedildi')
                                <span class="badge bg-danger">Reddedildi</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Ad Soyad</label>
                        <p>{{ $teklif->ad_soyad }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Telefon</label>
                        <p>{{ $teklif->telefon }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">E-posta</label>
                        <p>{{ $teklif->email }}</p>
                    </div>

                    @if($teklif->adres)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Adres</label>
                        <p>{{ $teklif->adres }}</p>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tarife</label>
                        <p>
                            @if($teklif->tarife)
                                {{ $teklif->tarife->ad }} - {{ number_format($teklif->tarife->fiyat, 2) }} TL
                            @else
                                <span class="text-muted">Tarife bulunamadı</span>
                            @endif
                        </p>
                    </div>

                    @if($teklif->kampanya)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kampanya</label>
                        <p>{{ $teklif->kampanya->ad }} ({{ $teklif->kampanya->indirim_orani }}% indirim)</p>
                    </div>
                    @endif

                    @if($teklif->notlar)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Notlar</label>
                        <p>{{ $teklif->notlar }}</p>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tarih</label>
                        <p>{{ $teklif->created_at->format('d.m.Y H:i') }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('teklifs.index') }}" class="btn btn-secondary">Geri</a>
                        
                        @if(Auth::user() && Auth::user()->is_admin && $teklif->durum == 'beklemede')
                        <div>
                            <form action="{{ route('teklifs.update', $teklif->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="durum" value="onaylandi">
                                <button type="submit" class="btn btn-success">Onayla</button>
                            </form>
                            
                            <form action="{{ route('teklifs.update', $teklif->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="durum" value="reddedildi">
                                <button type="submit" class="btn btn-danger">Reddet</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 