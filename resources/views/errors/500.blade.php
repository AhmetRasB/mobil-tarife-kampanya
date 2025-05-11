@extends('layouts.app')

@section('title', 'Sunucu Hatası')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Sunucu Hatası</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-circle text-danger" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="text-danger mb-3">Bir şeyler yanlış gitti!</h4>
                    <p class="mb-4">Sunucuda bir sorun oluştu. Lütfen daha sonra tekrar deneyiniz.</p>
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