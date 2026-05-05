# SIMAGANG (Sistem Informasi Manajemen Magang)

SIMAGANG adalah platform berbasis Laravel yang dirancang khusus untuk mengelola seluruh proses administrasi magang di **Bakorwil III Malang**. Aplikasi ini mengintegrasikan formulir pendaftaran publik, manajemen kuota divisi otomatis, hingga panel admin berbasis **Filament** untuk monitoring data peserta secara *real-time*.

## ✨ Fitur Utama

- 📝 **Multi-step Registration** - Formulir pendaftaran interaktif dengan validasi berkas (PDF & Image).
- 🏢 **Division & Quota Management** - Pengaturan kuota otomatis per divisi yang berkurang saat peserta diterima.
- 🔐 **Filament Admin Panel** - Manajemen data peserta magang (Pending, Aktif, Selesai, Ditolak) dengan antarmuka modern.
- 📑 **Document Management** - Penyimpanan dan peninjauan berkas digital (CV, KTM, Proposal) secara terpusat.
- 🛡️ **System Logs** - Pencatatan setiap aktivitas perubahan data (Create, Update, Delete) untuk audit.
- 📱 **WhatsApp Integration** - Fitur konfirmasi pendaftaran langsung ke WhatsApp Admin (Pak Wildan).
- ✍️ **Token-based Review** - Sistem ulasan alumni magang berbasis token unik (sekali pakai).

## 🛠️ Prasyarat

- PHP >= 8.2
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

7. **Migrasi dan Seed Database**
   ```bash
   php artisan migrate --seed
   ```

8. **Link Storage (Sangat Penting)**
   Pastikan folder storage terhubung agar berkas dan pasfoto bisa diakses oleh publik:
   ```bash
   php artisan storage:link
   ```

9. **Build assets frontend**
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
2. Buka menu **System Logs**.
3. Anda dapat melihat siapa, kapan, dan apa saja perubahan (data lama vs data baru) yang dilakukan.

## 👥 Kontributor & Kontak

- **Lead Developer:** [Nama Anda / Mahasiswa Magang]
- **Supervisor:** Pak Wildan & Pak Agus (Bakorwil III Malang)
- **Institusi:** State University of Surabaya (UNESA)

---
&copy; 2026 **Bakorwil III Malang**. All rights reserved.
