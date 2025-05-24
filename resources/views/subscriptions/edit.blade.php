@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Abonelik Düzenle</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('subscriptions.update', $subscription) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="abone_id">Abone</label>
                            <select class="form-control @error('abone_id') is-invalid @enderror" id="abone_id" name="abone_id" required>
                                <option value="">Abone Seçin</option>
                                @foreach($subscribers as $subscriber)
                                    <option value="{{ $subscriber->id }}" {{ old('abone_id', $subscription->abone_id) == $subscriber->id ? 'selected' : '' }}>
                                        {{ $subscriber->ad }} {{ $subscriber->soyad }}
                                    </option>
                                @endforeach
                            </select>
                            @error('abone_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tarife_adi">Tarife Adı</label>
                            <input type="text" class="form-control @error('tarife_adi') is-invalid @enderror" id="tarife_adi" name="tarife_adi" value="{{ old('tarife_adi', $subscription->tarife_adi) }}" required>
                            @error('tarife_adi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="aylik_ucret">Aylık Ücret</label>
                            <input type="number" step="0.01" class="form-control @error('aylik_ucret') is-invalid @enderror" id="aylik_ucret" name="aylik_ucret" value="{{ old('aylik_ucret', $subscription->aylik_ucret) }}" required>
                            @error('aylik_ucret')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="baslangic_tarihi">Başlangıç Tarihi</label>
                            <input type="date" class="form-control @error('baslangic_tarihi') is-invalid @enderror" id="baslangic_tarihi" name="baslangic_tarihi" value="{{ old('baslangic_tarihi', $subscription->baslangic_tarihi ? $subscription->baslangic_tarihi->format('Y-m-d') : '') }}" required>
                            @error('baslangic_tarihi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bitis_tarihi">Bitiş Tarihi</label>
                            <input type="date" class="form-control @error('bitis_tarihi') is-invalid @enderror" id="bitis_tarihi" name="bitis_tarihi" value="{{ old('bitis_tarihi', $subscription->bitis_tarihi ? $subscription->bitis_tarihi->format('Y-m-d') : '') }}">
                            @error('bitis_tarihi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="aktif_mi">Durum</label>
                            <select class="form-control @error('aktif_mi') is-invalid @enderror" id="aktif_mi" name="aktif_mi" required>
                                <option value="1" {{ old('aktif_mi', $subscription->aktif_mi) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('aktif_mi', $subscription->aktif_mi) == 0 ? 'selected' : '' }}>Pasif</option>
                            </select>
                            @error('aktif_mi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                            <a href="{{ route('admin.abonelikler.index') }}" class="btn btn-secondary">İptal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 