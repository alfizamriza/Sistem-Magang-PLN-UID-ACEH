# ⚡ Sistem Manajemen Magang PLN UID Aceh

<div align="center">

![PLN Logo](https://img.shields.io/badge/PLN-UID%20Aceh-blue?style=for-the-badge&logo=lightning&logoColor=yellow)
![Laravel](https://img.shields.io/badge/Laravel-10.x-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)

**Sistem Manajemen Program Magang Digital untuk PT PLN (Persero) Unit Induk Distribusi Aceh**

[Demo](#demo) • [Fitur](#fitur) • [Instalasi](#instalasi) • [Dokumentasi](#dokumentasi) • [Kontribusi](#kontribusi)

</div>

---

## 📋 Tentang Proyek

Sistem Manajemen Magang PLN UID Aceh adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola seluruh proses program magang di PT PLN UID Aceh, mulai dari pendaftaran peserta, review aplikasi, penempatan divisi, hingga monitoring peserta aktif.

### 🎯 Tujuan Proyek

- Digitalisasi proses manajemen magang di PLN UID Aceh
- Meningkatkan efisiensi proses seleksi dan administrasi
- Memberikan transparansi kepada peserta magang
- Memudahkan koordinasi antar divisi
- Menyediakan data analytics untuk evaluasi program

---

## ✨ Fitur Utama

### 👨‍💼 Panel Admin

#### 📊 Dashboard
- **Statistics Cards** - Overview real-time peserta (pending, diterima, total)
- **Interactive Charts** - Grafik pendaftar per bulan dengan Chart.js
- **Quick Actions** - Akses cepat ke fitur-fitur utama
- **Live Clock** - Penanda waktu real-time
- **Activity Feed** - Log aktivitas terbaru sistem

#### 👥 Manajemen Peserta
- **Peserta Baru** - Review pendaftar dengan status pending
  - Detail informasi lengkap peserta
  - Tombol terima/tolak dengan konfirmasi
  - Filter dan pencarian advanced
  - Bulk actions untuk efisiensi
  
- **Semua Peserta** - Database lengkap peserta magang
  - Filter multi-parameter (status, bulan, tahun, jenis magang, tanggal)
  - Search functionality dengan autocomplete
  - Quick view dan edit modal
  - Export data ke Excel
  - Delete dengan soft delete option

#### 🏢 Manajemen Divisi
- CRUD divisi kantor
- Assign peserta ke divisi
- Monitoring kapasitas divisi
- Analytics per divisi

#### 📧 Email Notification System
- **Email Penerimaan** - Template HTML profesional dengan:
  - Design modern dengan gradient colors
  - Info cards untuk tanggal mulai, durasi, dan tanggal selesai
  - WhatsApp group integration
  - Important notes dan checklist
  
- **Email Penolakan** - Template empati dengan:
  - Tone profesional dan menghargai
  - Encouragement untuk apply lagi
  - Tips pengembangan diri

### 🎨 Design Features

- **Modern UI/UX** - Design contemporary dengan Tailwind CSS
- **Responsive Design** - Mobile-first approach
- **Dark Mode Ready** - Support untuk tema gelap (optional)
- **Animations** - Smooth transitions dan micro-interactions
- **Glassmorphism** - Modern glass effect pada cards
- **Color-coded Status** - Visual indicators yang jelas
- **Loading States** - Skeleton loaders dan spinners

---

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 10.x
- **PHP**: 8.1+
- **Database**: MySQL 8.0+
- **Email**: Laravel Mail dengan HTML templates
- **Authentication**: Laravel Sanctum/Breeze

### Frontend
- **CSS Framework**: Tailwind CSS 3.x
- **JavaScript**: Vanilla JS + Alpine.js (optional)
- **Charts**: Chart.js
- **Icons**: Heroicons / SVG Icons
- **Fonts**: System fonts + Google Fonts

### Development Tools
- **Package Manager**: Composer, NPM
- **Build Tool**: Vite
- **Version Control**: Git
- **Code Style**: PSR-12, ESLint

---

## 📦 Instalasi

### Prerequisites

Pastikan sistem Anda memiliki:
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL >= 8.0
- Git

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/alfizamriza/sistem-magang-pln-aceh.git
cd sistem-magang-pln-aceh
```

2. **Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

3. **Environment Setup**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

4. **Database Configuration**

Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pln_magang
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. **Run Migrations & Seeders**
```bash
# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

6. **Build Assets**
```bash
# Development
npm run dev

# Production
npm run build
```

7. **Mail Configuration**

Konfigurasi email di `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@pln-aceh.co.id
MAIL_FROM_NAME="PLN UID Aceh"
```

8. **Start Development Server**
```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

### Default Login Credentials

```
Username: admin
Password: password123
```

⚠️ **Penting**: Ubah password default setelah login pertama!

---

## 📸 Screenshots

### Dashboard Admin
![Dashboard](<img width="1920" height="1725" alt="05_Dashboard-Admin-PLN-11-25-2025_12_19_PM" src="https://github.com/user-attachments/assets/05362393-e858-4cdb-a150-d575c77d94ab" />)
*Dashboard dengan statistics cards, grafik interaktif, dan quick actions*

### Peserta Baru
![Peserta Baru](<img width="1920" height="1058" alt="06_PesertaBaru_Dashboard-Admin-PLN-11-25-2025_12_20_PM" src="https://github.com/user-attachments/assets/16852174-d4e8-4b35-8098-1baba886aa55" />)
*Halaman review peserta baru dengan filter dan search*

### Semua Peserta
![Semua Peserta](<img width="1920" height="1396" alt="11_SemuaPeserta_Dashboard-Admin-PLN-11-25-2025_01_40_PM" src="https://github.com/user-attachments/assets/1497d045-c12e-46b5-af01-0998a5a79219" />)
*Database lengkap dengan advanced filtering*

### Mengelola Divisi
![Semua Peserta](<img width="1920" height="1123" alt="07_ManajemenDivisi_Dashboard-Admin-PLN-11-25-2025_12_22_PM" src="https://github.com/user-attachments/assets/25ca5614-913c-4c34-a69d-b26e9c439f43" />)
*menambahkan divisi baru dan mengatur kapasitas setiap divisi*

### Login Page
![Login](<img width="1920" height="945" alt="04_LoginAdmin_PLN-UID-Aceh-11-25-2025_12_18_PM" src="https://github.com/user-attachments/assets/f67236d0-187b-4102-9b14-f3c9339c5c41" />)
*Modern login page dengan glassmorphism effect*

### Email Template
![Email Template](<img width="1920" height="2403" alt="09_Notifikasi_Selamat-Anda-Diterima-Magang-di-PLN-UID-Aceh-alfizamriza3-gmail-com-Gmail-11-25-2025_12_52_PM" src="https://github.com/user-attachments/assets/b8cef626-425f-4449-8769-2cbd374e1ec6" />)
*Professional email dengan HTML design*

### Home Pgae
![Email Template](<img width="1920" height="3394" alt="01_HomePage_Magang-PLN-UID-Aceh-11-25-2025_12_01_PM" src="https://github.com/user-attachments/assets/fc435379-051a-423e-927d-34c54850e57e" />)
*form pendaftaran untuk calon peserta baru*

---

## 📚 Dokumentasi

### Struktur Database

#### Tabel `participants`
```sql
- id (bigint, PK)
- name (varchar)
- email (varchar, unique)
- phone (varchar, nullable)
- university (varchar)
- magang_type (enum: PKL, Magang, KKN)
- status (enum: pending, waiting, active, finished, accepted, rejected)
- start_date (date, nullable)
- end_date (date, nullable)
- divisi_id (bigint, FK, nullable)
- cv (varchar, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

#### Tabel `divisi`
```sql
- id (bigint, PK)
- nama (varchar)
- kode (varchar, unique)
- kapasitas (integer)
- deskripsi (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### API Endpoints (Optional)

Jika menggunakan API:

```
GET    /api/participants       - List semua peserta
POST   /api/participants       - Tambah peserta baru
GET    /api/participants/{id}  - Detail peserta
PUT    /api/participants/{id}  - Update peserta
DELETE /api/participants/{id}  - Hapus peserta

GET    /api/divisi            - List semua divisi
POST   /api/divisi            - Tambah divisi baru
```

### Email Templates

Template email terletak di controller method `review()`. Untuk custom template:

1. Buat file blade di `resources/views/emails/`
2. Import di controller
3. Gunakan `Mail::send()` dengan view

---

## 🚀 Deployment

### Deployment ke Production

1. **Environment Production**
```bash
# Set APP_ENV to production
APP_ENV=production
APP_DEBUG=false
```

2. **Optimize Application**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

3. **Setup Web Server**
- Apache: Configure `.htaccess`
- Nginx: Setup server block
- Set document root ke `/public`

4. **SSL Certificate**
```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com
```

5. **Cron Jobs**
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

### Deployment Platforms

- **Heroku**: Gunakan Procfile
- **Laravel Forge**: One-click deployment
- **Digital Ocean**: App Platform
- **AWS**: EC2 + RDS
- **Shared Hosting**: cPanel dengan Softaculous

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Berikut cara berkontribusi:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Coding Standards

- Follow PSR-12 untuk PHP
- Use ESLint untuk JavaScript
- Write meaningful commit messages
- Add comments untuk code yang kompleks
- Update documentation jika perlu

---

## 🐛 Bug Reports & Feature Requests

Gunakan [GitHub Issues](https://github.com/alfizamriza/sistem-magang-pln-aceh/issues) untuk:
- 🐛 Melaporkan bug
- 💡 Request fitur baru
- 📖 Pertanyaan dokumentasi

Template issue:
```markdown
**Describe the bug/feature**
A clear description...

**Steps to Reproduce**
1. Go to '...'
2. Click on '...'
3. See error

**Expected behavior**
What you expected...

**Screenshots**
If applicable...

**Environment**
- OS: [e.g. Windows 10]
- Browser: [e.g. Chrome 120]
- PHP Version: [e.g. 8.2]
```

---

## 📝 Changelog

### v1.0.0 (2025-01-XX)
- ✨ Initial release
- 🎨 Modern dashboard design
- 👥 Peserta management system
- 📧 Email notification system
- 🔍 Advanced filtering & search
- 📊 Analytics & charts

### Planned Features (v1.1.0)
- [ ] Dashboard analytics enhancement
- [ ] Export to PDF
- [ ] Automated reminder emails
- [ ] Mobile app (Flutter)
- [ ] Multi-language support
- [ ] Report generation
- [ ] Integration dengan SIMPEG PLN

---

## 📄 License

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

```
MIT License

Copyright (c) 2025 PLN UID Aceh

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction...
```

---

## 👥 Tim Pengembang

- **Project Lead**: [Alfi Zamriza](https://github.com/alfizamriza)
- **Backend Developer**: [Alfi Zamrriza]
- **Frontend Developer**: [Alfi Zamriza]
- **UI/UX Designer**: [Alfi Zamriza]

---

## 🙏 Acknowledgments

- **PT PLN UID Aceh** - For the opportunity and requirements
- **Laravel Community** - For the amazing framework
- **Tailwind CSS** - For the beautiful design system
- **Chart.js** - For interactive charts
- **All Contributors** - Thank you!

---

## 📞 Kontak

- **GitHub**: [https://github.com/alfizamriza/sistem-magang-pln-aceh](https://github.com/alfizamriza/Sistem-Magang-PLN-UID-ACEH.git)

---

<div align="center">

**⚡ Powered by PLN UID Aceh**

Made with ❤️ in Banda Aceh, Indonesia

[⬆ Back to Top](#-sistem-manajemen-magang-pln-uid-aceh)

</div>
