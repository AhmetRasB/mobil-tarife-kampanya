@extends('layouts.app')

@section('title', 'Tarife Düzenle')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Tarife Düzenle</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('tarifeler.update', $tarife) }}" method="POST" id="editForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="ad" class="form-label">Tarife Adı</label>
                            <input type="text" class="form-control @error('ad') is-invalid @enderror" id="ad" name="ad" value="{{ old('ad', $tarife->ad) }}" required>
                            @error('ad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fiyat" class="form-label">Fiyat (TL)</label>
                            <input type="number" step="0.01" class="form-control @error('fiyat') is-invalid @enderror" id="fiyat" name="fiyat" value="{{ old('fiyat', $tarife->fiyat) }}" required>
                            @error('fiyat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="internet_miktari" class="form-label">İnternet Miktarı (GB)</label>
                            <input type="number" class="form-control @error('internet_miktari') is-invalid @enderror" id="internet_miktari" name="internet_miktari" value="{{ old('internet_miktari', $tarife->internet_miktari) }}" required>
                            @error('internet_miktari')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dakika_miktari" class="form-label">Dakika Miktarı</label>
                            <input type="number" class="form-control @error('dakika_miktari') is-invalid @enderror" id="dakika_miktari" name="dakika_miktari" value="{{ old('dakika_miktari', $tarife->dakika_miktari) }}" required>
                            @error('dakika_miktari')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sms_miktari" class="form-label">SMS Miktarı</label>
                            <input type="number" class="form-control @error('sms_miktari') is-invalid @enderror" id="sms_miktari" name="sms_miktari" value="{{ old('sms_miktari', $tarife->sms_miktari) }}" required>
                            @error('sms_miktari')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="aktif" name="aktif" {{ old('aktif', $tarife->aktif) ? 'checked' : '' }}>
                            <label class="form-check-label" for="aktif">Aktif</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                            <a href="{{ route('tarifeler.index') }}" class="btn btn-secondary">İptal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('aktif').addEventListener('change', function() {
    fetch('{{ route('tarifeler.update', $tarife) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-HTTP-Method-Override': 'PUT'
        },
        body: JSON.stringify({
            aktif: this.checked,
            _method: 'PUT'
        })
    }).then(response => {
        if (response.ok) {
            window.location.reload();
        }
    });
});
</script>
@endpush
@endsection