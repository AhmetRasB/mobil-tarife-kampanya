@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">{{ __('Mevcut Tarifelerimiz') }}</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($tarifeler as $tarife)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">{{ $tarife->ad }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                İnternet
                                                <span class="badge bg-primary rounded-pill">{{ $tarife->internet_miktari }} GB</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Dakika
                                                <span class="badge bg-primary rounded-pill">{{ $tarife->dakika_miktari }} DK</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                SMS
                                                <span class="badge bg-primary rounded-pill">{{ $tarife->sms_miktari }} SMS</span>
                                            </li>
                                            <li class="list-group-item">
                                                <h4 class="text-center mt-2">{{ number_format($tarife->fiyat, 2) }} TL/ay</h4>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer bg-white border-0 text-center">
                                        <a href="{{ route('create-teklif', ['tarife_id' => $tarife->id]) }}" class="btn btn-primary">Teklif Oluştur</a>
                                        <a href="{{ route('tarifeler.show', $tarife->id) }}" class="btn btn-outline-primary">Detaylar</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Mevcut Kampanyalarımız') }}</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($kampanyalar as $kampanya)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">{{ $kampanya->ad }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $kampanya->aciklama }}</p>
                                        <h5 class="text-success">%{{ $kampanya->indirim_orani }} İndirim</h5>
                                        <p class="text-muted">
                                            {{ date('d.m.Y', strtotime($kampanya->baslangic_tarihi)) }} - 
                                            {{ date('d.m.Y', strtotime($kampanya->bitis_tarihi)) }}
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white border-0 text-center">
                                        <a href="{{ route('kampanyalar.show', $kampanya->id) }}" class="btn btn-success">Detaylar</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 