@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tarife Düzenle</h3>
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
                    <form action="{{ route('admin.tarifeler.update', $tarife) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="ad">Tarife Adı</label>
                            <input type="text" class="form-control @error('ad') is-invalid @enderror" id="ad" name="ad" value="{{ old('ad', $tarife->ad) }}" required>
                            @error('ad')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fiyat">Fiyat (TL)</label>
                            <input type="number" step="0.01" class="form-control @error('fiyat') is-invalid @enderror" id="fiyat" name="fiyat" value="{{ old('fiyat', $tarife->fiyat) }}" required>
                            @error('fiyat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="internet_miktari">İnternet (GB)</label>
                            <input type="number" class="form-control @error('internet_miktari') is-invalid @enderror" id="internet_miktari" name="internet_miktari" value="{{ old('internet_miktari', $tarife->internet_miktari) }}" required>
                            @error('internet_miktari')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dakika_miktari">Dakika</label>
                            <input type="number" class="form-control @error('dakika_miktari') is-invalid @enderror" id="dakika_miktari" name="dakika_miktari" value="{{ old('dakika_miktari', $tarife->dakika_miktari) }}" required>
                            @error('dakika_miktari')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sms_miktari">SMS</label>
                            <input type="number" class="form-control @error('sms_miktari') is-invalid @enderror" id="sms_miktari" name="sms_miktari" value="{{ old('sms_miktari', $tarife->sms_miktari) }}" required>
                            @error('sms_miktari')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="aktif" name="aktif" value="1" {{ old('aktif', $tarife->aktif) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="aktif">Aktif</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="aciklama">Açıklama</label>
                            <textarea class="form-control @error('aciklama') is-invalid @enderror" id="aciklama" name="aciklama" rows="3">{{ old('aciklama', $tarife->aciklama) }}</textarea>
                            @error('aciklama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                        <a href="{{ route('admin.tarifeler.index') }}" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 