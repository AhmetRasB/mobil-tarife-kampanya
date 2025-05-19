@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cihaz Düzenle</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.devices.update', $device) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="ad">Ad</label>
                            <input type="text" class="form-control @error('ad') is-invalid @enderror" id="ad" name="ad" value="{{ old('ad', $device->ad) }}" required>
                            @error('ad')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="marka">Marka</label>
                            <input type="text" class="form-control @error('marka') is-invalid @enderror" id="marka" name="marka" value="{{ old('marka', $device->marka) }}" required>
                            @error('marka')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model', $device->model) }}" required>
                            @error('model')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="seri_no">Seri No</label>
                            <input type="text" class="form-control @error('seri_no') is-invalid @enderror" id="seri_no" name="seri_no" value="{{ old('seri_no', $device->seri_no) }}" required>
                            @error('seri_no')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="satis_tarihi">Satış Tarihi</label>
                            <input type="date" class="form-control @error('satis_tarihi') is-invalid @enderror" id="satis_tarihi" name="satis_tarihi" value="{{ old('satis_tarihi', $device->satis_tarihi ? $device->satis_tarihi->format('Y-m-d') : '') }}" required>
                            @error('satis_tarihi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fiyat">Fiyat</label>
                            <input type="number" step="0.01" class="form-control @error('fiyat') is-invalid @enderror" id="fiyat" name="fiyat" value="{{ old('fiyat', $device->fiyat) }}" required>
                            @error('fiyat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="durum">Durum</label>
                            <select class="form-control @error('durum') is-invalid @enderror" id="durum" name="durum" required>
                                <option value="aktif" {{ old('durum', $device->durum) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="pasif" {{ old('durum', $device->durum) == 'pasif' ? 'selected' : '' }}>Pasif</option>
                                <option value="arizali" {{ old('durum', $device->durum) == 'arizali' ? 'selected' : '' }}>Arızalı</option>
                            </select>
                            @error('durum')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="abone_id">Abone</label>
                            <select class="form-control @error('abone_id') is-invalid @enderror" id="abone_id" name="abone_id">
                                <option value="">Abone Seçin</option>
                                @foreach($subscribers as $subscriber)
                                    <option value="{{ $subscriber->id }}" {{ old('abone_id', $device->abone_id) == $subscriber->id ? 'selected' : '' }}>
                                        {{ $subscriber->ad }} {{ $subscriber->soyad }}
                                    </option>
                                @endforeach
                            </select>
                            @error('abone_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                            <a href="{{ route('admin.devices.index') }}" class="btn btn-secondary">İptal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 