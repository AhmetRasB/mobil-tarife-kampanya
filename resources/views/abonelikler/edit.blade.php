@extends(Auth::user() && Auth::user()->is_admin ? 'layouts.admin' : 'layouts.app')

@section('title', 'Abonelik Düzenle')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Abonelik Düzenle</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('abonelikler.update', $abonelik) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="musteri_adi">Müşteri Adı</label>
                            <input type="text" class="form-control @error('musteri_adi') is-invalid @enderror" id="musteri_adi" name="musteri_adi" value="{{ old('musteri_adi', $abonelik->musteri_adi) }}" required>
                            @error('musteri_adi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telefon">Telefon</label>
                            <input type="text" class="form-control @error('telefon') is-invalid @enderror" id="telefon" name="telefon" value="{{ old('telefon', $abonelik->telefon) }}" required>
                            @error('telefon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-posta</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $abonelik->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tarife_id">Tarife</label>
                            <select class="form-control @error('tarife_id') is-invalid @enderror" id="tarife_id" name="tarife_id" required>
                                <option value="">Tarife Seçin</option>
                                @foreach($tarifeler as $tarife)
                                    <option value="{{ $tarife->id }}" {{ old('tarife_id', $abonelik->tarife_id) == $tarife->id ? 'selected' : '' }}>
                                        {{ $tarife->ad }} - {{ number_format($tarife->fiyat, 2) }} TL
                                    </option>
                                @endforeach
                            </select>
                            @error('tarife_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kampanya_id">Kampanya</label>
                            <select class="form-control @error('kampanya_id') is-invalid @enderror" id="kampanya_id" name="kampanya_id">
                                <option value="">Kampanya Seçin</option>
                                @foreach($kampanyalar as $kampanya)
                                    <option value="{{ $kampanya->id }}" {{ old('kampanya_id', $abonelik->kampanya_id) == $kampanya->id ? 'selected' : '' }}>
                                        {{ $kampanya->ad }} - %{{ $kampanya->indirim_orani }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kampanya_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="baslangic_tarihi">Başlangıç Tarihi</label>
                            <input type="date" class="form-control @error('baslangic_tarihi') is-invalid @enderror" id="baslangic_tarihi" name="baslangic_tarihi" value="{{ old('baslangic_tarihi', $abonelik->baslangic_tarihi->format('Y-m-d')) }}" required>
                            @error('baslangic_tarihi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bitis_tarihi">Bitiş Tarihi</label>
                            <input type="date" class="form-control @error('bitis_tarihi') is-invalid @enderror" id="bitis_tarihi" name="bitis_tarihi" value="{{ old('bitis_tarihi', $abonelik->bitis_tarihi->format('Y-m-d')) }}" required>
                            @error('bitis_tarihi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <input type="hidden" name="aktif" value="0">
                            <input type="checkbox" class="form-check-input" id="aktif" name="aktif" value="1" {{ old('aktif', $abonelik->aktif) ? 'checked' : '' }}>
                            <label class="form-check-label" for="aktif">Aktif</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                        <a href="{{ route('abonelikler.index') }}" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 