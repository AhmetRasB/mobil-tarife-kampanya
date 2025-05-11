@extends('layouts.app')

@section('title', 'Sayfa Bulunamadı')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Sayfa Bulunamadı</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-search text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="text-warning mb-3">Aradığınız sayfa bulunamadı!</h4>
                    <p class="mb-4">Aradığınız sayfa kaldırılmış, adı değiştirilmiş veya geçici olarak kullanılamıyor olabilir.</p>
                    <div>
                        <a href="{{ url('/') }}" class="btn btn-primary">Ana Sayfaya Dön</a>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Geri Dön</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 