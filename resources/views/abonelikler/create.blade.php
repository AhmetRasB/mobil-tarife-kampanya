@extends(Auth::user() && Auth::user()->is_admin ? 'layouts.admin' : 'layouts.app')

@section('title', 'Yeni Abonelik')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Yeni Abonelik Oluştur</h5>
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
                    
                    @if(isset($teklif))
                        <div class="alert alert-info">
                            <strong>Teklif bilgileri kullanılarak abonelik oluşturuluyor.</strong>
                            <p class="mb-0 mt-2">
                                <strong>Teklif No:</strong> {{ $teklif->id }}<br>
                                <strong>Müşteri:</strong> {{ $teklif->ad_soyad }}<br>
                                @if($teklif->tarife)
                                    <strong>Tarife:</strong> {{ $teklif->tarife->ad }}<br>
                                @endif
                                @if($teklif->kampanya)
                                    <strong>Kampanya:</strong> {{ $teklif->kampanya->ad }}<br>
                                @endif
                            </p>
                        </div>
                    @endif
                    
                    <form action="{{ route('abonelikler.store') }}" method="POST">
                        @csrf
                        
                        @if(isset($teklif))
                            <input type="hidden" name="teklif_id" value="{{ $teklif->id }}">
                            <input type="hidden" name="user_id" value="{{ $teklif->user_id }}">
                        @endif
                        
                        <div class="mb-3">
                            <label for="musteri_adi" class="form-label">Müşteri Adı</label>
                            <input type="text" class="form-control @error('musteri_adi') is-invalid @enderror" id="musteri_adi" name="musteri_adi" value="{{ old('musteri_adi', isset($teklif) ? $teklif->ad_soyad : '') }}" required>
                            @error('musteri_adi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telefon" class="form-label">Telefon</label>
                            <input type="tel" class="form-control @error('telefon') is-invalid @enderror" id="telefon" name="telefon" value="{{ old('telefon', isset($teklif) ? $teklif->telefon : '') }}" required>
                            @error('telefon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', isset($teklif) ? $teklif->email : '') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tarife_id" class="form-label">Tarife</label>
                            <select class="form-select @error('tarife_id') is-invalid @enderror" id="tarife_id" name="tarife_id" required>
                                <option value="">Tarife Seçin</option>
                                @foreach($tarifeler as $tarife)
                                    <option value="{{ $tarife->id }}" {{ old('tarife_id', isset($teklif) ? $teklif->tarife_id : '') == $tarife->id ? 'selected' : '' }}>
                                        {{ $tarife->ad }} - {{ number_format($tarife->fiyat, 2) }} TL
                                    </option>
                                @endforeach
                            </select>
                            @error('tarife_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kampanya_id" class="form-label">Kampanya</label>
                            <select class="form-select @error('kampanya_id') is-invalid @enderror" id="kampanya_id" name="kampanya_id">
                                <option value="">Kampanya Seçin</option>
                                @foreach($kampanyalar as $kampanya)
                                    <option value="{{ $kampanya->id }}" {{ old('kampanya_id', isset($teklif) ? $teklif->kampanya_id : '') == $kampanya->id ? 'selected' : '' }}>
                                        {{ $kampanya->ad }} - %{{ $kampanya->indirim_orani }} İndirim
                                    </option>
                                @endforeach
                            </select>
                            @error('kampanya_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="baslangic_tarihi" class="form-label">Başlangıç Tarihi</label>
                            <input type="date" class="form-control @error('baslangic_tarihi') is-invalid @enderror" id="baslangic_tarihi" name="baslangic_tarihi" value="{{ old('baslangic_tarihi', date('Y-m-d')) }}" required>
                            @error('baslangic_tarihi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bitis_tarihi" class="form-label">Bitiş Tarihi</label>
                            <input type="date" class="form-control @error('bitis_tarihi') is-invalid @enderror" id="bitis_tarihi" name="bitis_tarihi" value="{{ old('bitis_tarihi', date('Y-m-d', strtotime('+1 year'))) }}">
                            @error('bitis_tarihi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('aktif') is-invalid @enderror" id="aktif" name="aktif" value="1" {{ old('aktif', '1') ? 'checked' : '' }}>
                                <label class="form-check-label" for="aktif">Aktif</label>
                                @error('aktif')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('abonelikler.index') }}" class="btn btn-secondary">İptal</a>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 