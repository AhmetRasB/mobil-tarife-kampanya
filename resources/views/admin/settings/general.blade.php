@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Genel Ayarlar</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update-general') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="site_name">Site Adı</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings->site_name ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="site_description">Site Açıklaması</label>
                            <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ $settings->site_description ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="contact_email">İletişim E-posta</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ $settings->contact_email ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="contact_phone">İletişim Telefon</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ $settings->contact_phone ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Adres</label>
                            <textarea class="form-control" id="address" name="address" rows="3">{{ $settings->address ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="currency">Para Birimi</label>
                            <select class="form-control" id="currency" name="currency">
                                <option value="TRY" {{ ($settings->currency ?? '') == 'TRY' ? 'selected' : '' }}>Türk Lirası (₺)</option>
                                <option value="USD" {{ ($settings->currency ?? '') == 'USD' ? 'selected' : '' }}>US Dollar ($)</option>
                                <option value="EUR" {{ ($settings->currency ?? '') == 'EUR' ? 'selected' : '' }}>Euro (€)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="timezone">Saat Dilimi</label>
                            <select class="form-control" id="timezone" name="timezone">
                                @foreach(timezone_identifiers_list() as $timezone)
                                    <option value="{{ $timezone }}" {{ ($settings->timezone ?? '') == $timezone ? 'selected' : '' }}>
                                        {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 