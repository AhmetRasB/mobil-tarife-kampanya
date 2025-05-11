@extends('layouts.app')

@section('title', 'Yeni Kampanya')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Yeni Kampanya Oluştur</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('kampanyalar.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="ad" class="form-label">Kampanya Adı</label>
                        <input type="text" class="form-control @error('ad') is-invalid @enderror" id="ad" name="ad" value="{{ old('ad') }}" required>
                        @error('ad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="aciklama" class="form-label">Açıklama</label>
                        <textarea class="form-control @error('aciklama') is-invalid @enderror" id="aciklama" name="aciklama" rows="3">{{ old('aciklama') }}</textarea>
                        @error('aciklama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="baslangic_tarihi" class="form-label">Başlangıç Tarihi</label>
                        <input type="date" class="form-control @error('baslangic_tarihi') is-invalid @enderror" id="baslangic_tarihi" name="baslangic_tarihi" value="{{ old('baslangic_tarihi') }}" required>
                        @error('baslangic_tarihi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bitis_tarihi" class="form-label">Bitiş Tarihi</label>
                        <input type="date" class="form-control @error('bitis_tarihi') is-invalid @enderror" id="bitis_tarihi" name="bitis_tarihi" value="{{ old('bitis_tarihi') }}" required>
                        @error('bitis_tarihi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="indirim_orani" class="form-label">İndirim Oranı (%)</label>
                        <input type="number" min="0" max="100" class="form-control @error('indirim_orani') is-invalid @enderror" id="indirim_orani" name="indirim_orani" value="{{ old('indirim_orani') }}" required>
                        @error('indirim_orani')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input @error('aktif') is-invalid @enderror" id="aktif" name="aktif" value="1" {{ old('aktif') ? 'checked' : '' }}>
                            <label class="form-check-label" for="aktif">Aktif</label>
                            @error('aktif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Geçerli Tarifeler</label>
                        <div class="row">
                            @foreach($tarifeler as $tarife)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="tarifeler[]" value="{{ $tarife->id }}" id="tarife_{{ $tarife->id }}">
                                    <label class="form-check-label" for="tarife_{{ $tarife->id }}">
                                        {{ $tarife->ad }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                        <a href="{{ route('kampanyalar.index') }}" class="btn btn-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 