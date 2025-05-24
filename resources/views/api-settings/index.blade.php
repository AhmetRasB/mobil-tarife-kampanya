@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">API Ayarları</h3>
                    <div class="card-tools">
                        <a href="{{ route('api-settings.credentials') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-key"></i> API Anahtarları
                        </a>
                        <a href="{{ route('api-settings.logs') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-history"></i> API Logları
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('api-settings.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="api_url">API URL</label>
                            <input type="url" class="form-control @error('api_url') is-invalid @enderror" 
                                id="api_url" name="api_url" value="{{ old('api_url', $settings->api_url ?? '') }}" required>
                            @error('api_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="api_version">API Versiyonu</label>
                            <input type="text" class="form-control @error('api_version') is-invalid @enderror" 
                                id="api_version" name="api_version" value="{{ old('api_version', $settings->api_version ?? '') }}" required>
                            @error('api_version')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="timeout">Timeout (saniye)</label>
                            <input type="number" class="form-control @error('timeout') is-invalid @enderror" 
                                id="timeout" name="timeout" value="{{ old('timeout', $settings->timeout ?? 30) }}" required min="1">
                            @error('timeout')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="retry_attempts">Yeniden Deneme Sayısı</label>
                            <input type="number" class="form-control @error('retry_attempts') is-invalid @enderror" 
                                id="retry_attempts" name="retry_attempts" value="{{ old('retry_attempts', $settings->retry_attempts ?? 3) }}" required min="0">
                            @error('retry_attempts')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="enable_logging" 
                                    name="enable_logging" value="1" {{ old('enable_logging', $settings->enable_logging ?? true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_logging">API Loglarını Etkinleştir</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Ayarları Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 