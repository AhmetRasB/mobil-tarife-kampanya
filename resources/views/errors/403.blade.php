@extends('layouts.app')

@section('title', 'Yetkisiz Erişim')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Yetkisiz Erişim</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="text-danger mb-3">Bu sayfaya erişim yetkiniz yok!</h4>
                    <p class="mb-4">Bu işlemi gerçekleştirmek için gerekli yetkilere sahip değilsiniz.</p>
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