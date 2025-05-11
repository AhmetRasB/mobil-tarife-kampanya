@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kampanya Düzenle</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kampanyalar.update', $kampanya) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="ad">Kampanya Adı</label>
                            <input type="text" class="form-control @error('ad') is-invalid @enderror" id="ad" name="ad" value="{{ old('ad', $kampanya->ad) }}" required>
                            @error('ad')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="indirim_orani">İndirim Oranı (%)</label>
                            <input type="number" min="0" max="100" class="form-control @error('indirim_orani') is-invalid @enderror" id="indirim_orani" name="indirim_orani" value="{{ old('indirim_orani', $kampanya->indirim_orani) }}" required>
                            @error('indirim_orani')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="baslangic_tarihi">Başlangıç Tarihi</label>
                            <input type="date" class="form-control @error('baslangic_tarihi') is-invalid @enderror" id="baslangic_tarihi" name="baslangic_tarihi" value="{{ old('baslangic_tarihi', $kampanya->baslangic_tarihi->format('Y-m-d')) }}" required>
                            @error('baslangic_tarihi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bitis_tarihi">Bitiş Tarihi</label>
                            <input type="date" class="form-control @error('bitis_tarihi') is-invalid @enderror" id="bitis_tarihi" name="bitis_tarihi" value="{{ old('bitis_tarihi', $kampanya->bitis_tarihi->format('Y-m-d')) }}" required>
                            @error('bitis_tarihi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="aktif" name="aktif" value="1" {{ old('aktif', $kampanya->aktif) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="aktif">Aktif</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aciklama">Açıklama</label>
                            <textarea class="form-control @error('aciklama') is-invalid @enderror" id="aciklama" name="aciklama" rows="3">{{ old('aciklama', $kampanya->aciklama) }}</textarea>
                            @error('aciklama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Güncelle</button>
                        <a href="{{ route('admin.kampanyalar.index') }}" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 