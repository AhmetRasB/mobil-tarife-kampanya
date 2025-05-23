@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yeni SIM Kart Ekle</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sim-cards.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="numara">Numara</label>
                            <input type="text" class="form-control @error('numara') is-invalid @enderror" id="numara" name="numara" value="{{ old('numara') }}" required>
                            @error('numara')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="puk">PUK</label>
                            <input type="text" class="form-control @error('puk') is-invalid @enderror" id="puk" name="puk" value="{{ old('puk') }}" required>
                            @error('puk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pin">PIN</label>
                            <input type="text" class="form-control @error('pin') is-invalid @enderror" id="pin" name="pin" value="{{ old('pin') }}" required>
                            @error('pin')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="aktivasyon_tarihi">Aktivasyon Tarihi</label>
                            <input type="date" class="form-control @error('aktivasyon_tarihi') is-invalid @enderror" id="aktivasyon_tarihi" name="aktivasyon_tarihi" value="{{ old('aktivasyon_tarihi') }}" required>
                            @error('aktivasyon_tarihi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="durum">Durum</label>
                            <select class="form-control @error('durum') is-invalid @enderror" id="durum" name="durum" required>
                                <option value="aktif" {{ old('durum') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="pasif" {{ old('durum') == 'pasif' ? 'selected' : '' }}>Pasif</option>
                                <option value="bloke" {{ old('durum') == 'bloke' ? 'selected' : '' }}>Bloke</option>
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
                                    <option value="{{ $subscriber->id }}" {{ old('abone_id') == $subscriber->id ? 'selected' : '' }}>
                                        {{ $subscriber->ad }} {{ $subscriber->soyad }} ({{ $subscriber->tc_no }})
                                    </option>
                                @endforeach
                            </select>
                            @error('abone_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                            <a href="{{ route('admin.sim-cards.index') }}" class="btn btn-secondary">İptal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 