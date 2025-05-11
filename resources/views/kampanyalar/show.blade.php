@extends('layouts.app')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Kampanya Detayları</h5>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kampanya Adı</label>
                        <p>{{ $kampanya->ad }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Başlangıç Tarihi</label>
                        <p>{{ $kampanya->baslangic_tarihi->format('d.m.Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Bitiş Tarihi</label>
                        <p>{{ $kampanya->bitis_tarihi->format('d.m.Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">İndirim Oranı</label>
                        <p>%{{ $kampanya->indirim_orani }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Durum</label>
                        <p>
                            @if($kampanya->aktif_mi)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Pasif</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Oluşturulma Tarihi</label>
                        <p>{{ $kampanya->created_at->format('d.m.Y H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Son Güncelleme</label>
                        <p>{{ $kampanya->updated_at->format('d.m.Y H:i') }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kampanyalar.index') }}" class="btn btn-secondary">Geri</a>
                        @if(Auth::user() && Auth::user()->is_admin)
                        <div>
                            <a href="{{ route('admin.kampanyalar.edit', $kampanya->id) }}" class="btn btn-primary">Düzenle</a>
                            <form action="{{ route('admin.kampanyalar.destroy', $kampanya->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bu kampanyayı silmek istediğinizden emin misiniz?')">Sil</button>
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