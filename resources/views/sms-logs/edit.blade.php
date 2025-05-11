@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SMS Kaydı Düzenle</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('sms-logs.update', $smsLog) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="sim_kart_id">SIM Kart</label>
                            <select name="sim_kart_id" id="sim_kart_id" class="form-control @error('sim_kart_id') is-invalid @enderror">
                                <option value="">SIM Kart Seçin</option>
                                @foreach($simCards as $simCard)
                                    <option value="{{ $simCard->id }}" {{ (old('sim_kart_id', $smsLog->sim_kart_id) == $simCard->id) ? 'selected' : '' }}>
                                        {{ $simCard->numara }} ({{ $simCard->subscriber ? $simCard->subscriber->ad . ' ' . $simCard->subscriber->soyad : 'Abonesiz' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('sim_kart_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alici">Alıcı</label>
                            <input type="text" name="alici" id="alici" class="form-control @error('alici') is-invalid @enderror" value="{{ old('alici', $smsLog->alici) }}" required>
                            @error('alici')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mesaj">Mesaj</label>
                            <textarea name="mesaj" id="mesaj" rows="4" class="form-control @error('mesaj') is-invalid @enderror" required>{{ old('mesaj', $smsLog->mesaj) }}</textarea>
                            @error('mesaj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tarih">Tarih</label>
                            <input type="datetime-local" name="tarih" id="tarih" class="form-control @error('tarih') is-invalid @enderror" value="{{ old('tarih', $smsLog->tarih->format('Y-m-d\TH:i')) }}" required>
                            @error('tarih')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="durum">Durum</label>
                            <select name="durum" id="durum" class="form-control @error('durum') is-invalid @enderror" required>
                                <option value="gonderildi" {{ old('durum', $smsLog->durum) == 'gonderildi' ? 'selected' : '' }}>Gönderildi</option>
                                <option value="basarisiz" {{ old('durum', $smsLog->durum) == 'basarisiz' ? 'selected' : '' }}>Başarısız</option>
                            </select>
                            @error('durum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                            <a href="{{ route('sms-logs.index') }}" class="btn btn-secondary">İptal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 