# SPPG – Portal Menu, Gizi & Pengaduan Masyarakat

SPPG (Sistem Pemantauan Pangan & Gizi) adalah aplikasi berbasis Laravel untuk mengelola **menu makanan sekolah**, **informasi gizi**, dan **pengaduan masyarakat**.  
Proyek ini dikembangkan untuk sekolah binaan agar orang tua, siswa, dan petugas gizi dapat memantau menu harian, riwayat menu, serta mengirim & menindaklanjuti pengaduan terkait kualitas makanan.

---

## Fitur Utama

### Frontend (Publik)

- **Beranda portal SPPG**
  - Hero section berisi ringkasan jumlah sekolah binaan, menu hari ini, anggota tim, dan total pengaduan.
  - Navigasi cepat ke bagian Menu, Tim, Aduan, dan Kontak.

- **Menu Hari Ini**
  - Menampilkan menu harian aktif (misalnya: *Nasi, Ayam Bakar, Tumis Bayam, Jeruk*).
  - Ditautkan dengan data sekolah dan tanggal.

- **Riwayat Menu**
  - Halaman `Riwayat Menu MBG` dengan filter:
    - Tanggal
    - Bulan
    - Sekolah
  - Memungkinkan orang tua dan petugas untuk melihat historis menu tanpa reload halaman.

- **Tim SPPG**
  - Daftar tim yang dikelola lewat `Team` model.
  - Menampilkan profil singkat profesional di balik layanan gizi harian.

- **Pengaduan Masyarakat**
  - Form pengaduan dengan dukungan **anonim** atau identitas jelas.
  - Setiap pengaduan mendapatkan **nomor tiket** unik.
  - Penjelasan alur tindak lanjut (laporan terkirim → verifikasi → diproses → selesai).
  - Status pengaduan: `terkirim`, `diproses`, `selesai`.

### Backend (Dashboard)

Dashboard internal untuk **admin**, **petugas gizi**, dan **petugas pengaduan**:

- **Manajemen User**
  - Kelola akun pengguna dan role.

- **Manajemen Sekolah**
  - CRUD data sekolah binaan.

- **Manajemen Menu Gizi**
  - CRUD menu harian.
  - Detail menu dengan informasi gizi, catatan, dan riwayat.
  - Tampilan detail menu yang kaya informasi.

- **Manajemen Pengaduan**
  - Admin/gizi dapat melihat, memfilter, dan mengubah status pengaduan.
  - Mendukung alur penanganan dari tiket masuk hingga selesai.

---

## Teknologi & Arsitektur

- **Framework**: Laravel (PHP)
- **View layer**: Blade templates (frontend & backend)
- **Styling**: Tailwind CSS (via Vite)
  - Konfigurasi di `tailwind.config.js`
  - Entry CSS/JS di `resources/css/app.css` & `resources/js/app.js`
- **Bundler / Dev server**: Vite (`vite.config.js`)

---

## Instalasi

### Prerequisite

- PHP 8.2+ (sesuaikan dengan versi yang didukung Laravel di proyek ini)
- Composer
- Database MySQL / MariaDB
- Node.js + npm
- Git

### Langkah Instalasi

```bash
# 1. Clone repo
git clone https://github.com/Xylavi/sppg.git
cd sppg

# 2. Instal dependency PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Atur konfigurasi database di file .env
# DB_CONNECTION=mysql (Jika menggunakan MySQL)
# DB_DATABASE=sppg
# DB_USERNAME=...
# DB_PASSWORD=...

# 6. Jalankan migrasi & seeder
php artisan migrate --seed

# 7. Instal dependency frontend
npm install

# 8. Build asset (dev)
npm run dev
# atau untuk production
npm run build
```

---

## Menjalankan Aplikasi

### Mode Development

Di satu terminal:

```bash
php artisan serve
```

Di terminal lain:

```bash
npm run dev
```

Lalu buka:

- Frontend publik: `http://127.0.0.1:8000/`
- Dashboard backend: `http://127.0.0.1:8000/login` (kemudian login dengan akun yang sudah Anda buat atau yang disediakan oleh seeder jika ada)

> Catatan: jika port atau command berbeda di setup Anda, sesuaikan instruksinya.

---

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT.  
Lihat file [LICENSE](LICENSE) untuk detail lengkap.
