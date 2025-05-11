@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bildirim Ayarları</h3>
                    <div class="card-tools">
                        <a href="{{ route('system-settings.general') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-cog"></i> Genel Ayarlar
                        </a>
                        <a href="{{ route('system-settings.backup') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-database"></i> Yedekleme
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('system-settings.update-notifications') }}" method="POST">
                        @csrf
                        
                        <!-- E-posta Bildirimleri -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">E-posta Bildirimleri</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="enable_email_notifications" 
                                            name="enable_email_notifications" value="1" {{ old('enable_email_notifications', $settings->enable_email_notifications ?? true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="enable_email_notifications">E-posta Bildirimlerini Etkinleştir</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="notification_email">Bildirim E-posta Adresi</label>
                                    <input type="email" class="form-control @error('notification_email') is-invalid @enderror" 
                                        id="notification_email" name="notification_email" value="{{ old('notification_email', $settings->notification_email ?? '') }}" required>
                                    @error('notification_email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SMS Bildirimleri -->
                        <div class="card card-info mt-4">
                            <div class="card-header">
                                <h3 class="card-title">SMS Bildirimleri</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="enable_sms_notifications" 
                                            name="enable_sms_notifications" value="1" {{ old('enable_sms_notifications', $settings->enable_sms_notifications ?? true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="enable_sms_notifications">SMS Bildirimlerini Etkinleştir</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sms_provider">SMS Sağlayıcısı</label>
                                    <select class="form-control @error('sms_provider') is-invalid @enderror" 
                                        id="sms_provider" name="sms_provider" required>
                                        <option value="netgsm" {{ old('sms_provider', $settings->sms_provider ?? '') == 'netgsm' ? 'selected' : '' }}>NetGSM</option>
                                        <option value="twilio" {{ old('sms_provider', $settings->sms_provider ?? '') == 'twilio' ? 'selected' : '' }}>Twilio</option>
                                        <option value="messagebird" {{ old('sms_provider', $settings->sms_provider ?? '') == 'messagebird' ? 'selected' : '' }}>MessageBird</option>
                                    </select>
                                    @error('sms_provider')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Bildirim Olayları -->
                        <div class="card card-warning mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Bildirim Olayları</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Bildirim Gönderilecek Olaylar</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="event_new_subscriber" 
                                            name="notification_events[]" value="new_subscriber" 
                                            {{ in_array('new_subscriber', old('notification_events', $settings->notification_events ?? [])) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="event_new_subscriber">Yeni Abone Kaydı</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="event_subscription_expiring" 
                                            name="notification_events[]" value="subscription_expiring" 
                                            {{ in_array('subscription_expiring', old('notification_events', $settings->notification_events ?? [])) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="event_subscription_expiring">Abonelik Sona Eriyor</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="event_payment_received" 
                                            name="notification_events[]" value="payment_received" 
                                            {{ in_array('payment_received', old('notification_events', $settings->notification_events ?? [])) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="event_payment_received">Ödeme Alındı</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="event_system_alert" 
                                            name="notification_events[]" value="system_alert" 
                                            {{ in_array('system_alert', old('notification_events', $settings->notification_events ?? [])) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="event_system_alert">Sistem Uyarısı</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Bildirim Ayarlarını Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 