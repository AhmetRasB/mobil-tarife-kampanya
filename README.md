# Mobil Tarife ve Kampanya Yönetim Sistemi

## Proje Hakkında
Bu proje, mobil operatörler için tarife ve kampanya yönetim sistemidir. Sistem, müşterilerin tarife ve kampanyaları görüntülemesine, teklif oluşturmasına ve abonelik yönetimine olanak sağlar. Ayrıca, yöneticiler için kapsamlı bir yönetim paneli sunar.

## Özellikler

### Kullanıcı Özellikleri
- Kullanıcı kaydı ve girişi
- Tarife listeleme ve detay görüntüleme
- Kampanya listeleme ve detay görüntüleme
- Teklif oluşturma ve takip etme
- Abonelik yönetimi
- Kişisel profil yönetimi

### Yönetici Özellikleri
- Kullanıcı yönetimi
- Tarife yönetimi (ekleme, düzenleme, silme)
- Kampanya yönetimi (ekleme, düzenleme, silme)
- Abonelik yönetimi
- Teklif onaylama/reddetme
- İstatistik ve raporlama
- Dashboard ile genel durum takibi

### Abonelik ve Fatura Yönetimi
- Otomatik fatura oluşturma
- Aylık fatura takibi
- Fatura durumu yönetimi (ödenmiş/ödenmemiş/askıya alınmış)
- Fatura dönemi takibi
- Fatura açıklamaları ve detayları

### Cihaz ve SIM Kart Yönetimi
- Telefon envanteri takibi
- SIM kart durumu yönetimi
- IMEI ve seri numarası takibi
- Cihaz durumu izleme (aktif/pasif/arızalı)
- SIM kart aktivasyon takibi

### Raporlama Sistemi
- Abone raporları
- Stok raporları
- Finansal raporlar
- Aylık/yıllık istatistikler
- Grafiksel analizler

### Teknik Güncellemeler
- Subscriber tablosunda tc_no alanı nullable yapıldı
- Teklif onaylama sürecinde abone oluşturma iyileştirildi
- Fatura oluşturma servisi eklendi
- Abonelik-fatura ilişkisi kuruldu

## Teknik Detaylar

### Kullanılan Teknolojiler
- PHP 8.2
- Laravel 12.13.0
- MySQL
- Bootstrap 5
- AdminLTE 3.2
- Chart.js
- Font Awesome

### Veritabanı Yapısı

#### Temel Tablolar
- users: Kullanıcı bilgileri
- roles: Rol tanımları
- permissions: Yetki tanımları
- role_user: Kullanıcı-Rol ilişkileri
- permission_role: Rol-Yetki ilişkileri
- positions: Pozisyon tanımları

#### Log ve İzleme Tabloları
- audit_trail: Denetim kayıtları
- login_logs: Giriş kayıtları
- logout_logs: Çıkış kayıtları

#### Bildirim Tabloları
- notification_types: Bildirim türleri
- notifications: Bildirimler
- notification_assignments: Bildirim atamaları
- notification_reads: Bildirim okunma kayıtları

#### Sistem Tabloları
- system_settings: Sistem ayarları
- related_settings: İlişkili ayarlar
- api_settings: API ayarları

#### Takvim ve Servis Tabloları
- calendar_events: Takvim etkinlikleri
- tele_services: Telekom servisleri
- sms_logs: SMS kayıtları
- fax_logs: Fax kayıtları
- call_logs: Arama kayıtları

#### Varlık ve Stok Tabloları
- assets: Varlıklar
- stock_movements: Stok hareketleri
- phones: Telefonlar
- sim_cards: SIM kartları
- devices: Cihazlar

#### Organizasyon Tabloları
- locations: Konumlar
- sectors: Sektörler
- organizations: Kurumlar
- ad_networks: Reklam ağları
- authorized_persons: Yetkili kişiler

#### Abonelik Tabloları
- subscribers: Aboneler
- subscriptions: Abonelikler
- tarifeler: Tarifeler
- kampanyalar: Kampanyalar
- teklifs: Teklifler

### Güvenlik Özellikleri
- CSRF koruması
- XSS koruması
- SQL injection koruması
- Şifre hashleme
- Oturum yönetimi
- Yetkilendirme kontrolleri
- Rate limiting

### Kurulum

1. Projeyi klonlayın:
```bash
git clone [proje-url]
```

2. Bağımlılıkları yükleyin:
```bash
composer install
```

3. .env dosyasını oluşturun:
```bash
cp .env.example .env
```

4. Veritabanı ayarlarını yapılandırın:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mobil_tarife_kampanya
DB_USERNAME=root
DB_PASSWORD=
```

5. Uygulama anahtarını oluşturun:
```bash
php artisan key:generate
```

6. Veritabanı tablolarını oluşturun:
```bash
php artisan migrate
```

7. Örnek verileri yükleyin:
```bash
php artisan db:seed
```

8. Uygulamayı çalıştırın:
```bash
php artisan serve
```

### Varsayılan Kullanıcılar

#### Admin Kullanıcısı
- Email: admin@example.com
- Şifre: password

#### Test Kullanıcısı
- Email: test@example.com
- Şifre: password

## Kullanım Kılavuzu

### Kullanıcı Paneli
1. Kayıt olun veya giriş yapın
2. Ana sayfada mevcut tarife ve kampanyaları görüntüleyin
3. İstediğiniz tarife için teklif oluşturun
4. Tekliflerinizi "Tekliflerim" sayfasından takip edin
5. Onaylanan teklifler için abonelik oluşturun
6. Aboneliklerinizi "Aboneliklerim" sayfasından yönetin

### Yönetici Paneli
1. Admin hesabıyla giriş yapın
2. Dashboard'da genel istatistikleri görüntüleyin
3. Sol menüden ilgili bölümlere erişin:
   - Tarifeler: Tarife yönetimi
   - Kampanyalar: Kampanya yönetimi
   - Abonelikler: Abonelik yönetimi
   - Teklifler: Teklif onaylama/reddetme

## Katkıda Bulunma
1. Bu depoyu fork edin
2. Yeni bir özellik dalı oluşturun (`git checkout -b yeni-ozellik`)
3. Değişikliklerinizi commit edin (`git commit -am 'Yeni özellik eklendi'`)
4. Dalınıza push yapın (`git push origin yeni-ozellik`)
5. Bir Pull Request oluşturun

## Lisans
Bu proje MIT lisansı altında lisanslanmıştır. Detaylar için [LICENSE](LICENSE) dosyasına bakın.

## İletişim


Proje Linki: [https://github.com/ahmetrasb/mobil-tarife-kampanya](https://github.com/ahmetrasb/mobil-tarife-kampanya)
