@extends('layouts.app')

@section('title', 'Yeni Tarife')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Yeni Tarife Oluştur</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tarifeler.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="ad" class="form-label">Tarife Adı</label>
                        <input type="text" class="form-control @error('ad') is-invalid @enderror" id="ad" name="ad" value="{{ old('ad') }}" required>
                        @error('ad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fiyat" class="form-label">Fiyat (TL)</label>
                        <input type="number" step="0.01" class="form-control @error('fiyat') is-invalid @enderror" id="fiyat" name="fiyat" value="{{ old('fiyat') }}" required>
                        @error('fiyat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="internet_miktari" class="form-label">İnternet Miktarı (GB)</label>
                        <input type="number" class="form-control @error('internet_miktari') is-invalid @enderror" id="internet_miktari" name="internet_miktari" value="{{ old('internet_miktari') }}" required>
                        @error('internet_miktari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dakika_miktari" class="form-label">Dakika Miktarı</label>
                        <input type="number" class="form-control @error('dakika_miktari') is-invalid @enderror" id="dakika_miktari" name="dakika_miktari" value="{{ old('dakika_miktari') }}" required>
                        @error('dakika_miktari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sms_miktari" class="form-label">SMS Miktarı</label>
                        <input type="number" class="form-control @error('sms_miktari') is-invalid @enderror" id="sms_miktari" name="sms_miktari" value="{{ old('sms_miktari') }}" required>
                        @error('sms_miktari')
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

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                        <a href="{{ route('tarifeler.index') }}" class="btn btn-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 