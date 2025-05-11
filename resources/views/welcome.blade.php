@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body text-center p-5">
                    <h1 class="display-4 mb-4">Mobil Tarife ve Kampanya Platformu</h1>
                    <p class="lead">Size en uygun tarife ve kampanyaları keşfedin, tekliflerinizi oluşturun.</p>
                    
                    @guest
                        <div class="mt-4">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-2">Giriş Yap</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg mx-2">Kayıt Ol</a>
                        </div>
                    @else
                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Panele Git</a>
                        </div>
                    @endguest
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>Popüler Tarifeler</h3>
                        </div>
                        <div class="card-body">
                            @if(count($tarifeler) > 0)
                                <div class="row">
                                    @foreach($tarifeler as $tarife)
                                        <div class="col-md-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-header bg-primary text-white">
                                                    {{ $tarife->ad }}
                                                </div>
                                                <div class="card-body">
                                                    <p class="mb-1">İnternet: {{ $tarife->internet_miktari }} GB</p>
                                                    <p class="mb-1">Dakika: {{ $tarife->dakika_miktari }} DK</p>
                                                    <p class="mb-1">SMS: {{ $tarife->sms_miktari }} SMS</p>
                                                    <h5 class="mt-2">{{ number_format($tarife->fiyat, 2) }} TL/ay</h5>
                                                </div>
                                                <div class="card-footer bg-white">
                                                    @guest
                                                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Teklif Al</a>
                                                    @else
                                                        <a href="{{ route('create-teklif', ['tarife_id' => $tarife->id]) }}" class="btn btn-sm btn-primary">Teklif Al</a>
                                                    @endguest
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Henüz tarife bulunmuyor. Lütfen daha sonra tekrar kontrol edin.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Güncel Kampanyalar</h3>
                        </div>
                        <div class="card-body">
                            @if(count($kampanyalar) > 0)
                                <div class="row">
                                    @foreach($kampanyalar as $kampanya)
                                        <div class="col-md-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-header bg-success text-white">
                                                    {{ $kampanya->ad }}
                                                </div>
                                                <div class="card-body">
                                                    <p>{{ \Illuminate\Support\Str::limit($kampanya->aciklama, 100) }}</p>
                                                    <h5 class="text-success">%{{ $kampanya->indirim_orani }} İndirim</h5>
                                                </div>
                                                <div class="card-footer bg-white">
                                                    @guest
                                                        <a href="{{ route('login') }}" class="btn btn-sm btn-success">Detaylar</a>
                                                    @else
                                                        <a href="{{ route('kampanyalar.show', $kampanya->id) }}" class="btn btn-sm btn-success">Detaylar</a>
                                                    @endguest
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Henüz kampanya bulunmuyor. Lütfen daha sonra tekrar kontrol edin.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
