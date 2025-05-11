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
- users: Kullanıcı bilgileri
- tarifeler: Tarife detayları
- kampanyalar: Kampanya bilgileri
- abonelikler: Abonelik kayıtları
- teklifs: Teklif kayıtları
- sessions: Oturum yönetimi
- password_reset_tokens: Şifre sıfırlama işlemleri

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
Proje sahibi: [İsim] - [Email]

Proje Linki: [https://github.com/kullanici/mobil-tarife-kampanya](https://github.com/kullanici/mobil-tarife-kampanya)
