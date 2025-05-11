@extends('layouts.app')

@section('title', 'Tarife Detayları')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Tarife Detayları</h5>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tarife Adı</label>
                        <p>{{ $tarife->ad }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Fiyat</label>
                        <p>{{ number_format($tarife->fiyat, 2) }} TL</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">İnternet Miktarı</label>
                        <p>{{ $tarife->internet_miktari }} GB</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Dakika Miktarı</label>
                        <p>{{ $tarife->dakika_miktari }} DK</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">SMS Miktarı</label>
                        <p>{{ $tarife->sms_miktari }} SMS</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Durum</label>
                        <p>
                            @if($tarife->aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Pasif</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Oluşturulma Tarihi</label>
                        <p>{{ $tarife->created_at->format('d.m.Y H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Son Güncelleme</label>
                        <p>{{ $tarife->updated_at->format('d.m.Y H:i') }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tarifeler.index') }}" class="btn btn-secondary">Geri</a>
                        @if(Auth::user() && Auth::user()->is_admin)
                        <div>
                            <a href="{{ route('admin.tarifeler.edit', $tarife->id) }}" class="btn btn-primary">Düzenle</a>
                            <form action="{{ route('admin.tarifeler.destroy', $tarife->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bu tarifeyi silmek istediğinizden emin misiniz?')">Sil</button>
                            </form>
                        </div>
                        @endif
                        
                        @php
                            // Get available kampanyalar for this tarife
                            $uygunKampanyalar = App\Models\Kampanya::whereHas('tarifeler', function($query) use ($tarife) {
                                $query->where('tarifeler.id', $tarife->id);
                            })->where('aktif', true)->get();
                        @endphp
                        
                        @if(!Auth::user()->is_admin && $uygunKampanyalar->count() > 0)
                            <form action="{{ route('create-teklif') }}" method="GET">
                                <input type="hidden" name="tarife_id" value="{{ $tarife->id }}">
                                <div class="mb-3">
                                    <label for="kampanya_id" class="form-label">Kampanya Seçin (İsteğe Bağlı):</label>
                                    <select class="form-select" id="kampanya_id" name="kampanya_id">
                                        <option value="">Kampanya istemiyor</option>
                                        @foreach($uygunKampanyalar as $kampanya)
                                            <option value="{{ $kampanya->id }}">
                                                {{ $kampanya->ad }} (%{{ $kampanya->indirim_orani }} indirim)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Teklif Al</button>
                            </form>
                        @elseif(!Auth::user()->is_admin)
                            <a href="{{ route('create-teklif', ['tarife_id' => $tarife->id]) }}" class="btn btn-success">Teklif Al</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 