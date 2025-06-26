# Sitemap Proyek "Peduli Bersama"

Sitemap ini dibagi menjadi tiga bagian utama: **Halaman Publik**, **Otentikasi & Halaman Statis**, dan **Dasbor Pengguna**.

---

### 1. Halaman Publik (Dapat Diakses Semua Orang)

- **/**
  - **Deskripsi:** Halaman utama (beranda) aplikasi.
  - **URL:** `/` atau `/home`
- **/campaigns**
  - **Deskripsi:** Menampilkan daftar semua kampanye donasi yang aktif.
  - **URL:** `/campaigns`
- **/campaigns/{slug}**
  - **Deskripsi:** Halaman detail untuk satu kampanye spesifik. Menampilkan deskripsi, progres, donatur, dan komentar.
  - **URL:** `/campaigns/nama-kampanye-unik`
- **/campaigns/{slug}/donors**
  - **Deskripsi:** Menampilkan daftar donatur untuk sebuah kampanye.
  - **URL:** `/campaigns/nama-kampanye-unik/donors`
- **/about**
  - **Deskripsi:** Halaman "Tentang Kami".
  - **URL:** `/about`
- **/contact**
  - **Deskripsi:** Halaman kontak untuk mengirim pesan atau pertanyaan.
  - **URL:** `/contact`

---

### 2. Otentikasi & Halaman Statis

- **/login**
  - **Deskripsi:** Halaman untuk masuk ke akun.
  - **URL:** `/login`
- **/register**
  - **Deskripsi:** Halaman untuk mendaftar akun baru.
  - **URL:** `/register`
- **/terms**
  - **Deskripsi:** Halaman Syarat dan Ketentuan.
  - **URL:** `/terms`
- **/privacy**
  - **Deskripsi:** Halaman Kebijakan Privasi.
  - **URL:** `/privacy`

---

### 3. Dasbor Pengguna (URL diawali dengan `/dashboard/`)

Area ini hanya bisa diakses setelah pengguna login. Akses ke fitur-fitur tertentu dibatasi berdasarkan peran pengguna (Admin, Pengelola Kampanye/Creator, Donatur).

- **/dashboard**
  - **Deskripsi:** Halaman utama dasbor setelah login. Menampilkan ringkasan statistik.
  - **URL:** `/dashboard`

- **Manajemen Profil (Untuk Semua Pengguna)**
  - `/dashboard/profile`: Lihat profil.
  - `/dashboard/profile/edit`: Edit profil dan ubah kata sandi.

- **Manajemen Kampanye (Untuk Admin & Creator)**
  - `/dashboard/campaigns`: Lihat semua kampanye yang dikelola.
  - `/dashboard/campaigns/create`: Buat kampanye baru.
  - `/dashboard/campaigns/{slug}`: Lihat detail kampanye (versi dasbor).
  - `/dashboard/campaigns/{slug}/edit`: Edit kampanye.
  - `/dashboard/my-campaigns`: Lihat kampanye milik sendiri (untuk Creator).

- **Manajemen Donasi (Untuk Semua Pengguna)**
  - `/dashboard/donations`: Lihat riwayat donasi (Admin melihat semua, pengguna lain melihat miliknya).
  - `/dashboard/my-donations`: Lihat riwayat donasi pribadi.
  - `/dashboard/donations/{id}/receipt`: Unduh bukti donasi.

- **Fitur Khusus Admin**
  - `/dashboard/users`: Kelola semua akun pengguna (tambah, edit, hapus).
  - `/dashboard/categories`: Kelola kategori kampanye.
  - `/dashboard/messages`: Lihat dan kelola pesan yang masuk dari halaman kontak.
  - `/dashboard/comments`: Moderasi semua komentar di platform.
  - `/dashboard/feedbacks`: Kelola kritik dan saran.
  - `/dashboard/withdrawals`: Kelola permintaan penarikan dana.

- **Laporan & Notifikasi**
  - `/dashboard/reports`: Lihat laporan donasi dan kampanye.
  - `/dashboard/notifications`: Lihat semua notifikasi.
