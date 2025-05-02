# Odama - Laravel Core Library

Odama là một thư viện nhân hệ thống giúp tăng tốc phát triển các dự án Laravel bằng cách cung cấp các service, model, repository, helper và các tiện ích mở rộng khác.

## 📌 Tính năng chính
- **Cung cấp Service, Repository, Model mở rộng**
- **Hỗ trợ các API Resources chuẩn hóa dữ liệu**
- **Cung cấp các Middleware bảo mật**
- **Tích hợp các Helper tiện ích**
- **Hỗ trợ SoftDeletes, Logging, và UUID cho model**

## 📂 Cấu trúc thư mục
```plaintext
odama/
├── src/
│   ├── app/
│   │   ├── actions/       # Action-based controllers
│   │   ├── services/      # Business logic services
│   │   ├── models/        # Eloquent models
│   │   ├── repositories/  # Repository pattern
│   │   ├── providers/     # Laravel service providers
│   │   ├── contracts/     # Interface chuẩn hóa service/repository
│   │   ├── middleware/    # Custom middleware
│   │   ├── concerns/      # Traits tái sử dụng
│   │   ├── api/           # API Resources
├── helpers/               # Helper function (không có namespace)
├── database/              # Migrations và seeders
├── resources/             # Lang & Views
├── tests/                 # Unit test & Feature test
├── composer.json          # File khai báo package
├── README.md              # Tài liệu hướng dẫn
├── LICENSE                # Giấy phép sử dụng
```

## 🚀 Cài đặt
```bash
composer require odama/core
```

## 🔧 Cấu hình
Tự động đăng ký `OdamaServiceProvider`, hoặc có thể thêm thủ công trong `config/app.php`:
```php
'providers' => [
    Odama\Providers\OdamaServiceProvider::class,
],
```

## 📘 Sử dụng
### 1️⃣ Gọi Helpers
```php
format_currency(1000000, 'VND'); // "1.000.000 VND"
```

### 2️⃣ Dùng Repository
```php
$userRepo = app(\Odama\Repositories\UserRepository::class);
$users = $userRepo->all();
```

### 3️⃣ Dùng Concerns trong Model
```php
use Illuminate\Database\Eloquent\Model;
use Odama\Concerns\HasUuid;

class User extends Model {
    use HasUuid;
}
```

## 🛠️ Đóng góp
Mọi đóng góp đều được hoan nghênh! Hãy fork repo và gửi pull request.

## 📄 Giấy phép
Odama được phát hành dưới giấy phép MIT.
