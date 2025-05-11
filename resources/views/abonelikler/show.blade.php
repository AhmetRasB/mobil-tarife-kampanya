@extends(Auth::user() && Auth::user()->is_admin ? 'layouts.admin' : 'layouts.app')

@section('title', 'Abonelik Detayları')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Abonelik Detayları</h5>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Abonelik No</label>
                        <p>{{ $abonelik->id }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Müşteri Adı</label>
                        <p>{{ $abonelik->musteri_adi }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Telefon</label>
                        <p>{{ $abonelik->telefon }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">E-posta</label>
                        <p>{{ $abonelik->email }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tarife</label>
                        <p>
                            @if($abonelik->tarife)
                                {{ $abonelik->tarife->ad }} - {{ number_format($abonelik->tarife->fiyat, 2) }} TL
                            @else
                                <span class="text-muted">Tarife bulunamadı</span>
                            @endif
                        </p>
                    </div>
                    
                    @if($abonelik->kampanya)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kampanya</label>
                        <p>{{ $abonelik->kampanya->ad }} ({{ $abonelik->kampanya->indirim_orani }}% indirim)</p>
                    </div>
                    @endif
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Durum</label>
                        <p>
                            @if($abonelik->aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Pasif</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Başlangıç Tarihi</label>
                        <p>{{ $abonelik->baslangic_tarihi->format('d.m.Y') }}</p>
                    </div>
                    
                    @if($abonelik->bitis_tarihi)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Bitiş Tarihi</label>
                        <p>{{ $abonelik->bitis_tarihi->format('d.m.Y') }}</p>
                    </div>
                    @endif
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Oluşturulma Tarihi</label>
                        <p>{{ $abonelik->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('abonelikler.index') }}" class="btn btn-secondary">Geri</a>
                        
                        @if(Auth::user()->is_admin)
                        <div>
                            <a href="{{ route('abonelikler.edit', $abonelik->id) }}" class="btn btn-primary">Düzenle</a>
                            
                            <form action="{{ route('abonelikler.destroy', $abonelik->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bu aboneliği silmek istediğinizden emin misiniz?')">Sil</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 