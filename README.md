# SIMAGANG (Sistem Informasi Manajemen Magang)

SIMAGANG adalah platform berbasis Laravel yang dirancang khusus untuk mengelola seluruh proses administrasi magang di **Bakorwil III Malang**. Aplikasi ini mengintegrasikan formulir pendaftaran publik, manajemen kuota divisi otomatis, hingga panel admin berbasis **Filament** untuk monitoring data peserta secara *real-time*.

## ✨ Fitur Utama

- 📝 **Multi-step Registration** - Formulir pendaftaran interaktif dengan validasi berkas (PDF & Gambar).
- 🏢 **Division & Quota Management** - Pengaturan kuota otomatis per divisi yang berkurang saat peserta diterima.
- 🔐 **Filament Admin Panel** - Manajemen data peserta magang (Menunggu, Aktif, Selesai, Ditolak) dengan antarmuka modern.
- 📑 **Document Management** - Penyimpanan dan peninjauan berkas digital (CV, KTM, Proposal) secara terpusat.
- 🛡️ **System Logs** - Pencatatan setiap aktivitas perubahan data (Create, Update, Delete) untuk audit.
- ✍️ **Token-based Review** - Sistem ulasan purna magang berbasis token unik (sekali pakai).

## 🛠️ Prasyarat

- PHP >= 8.4
- Composer
- Node.js & npm
- Database (MySQL / MariaDB / SQLite)
- Ekstensi PHP: GD atau Imagick (untuk pemrosesan gambar)

## 🚀 Instalasi

1. **Clone repository**
   ```bash
   git clone <repo-url-simagang>
   cd simagang
   ```

2. **Install dependensi PHP**
   ```bash
   composer install
   ```

3. **Install dependensi JavaScript**
   ```bash
   npm install
   ```

4. **Salin file environment**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi Database**
   Edit file `.env` dan sesuaikan dengan database lokal Anda:
   ```env
   DB_CONNECTION=mysql
   DB_DATABASE=simagang_db
   DB_USERNAME=root
   DB_PASSWORD=
   
   APP_URL=http://localhost:8000
   ```

7. **Atur Driver Email di .env**
   Buka file `.env` dan cari bagian MAIL_. 
   Jika menggunakan Gmail Anda harus membuat App Password di pengaturan keamanan Akun Google agar aplikasi  
   diizinkan mengirim email secara otomatis. Berikut adalah parameter yang harus diisi:
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=465
   MAIL_USERNAME=email-resmi-bakorwil@gmail.com
   MAIL_PASSWORD=app-password-anda
   MAIL_ENCRYPTION=ssl
   MAIL_FROM_ADDRESS="${MAIL_USERNAME}"
   MAIL_FROM_NAME="SIMAGANG Bakorwil III Malang"
   ```

   Jika menggunakan Mailtrap berikut ini adalah parameter yang harus diisi:
   ```env
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=username-mailtrap
   MAIL_PASSWORD=password-mailtrap
   ```

8. **Migrasi dan Seed Database**
   ```bash
   php artisan migrate --seed
   ```

9. **Link Storage (Sangat Penting)**
   Pastikan folder storage terhubung agar berkas dan pasfoto bisa diakses oleh publik:
   ```bash
   php artisan storage:link
   ```

10. **Build assets frontend**
   ```bash
   npm run build
   ```

## 📂 Konfigurasi Berkas (Storage)

Untuk memastikan dokumen pendaftaran (PDF) dan pasfoto tampil dengan benar:

- Pastikan `APP_URL` di `.env` sesuai dengan URL akses aplikasi (misal: `http://localhost:8000`).
- Pastikan folder `storage/app/public` memiliki izin akses (*write permission*).
- Jika terjadi error **403 Forbidden**, periksa kembali *symbolic link* dan pastikan file tersimpan di disk `public`.

## 🖥️ Menjalankan Aplikasi

Jalankan server pengembangan Laravel:
```bash
php artisan serve
```
Akses aplikasi melalui:
- **Halaman Depan:** [http://localhost:8000](http://localhost:8000)
- **Pendaftaran:** [http://localhost:8000/register](http://localhost:8000/register)
- **Panel Admin:** [http://localhost:8000/admin](http://localhost:8000/admin)

## 🧪 Testing & Logging

Aplikasi ini mencatat setiap perubahan data penting di tabel `system_logs`. Untuk memantau aktivitas admin:
1. Masuk ke Panel Admin Filament.
2. Buka menu **Riwayat Perubahan**.
3. Anda dapat melihat siapa, kapan, dan apa saja perubahan (data lama vs data baru) yang dilakukan.

## 👥 Kontributor & Kontak

- **Lead Developer:** M. Rizki Anugrah Pratama (UNESA)
- **Supervisor:** M. Wildan Alauddin (Bakorwil III Malang)

---
&copy; 2026 **Bakorwil III Malang**. All rights reserved.
