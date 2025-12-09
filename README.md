# Çoklu Kiracılı Site Yönetimi (PHP + MySQL)

Bu depo, apartman/site yönetimi için çok kiracılı (multi-tenant) SaaS mimarisinin PHP ile yazılmış hafif bir örnek iskeletini ve ilişkisel veritabanı şemasını içerir. Çekirdek hedefler:

- **İzolasyon**: Tüm sorgularda `company_id` zorunlu alanı ile veri ayrışması.
- **Roller**: Süper Admin, Yönetim Firması, Personel (muhasebe/saha), Bina Yöneticisi ve Sakinler için RBAC.
- **Modüller**: Finans (aidat, POS, tahsilat), Operasyon (iş kaydı), İletişim (duyuru, SMS) ve kota/paket yönetimi.

## Klasör Yapısı

- `db/schema.sql`: InnoDB şeması, tüm tablolarda `company_id` ile izolasyon kuralları.
- `config/`: Veritabanı, SMS ve tenancy yapılandırmaları.
- `src/Controllers/`: HTTP uçlarını temsil eden ince controller katmanı.
- `src/Services/`: İş kurallarının işlendiği servis katmanı (paketler, bina kaydı, finans, destek, duyuru).
- `src/Routing/Router.php`: Basit rota dağıtıcı.
- `public/index.php`: Hafif JSON çıktılı ön uç; PHP yerleşik sunucusu ile çalışır.
- `bootstrap.php`: Autoloader ve yapılandırma yükleyici.

## Çalıştırma

1. PHP 8.1+ ve MySQL 8+ kurulu olmalıdır.
2. `config/config.php` içindeki veritabanı ve SMS ayarlarını düzenleyin.
3. Yerleşik sunucuyu başlatın:
   ```bash
   php -S localhost:8000 -t public
   ```
4. Örnek istekler (query string ile):
   - Şirket oluşturma: `http://localhost:8000/?route=superadmin/companies&name=Deneme&email=demo@example.com`
   - Bina ekleme: `http://localhost:8000/?route=company/buildings&company_id=1&name=Blok%20A&unit_count=24`
   - Aidat fatura kesme: `http://localhost:8000/?route=finance/invoices&company_id=1&unit_id=10&amount=750&description=Kasım%20Aidat`

## Roller ve Yetkiler

- **Süper Admin**: Firma açma, paket-kota tanımı, SMS/ödeme sağlayıcı ayarı.
- **Yönetim Firması Admin**: Bina/site açma, personel daveti, izin grubu atama.
- **Personel (Muhasebeci/Saha)**: Tahsilat-gider girişi, iş kaydı yönetimi.
- **Bina Yöneticisi**: Kendi binasının finans raporu ve duyuru yönetimi.
- **Sakin (Ev Sahibi/Kiracı)**: Borç görüntüleme, online ödeme, arıza/istek bildirimi.

## Modül Özeti

- **Finans**: Aidat/fatura üretimi, gecikme faizi, POS entegrasyonuna hazır ödeme akışı, tedarikçi (cari) kayıtları.
- **Operasyon**: Arıza/iş ticket açma-kapama, saha elemanı atama, durum logları.
- **İletişim**: Bina/site duyuruları, SMS bildirimleri, şeffaf pano veri kaynakları.
- **Paket-Kota Yönetimi**: Bina/daire/SMS/disk kotaları paketlere bağlanır; Süper Admin tarafından güncellenir.

## Notlar

Bu iskelet, şemada tanımlı tablolarla uyumlu olacak şekilde servis metotları ve controller uçları sağlar. Gerçek veri kalıcılığı için `db/schema.sql` şemasına uygun PDO tabanlı repository katmanı ekleyebilir, ödeme ve SMS sağlayıcılarını gerçek API anahtarlarıyla yapılandırabilirsiniz.
