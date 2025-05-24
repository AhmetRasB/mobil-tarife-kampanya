@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">API Anahtarları</h3>
                    <div class="card-tools">
                        <a href="{{ route('api-settings.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-cog"></i> API Ayarları
                        </a>
                        <a href="{{ route('api-settings.logs') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-history"></i> API Logları
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> API Anahtarı Bilgileri</h5>
                        <p>API anahtarınızı güvenli bir şekilde saklayın. Bu anahtar, API'ye erişim için kullanılacaktır.</p>
                    </div>

                    <div class="form-group">
                        <label for="api_key">Mevcut API Anahtarı</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="api_key" 
                                value="{{ $settings->api_key ?? 'Henüz API anahtarı oluşturulmamış' }}" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('api_key')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('api-settings.generate-key') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle"></i> Dikkat!</h5>
                            <p>Yeni bir API anahtarı oluşturmak, mevcut anahtarı geçersiz kılacaktır. Bu işlem geri alınamaz.</p>
                        </div>
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Yeni bir API anahtarı oluşturmak istediğinizden emin misiniz?')">
                            <i class="fas fa-key"></i> Yeni API Anahtarı Oluştur
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyToClipboard(elementId) {
    var copyText = document.getElementById(elementId);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    // Show feedback
    var button = copyText.nextElementSibling.querySelector('button');
    var originalIcon = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i>';
    setTimeout(function() {
        button.innerHTML = originalIcon;
    }, 2000);
}
</script>
@endpush
@endsection 