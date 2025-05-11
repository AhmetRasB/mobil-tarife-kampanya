@extends('layouts.app')

@section('title', 'Kampanya Düzenle')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Kampanya Düzenle</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('kampanyalar.update', $kampanya) }}" method="POST" id="editForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="ad" class="form-label">Kampanya Adı</label>
                            <input type="text" class="form-control @error('ad') is-invalid @enderror" id="ad" name="ad" value="{{ old('ad', $kampanya->ad) }}" required>
                            @error('ad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="aciklama" class="form-label">Açıklama</label>
                            <textarea class="form-control @error('aciklama') is-invalid @enderror" id="aciklama" name="aciklama" rows="3" required>{{ old('aciklama', $kampanya->aciklama) }}</textarea>
                            @error('aciklama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="baslangic_tarihi" class="form-label">Başlangıç Tarihi</label>
                            <input type="date" class="form-control @error('baslangic_tarihi') is-invalid @enderror" id="baslangic_tarihi" name="baslangic_tarihi" value="{{ old('baslangic_tarihi', $kampanya->baslangic_tarihi->format('Y-m-d')) }}" required>
                            @error('baslangic_tarihi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bitis_tarihi" class="form-label">Bitiş Tarihi</label>
                            <input type="date" class="form-control @error('bitis_tarihi') is-invalid @enderror" id="bitis_tarihi" name="bitis_tarihi" value="{{ old('bitis_tarihi', $kampanya->bitis_tarihi->format('Y-m-d')) }}" required>
                            @error('bitis_tarihi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="indirim_orani" class="form-label">İndirim Oranı (%)</label>
                            <input type="number" class="form-control @error('indirim_orani') is-invalid @enderror" id="indirim_orani" name="indirim_orani" value="{{ old('indirim_orani', $kampanya->indirim_orani) }}" required>
                            @error('indirim_orani')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Geçerli Tarifeler</label>
                            <div class="row">
                                @foreach($tarifeler as $tarife)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="tarifeler[]" value="{{ $tarife->id }}" id="tarife_{{ $tarife->id }}"
                                            {{ in_array($tarife->id, old('tarifeler', $kampanya->tarifeler->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tarife_{{ $tarife->id }}">{{ $tarife->ad }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('tarifeler')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="aktif" name="aktif" {{ old('aktif', $kampanya->aktif) ? 'checked' : '' }}>
                            <label class="form-check-label" for="aktif">Aktif</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                            <a href="{{ route('kampanyalar.index') }}" class="btn btn-secondary">İptal</a>
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
    fetch('{{ route('kampanyalar.update', $kampanya) }}', {
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
@endsectionyes 