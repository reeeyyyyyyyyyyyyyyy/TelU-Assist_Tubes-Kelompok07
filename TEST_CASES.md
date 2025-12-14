# Dokumentasi Test Case - Tel-U Assist

**Project Name:** Tel-U Assist  
**Testing Type:** Functional & Non-Functional Testing  
**Tools:** Manual Testing & Cypress (Automation)  
**Date:** 14 December 2025

---

## 1. Functional Testing

### A. Modul: Kebersihan Report (CRUD)
**Focus:** Memastikan mahasiswa dapat membuat laporan dan petugas/admin dapat memprosesnya.

| Scenario ID | Case ID | Test Scenario | Type | Test Case | Pre Condition | Steps | Steps Description | Expected Result | Status (Pass/Fail) |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **SC01** | **TC01-01** | Create Report Kebersihan (Success) | Positive | Verifikasi mahasiswa berhasil membuat laporan dengan data valid | User login sebagai Mahasiswa | 1. Buka Halaman Report<br>2. Klik "Buat Laporan"<br>3. Isi Deskripsi<br>4. Pilih Lokasi<br>5. Upload Foto<br>6. Klik Submit | - Akses menu `/reports`<br>- Input `description`: "Sampah menumpuk di koridor"<br>- Select `location_id`: "Gedung TULT"<br>- Input `image`: file.jpg (valid format)<br>- Klik tombol "Lapor" | Data tersimpan di database, Redirect ke halaman index, Muncul pesan sukses "Laporan berhasil dibuat" | |
| **SC01** | **TC01-02** | Create Report (Validation Fail) | Negative | Verifikasi validasi form jika field wajib dikosongkan | User login sebagai Mahasiswa | 1. Buka Form Report<br>2. Kosongkan semua field<br>3. Klik Submit | - Akses `/reports/create`<br>- Biarkan field deskripsi dan gambar kosong<br>- Klik tombol Simpan | Muncul pesan error validasi: "The description field is required" dan "The image field is required" | |
| **SC01** | **TC01-03** | Read/View Report Details | Positive | Verifikasi user dapat melihat detail laporan yang sudah dibuat | User login (Mahasiswa/Petugas) | 1. Buka List Report<br>2. Klik salah satu laporan | - Akses `/reports`<br>- Klik tombol "Detail" atau Judul Laporan | Halaman detail terbuka, menampilkan deskripsi, lokasi, status, dan foto bukti yang benar | |
| **SC01** | **TC01-04** | Update Status Report | Positive | Verifikasi petugas dapat mengubah status laporan (misal: Pending -> Processed) | User login sebagai Petugas | 1. Buka Detail Report<br>2. Ubah Status<br>3. Simpan | - Akses detail laporan ID tertentu<br>- Ubah dropdown `status` dari `Pending` ke `Processed`<br>- Klik Update | Status di database berubah menjadi "Processed", Tampilan status di frontend berubah | |
| **SC01** | **TC01-05** | Delete Report | Positive | Verifikasi admin atau pemilik laporan dapat menghapus laporan | User login sebagai Admin/Owner | 1. Buka List Report<br>2. Klik tombol Delete | - Cari laporan ID X<br>- Klik icon tong sampah/delete<br>- Konfirmasi alert browser "Are you sure?" | Data laporan terhapus dari list dan database | |

### B. Modul: Lost & Found
**Focus:** Posting barang hilang/temu dan filter status.

| Scenario ID | Case ID | Test Scenario | Type | Test Case | Pre Condition | Steps | Steps Description | Expected Result | Status (Pass/Fail) |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **SC02** | **TC02-01** | Post Lost Item (Success) | Positive | Verifikasi user bisa posting barang hilang dengan gambar | User Login | 1. Buka Menu Lost&Found<br>2. Klik "Tambah Barang"<br>3. Isi Form Lengkap<br>4. Submit | - Akses `/lost-found/create`<br>- Input `item_name`: "Kunci Motor"<br>- Select `type`: "Lost"<br>- Upload `image`: key.jpg<br>- Submit | Item muncul di list Lost&Found dengan gambar thumbnail yang benar | |
| **SC02** | **TC02-02** | Update Item Status (Found) | Positive | Verifikasi user bisa mengubah status barang menjadi "Found" (Sudah ditemukan) | User Login (Pemilik Item) | 1. Buka Detail Item<br>2. Klik "Tandai Ditemukan" | - Akses detail barang milik sendiri<br>- Klik tombol/checkbox status "Resolved/Found" | Status item berubah, item mungkin dipindahkan ke tab "History" atau ditandai selesai | |
| **SC02** | **TC02-03** | Filter Lost & Found List | Positive | Verifikasi fitur filter kategori barang (Lost vs Found) berfungsi | User Login | 1. Buka Index Lost&Found<br>2. Klik Filter "Found Items" | - Akses `/lost-found`<br>- Klik tab/filter "Found Items" | List hanya menampilkan item dengan type "Found", item "Lost" disembunyikan | |

### C. Modul: Master Data (Admin Only)
**Focus:** Pengelolaan data Lokasi dan Kategori Laporan.

| Scenario ID | Case ID | Test Scenario | Type | Test Case | Pre Condition | Steps | Steps Description | Expected Result | Status (Pass/Fail) |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **SC03** | **TC03-01** | Create Master Location | Positive | Verifikasi admin bisa menambah lokasi baru untuk dropdown laporan | Login sebagai Admin | 1. Buka Menu Locations<br>2. Tambah Lokasi Baru<br>3. Submit | - Input `name`: "Gedung Tokong Nanas"<br>- Klik Simpan | Lokasi baru tersimpan di DB, Muncul di dropdown saat user membuat report | |
| **SC03** | **TC03-02** | Edit Master Location | Positive | Verifikasi admin bisa memperbaiki nama lokasi | Login sebagai Admin | 1. Buka List Location<br>2. Edit salah satu lokasi<br>3. Update | - Ubah "Gedung Tokong Nanas" menjadi "Gedung TULT"<br>- Simpan | Nama lokasi berubah di database dan tampilan list | |
| **SC04** | **TC04-01** | Create Report Category | Positive | Verifikasi admin bisa menambah kategori laporan | Login sebagai Admin | 1. Buka Menu Categories<br>2. Tambah Kategori<br>3. Submit | - Input `name`: "Fasilitas Rusak"<br>- Klik Simpan | Kategori baru tersimpan dan bisa dipilih saat filter/pembuatan laporan | |

### D. Modul: Manage User (Role Action Flow)
**Focus:** Skenario integrasi: Registrasi -> Ubah Role oleh Admin -> Login Role Baru.

| Scenario ID | Case ID | Test Scenario | Type | Test Case | Pre Condition | Steps | Steps Description | Expected Result | Status (Pass/Fail) |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **SC05** | **TC05-01** | User Registration (Dummy) | Positive | Membuat user dummy baru untuk pengujian role | Halaman Login Terbuka | 1. Klik Register<br>2. Isi data diri lengkap<br>3. Submit | - Input `name`: "User Dummy"<br>- Input `email`: "dummy@telkomuniversity.ac.id"<br>- Input `password`: "password123"<br>- Submit | User berhasil register dan otomatis redirect ke **Dashboard Mahasiswa** (Default Role) | |
| **SC05** | **TC05-02** | Admin Change Role | Positive | Admin mengubah role user dummy menjadi petugas | Login sebagai Admin | 1. Buka Menu User Management<br>2. Cari User Dummy<br>3. Edit Role -> Petugas<br>4. Simpan | - Cari email "dummy@..."<br>- Klik Edit<br>- Ubah dropdown `role` jadi `petugas` (Officer)<br>- Update | Role di database berubah menjadi 'officer', Muncul pesan sukses update user | |
| **SC05** | **TC05-03** | Login as Officer Check | Positive | Verifikasi user dummy login ulang dan mendapat hak akses petugas | User Dummy Logout | 1. Login pakai akun dummy<br>2. Cek halaman landing | - Input email "dummy@..." & password "password123"<br>- Tekan Login | System mendeteksi role baru, **Redirect ke Dashboard Petugas** (bukan dashboard mahasiswa) | |

---

## 2. Non-Functional Testing

**Focus:** Keamanan, Performa, dan Usability (sesuai ketentuan 3 aspek).

| Scenario ID | Case ID | Test Scenario | Type | Test Case | Pre Condition | Steps | Steps Description | Expected Result | Status (Pass/Fail) |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **SC06** | **TC06-01** | Security (Access Control / IDOR) | Negative | Verifikasi mahasiswa tidak bisa memaksa masuk ke halaman admin via URL | Login sebagai Mahasiswa | 1. Ubah URL browser ke route admin | - Ketik manual di address bar: `base_url/admin/users` atau `base_url/locations/create` | Sistem menolak akses: Menampilkan Error 403 (Forbidden) atau Redirect paksa ke Home | |
| **SC06** | **TC06-02** | Performance (Page Load Speed) | Performance | Verifikasi waktu loading halaman utama Lost&Found (yang memuat gambar) | Koneksi Internet Stabil | 1. Buka Inspect Element -> Network<br>2. Hard Refresh halaman | - Akses `/lost-found`<br>- Tekan Ctrl+F5<br>- Cek waktu `Load` di tab Network | Halaman terbuka sempurna (termasuk gambar) di bawah **3 detik** (Acceptable threshold) | |
| **SC06** | **TC06-03** | Usability (Mobile Responsiveness) | Usability | Verifikasi layout website saat diakses via perangkat mobile | - | 1. Buka Inspect Element<br>2. Toggle Device Toolbar (Mobile)<br>3. Pilih iPhone SE/Samsung S20 | - Cek Navbar (harus jadi hamburger menu)<br>- Cek Form Input (tidak melebar keluar layar)<br>- Cek Tabel (bisa di-scroll horizontal jika lebar) | Layout responsif, konten terbaca jelas, tidak ada elemen yang tertumpuk atau terpotong | |
