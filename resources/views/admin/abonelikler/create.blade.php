@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yeni Abonelik Oluştur</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.abonelikler.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Geri
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.abonelikler.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if($teklif)
                            <input type="hidden" name="teklif_id" value="{{ $teklif->id }}">
                            <div class="alert alert-info">
                                Bu abonelik, <strong>{{ $teklif->user->name }}</strong> kullanıcısının teklifi üzerine oluşturuluyor.
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="musteri_adi">Müşteri Adı</label>
                                    <input type="text" class="form-control @error('musteri_adi') is-invalid @enderror" 
                                        id="musteri_adi" name="musteri_adi" 
                                        value="{{ old('musteri_adi', $teklif ? $teklif->user->name : '') }}" required>
                                    @error('musteri_adi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefon">Telefon</label>
                                    <input type="text" class="form-control @error('telefon') is-invalid @enderror" 
                                        id="telefon" name="telefon" 
                                        value="{{ old('telefon', $teklif ? $teklif->user->telefon : '') }}" required>
                                    @error('telefon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        id="email" name="email" 
                                        value="{{ old('email', $teklif ? $teklif->user->email : '') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tarife_id">Tarife</label>
                                    <select class="form-control @error('tarife_id') is-invalid @enderror" 
                                        id="tarife_id" name="tarife_id" required>
                                        <option value="">Tarife Seçin</option>
                                        @foreach($tarifeler as $tarife)
                                            <option value="{{ $tarife->id }}" 
                                                {{ old('tarife_id', $teklif ? $teklif->tarife_id : '') == $tarife->id ? 'selected' : '' }}>
                                                {{ $tarife->ad }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tarife_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kampanya_id">Kampanya</label>
                                    <select class="form-control @error('kampanya_id') is-invalid @enderror" 
                                        id="kampanya_id" name="kampanya_id">
                                        <option value="">Kampanya Seçin</option>
                                        @foreach($kampanyalar as $kampanya)
                                            <option value="{{ $kampanya->id }}" 
                                                {{ old('kampanya_id', $teklif ? $teklif->kampanya_id : '') == $kampanya->id ? 'selected' : '' }}>
                                                {{ $kampanya->ad }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kampanya_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="baslangic_tarihi">Başlangıç Tarihi</label>
                                    <input type="date" class="form-control @error('baslangic_tarihi') is-invalid @enderror" 
                                        id="baslangic_tarihi" name="baslangic_tarihi" 
                                        value="{{ old('baslangic_tarihi', date('Y-m-d')) }}" required>
                                    @error('baslangic_tarihi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bitis_tarihi">Bitiş Tarihi</label>
                                    <input type="date" class="form-control @error('bitis_tarihi') is-invalid @enderror" 
                                        id="bitis_tarihi" name="bitis_tarihi" 
                                        value="{{ old('bitis_tarihi') }}">
                                    @error('bitis_tarihi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch mt-4">
                                        <input type="checkbox" class="custom-control-input" id="aktif" name="aktif" value="1" 
                                            {{ old('aktif', true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="aktif">Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 