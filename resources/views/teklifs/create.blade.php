@extends(Auth::user() && Auth::user()->is_admin ? 'layouts.admin' : 'layouts.app')

@section('title', 'Yeni Teklif')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Yeni Teklif') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('teklifs.store') }}">
                        @csrf

                        <input type="hidden" name="tarife_id" value="{{ $tarife->id }}">
                        @if($kampanya)
                            <input type="hidden" name="kampanya_id" value="{{ $kampanya->id }}">
                        @endif

                        <div class="mb-3">
                            <label for="ad_soyad" class="form-label">{{ __('Ad Soyad') }}</label>
                            <input id="ad_soyad" type="text" class="form-control @error('ad_soyad') is-invalid @enderror" name="ad_soyad" value="{{ old('ad_soyad', Auth::user()->name) }}" required>
                            @error('ad_soyad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telefon" class="form-label">{{ __('Telefon') }}</label>
                            <input id="telefon" type="text" class="form-control @error('telefon') is-invalid @enderror" name="telefon" value="{{ old('telefon') }}" required>
                            @error('telefon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('E-posta') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="adres" class="form-label">{{ __('Adres') }}</label>
                            <textarea id="adres" class="form-control @error('adres') is-invalid @enderror" name="adres" required>{{ old('adres') }}</textarea>
                            @error('adres')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notlar" class="form-label">{{ __('Notlar') }}</label>
                            <textarea id="notlar" class="form-control @error('notlar') is-invalid @enderror" name="notlar">{{ old('notlar') }}</textarea>
                            @error('notlar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Seçilen Tarife Bilgileri</div>
                            <div class="card-body">
                                <h5>{{ $tarife->ad }}</h5>
                                <p>Fiyat: {{ number_format($tarife->fiyat, 2) }} TL</p>
                                <p>İnternet: {{ $tarife->internet_miktari }} GB</p>
                                <p>Dakika: {{ $tarife->dakika_miktari }} DK</p>
                                <p>SMS: {{ $tarife->sms_miktari }} SMS</p>
                            </div>
                        </div>

                        @if($kampanya)
                        <div class="card mb-3">
                            <div class="card-header">Seçilen Kampanya Bilgileri</div>
                            <div class="card-body">
                                <h5>{{ $kampanya->ad }}</h5>
                                <p>İndirim Oranı: %{{ $kampanya->indirim_orani }}</p>
                                <p>Geçerlilik: {{ $kampanya->baslangic_tarihi->format('d.m.Y') }} - {{ $kampanya->bitis_tarihi->format('d.m.Y') }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Teklif Oluştur') }}
                            </button>
                            <a href="{{ route('tarifeler.index') }}" class="btn btn-secondary">
                                {{ __('İptal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 