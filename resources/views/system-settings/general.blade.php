@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Genel Ayarlar</h3>
                    <div class="card-tools">
                        <a href="{{ route('system-settings.notifications') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-bell"></i> Bildirim Ayarları
                        </a>
                        <a href="{{ route('system-settings.backup') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-database"></i> Yedekleme
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('system-settings.update-general') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="site_name">Site Adı</label>
                            <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name ?? '') }}" required>
                            @error('site_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="site_description">Site Açıklaması</label>
                            <textarea class="form-control @error('site_description') is-invalid @enderror" 
                                id="site_description" name="site_description" rows="3">{{ old('site_description', $settings->site_description ?? '') }}</textarea>
                            @error('site_description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="timezone">Zaman Dilimi</label>
                            <select class="form-control @error('timezone') is-invalid @enderror" 
                                id="timezone" name="timezone" required>
                                @foreach(timezone_identifiers_list() as $timezone)
                                    <option value="{{ $timezone }}" {{ old('timezone', $settings->timezone ?? '') == $timezone ? 'selected' : '' }}>
                                        {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                            @error('timezone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date_format">Tarih Formatı</label>
                            <select class="form-control @error('date_format') is-invalid @enderror" 
                                id="date_format" name="date_format" required>
                                <option value="d.m.Y" {{ old('date_format', $settings->date_format ?? '') == 'd.m.Y' ? 'selected' : '' }}>GG.AA.YYYY</option>
                                <option value="Y-m-d" {{ old('date_format', $settings->date_format ?? '') == 'Y-m-d' ? 'selected' : '' }}>YYYY-AA-GG</option>
                                <option value="d/m/Y" {{ old('date_format', $settings->date_format ?? '') == 'd/m/Y' ? 'selected' : '' }}>GG/AA/YYYY</option>
                            </select>
                            @error('date_format')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="time_format">Saat Formatı</label>
                            <select class="form-control @error('time_format') is-invalid @enderror" 
                                id="time_format" name="time_format" required>
                                <option value="H:i" {{ old('time_format', $settings->time_format ?? '') == 'H:i' ? 'selected' : '' }}>24 Saat (14:30)</option>
                                <option value="h:i A" {{ old('time_format', $settings->time_format ?? '') == 'h:i A' ? 'selected' : '' }}>12 Saat (02:30 PM)</option>
                            </select>
                            @error('time_format')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="maintenance_mode" 
                                    name="maintenance_mode" value="1" {{ old('maintenance_mode', $settings->maintenance_mode ?? false) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="maintenance_mode">Bakım Modu</label>
                            </div>
                            <small class="form-text text-muted">Bakım modu aktifken sadece yöneticiler sisteme erişebilir.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Ayarları Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 