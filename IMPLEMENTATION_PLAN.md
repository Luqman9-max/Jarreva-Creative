Jarreva Creative - Struktur Folder Laravel
Tujuan Proyek
Website landing page dan showcase buku dengan karakteristik:

Halaman publik read-only (landing + detail buku)
Admin panel terpisah untuk CRUD buku
Tidak ada login publik, tidak ada e-commerce, tidak ada blog

Struktur Folder yang Direkomendasikan
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── AuthController.php         # Login/logout admin
│   │   │   ├── DashboardController.php    # Halaman dashboard admin
│   │   │   └── BookController.php         # CRUD buku
│   │   └── Public/
│   │       ├── HomeController.php         # Landing page + daftar buku
│   │       └── BookController.php         # Detail buku
│   ├── Middleware/
│   │   └── AdminAuth.php                  # Proteksi route admin
│   └── Requests/
│       └── Admin/
│           └── BookRequest.php            # Validasi form buku
├── Models/
│   ├── Book.php                           # Model buku
│   └── Admin.php                          # Model admin (opsional, bisa pakai User)
└── Services/
    └── BookService.php                    # Logic bisnis buku (opsional)
database/
├── migrations/
│   ├── xxxx_create_books_table.php
│   └── xxxx_create_admins_table.php       # Atau modifikasi users_table
└── seeders/
    ├── AdminSeeder.php
    └── BookSeeder.php                     # Data dummy untuk development
resources/
├── views/
│   ├── public/
│   │   ├── layouts/
│   │   │   └── app.blade.php              # Layout utama publik
│   │   ├── components/
│   │   │   ├── navbar.blade.php
│   │   │   ├── footer.blade.php
│   │   │   ├── hero.blade.php
│   │   │   └── book-card.blade.php        # Kartu buku untuk grid
│   │   ├── home.blade.php                 # Landing page
│   │   └── book-detail.blade.php          # Halaman detail buku
│   └── admin/
│       ├── layouts/
│       │   └── app.blade.php              # Layout admin (berbeda dari publik)
│       ├── components/
│       │   ├── sidebar.blade.php
│       │   └── header.blade.php
│       ├── auth/
│       │   └── login.blade.php
│       ├── dashboard.blade.php
│       └── books/
│           ├── index.blade.php            # Daftar buku
│           ├── create.blade.php           # Form tambah
│           ├── edit.blade.php             # Form edit
│           └── show.blade.php             # Detail (opsional)
├── css/
│   └── app.css
└── js/
    └── app.js
routes/
├── web.php                                # Route publik
└── admin.php                              # Route admin (dipisah)
public/
├── images/
│   └── books/                             # Upload cover buku
└── assets/                                # CSS/JS compiled
storage/
└── app/
    └── public/
        └── books/                         # Storage cover buku (symlink)
config/
└── admin.php                              # Konfigurasi admin (opsional)


Penjelasan Setiap Direktori Utama
1. Controllers - Pemisahan Admin dan Public
Controllers/
├── Admin/      # Semua controller untuk panel admin
└── Public/     # Semua controller untuk halaman publik
Alasan: Pemisahan ini membuat kode lebih mudah dinavigasi. Ketika Anda mencari bug di halaman publik, Anda langsung tahu harus ke folder Public/. Tidak ada kebingungan.

HomeController di folder Public bertugas menampilkan landing page sekaligus query buku-buku. Ini lebih sederhana daripada membuat controller terpisah untuk landing page.

2. Middleware - AdminAuth
Middleware khusus untuk memproteksi semua route admin. Lebih eksplisit daripada menggunakan middleware auth bawaan yang biasanya untuk user umum.

3. Requests - Validasi Terpusat
Form Request terpisah untuk validasi input admin. Ini menjaga controller tetap bersih dan validasi bisa di-reuse.

4. Models - Sederhana
Hanya 2 model utama:

Book: Semua informasi buku
Admin atau gunakan User bawaan Laravel dengan role sederhana
TIP

Untuk proyek sekecil ini, Anda bisa langsung pakai tabel users bawaan Laravel untuk admin. Tidak perlu tabel terpisah kecuali ada kebutuhan spesifik.

5. Views - Pemisahan Total Publik dan Admin
views/
├── public/     # Semua view untuk pengunjung
└── admin/      # Semua view untuk admin
Alasan pemisahan:

Desain berbeda (landing page vs dashboard)
Tidak ada risiko salah include component admin di halaman publik
Maintenance lebih mudah
Folder components/ di masing-masing area berisi bagian-bagian yang di-reuse. Contoh: book-card.blade.php adalah kartu buku yang muncul di grid portfolio.

6. Routes - File Terpisah untuk Admin
// routes/web.php - Hanya route publik
Route::get('/', [HomeController::class, 'index']);
Route::get('/book/{slug}', [BookController::class, 'show']);
// routes/admin.php - Semua route admin
Route::prefix('admin')->group(function () {
    Route::get('/login', ...);
    Route::middleware('admin')->group(function () {
        Route::resource('books', ...);
    });
});
File admin.php perlu didaftarkan di RouteServiceProvider. Ini membuat web.php tetap bersih dan fokus.

7. Storage untuk Upload
Cover buku disimpan di storage/app/public/books/ dengan symlink ke public/storage. Ini adalah cara standar Laravel untuk handle upload.

Keputusan Arsitektur
Apakah perlu Service Layer?
Untuk proyek ini: Tidak wajib.

Service layer (BookService.php) berguna jika logic bisnis kompleks (kalkulasi, integrasi API, dll). Untuk CRUD sederhana, logic bisa langsung di controller.

Jika nanti berkembang dan controller mulai gemuk, Anda bisa extract ke Service.

Apakah perlu Repository Pattern?
Tidak. Repository pattern berguna untuk aplikasi besar dengan multiple data source. Untuk proyek ini, Eloquent di controller/service sudah cukup.

Menggunakan User vs Admin terpisah?
Rekomendasi: Gunakan tabel users bawaan.

Tambahkan kolom is_admin atau buat migration sederhana. Tidak perlu tabel terpisah karena:

Hanya ada 1 tipe user (admin)
Tidak ada user publik yang perlu dibedakan
Skema Database Minimal
Tabel books
Kolom	Tipe	Keterangan
id	bigint	Primary key
title	string	Judul buku
slug	string	URL-friendly title
description	text	Deskripsi lengkap
cover_image	string	Path ke gambar cover
author	string	Penulis (opsional)
year	integer	Tahun terbit (opsional)
category	string	Kategori buku (opsional)
is_featured	boolean	Tampil di bagian unggulan
is_published	boolean	Status publikasi
created_at	timestamp	
updated_at	timestamp	
Tabel users (untuk admin)
Gunakan tabel bawaan Laravel, tambahkan kolom is_admin jika perlu membedakan di masa depan.

Verification Plan
Karena ini adalah tahap perencanaan struktur folder (bukan implementasi), verifikasi dilakukan dengan:

Review Manual
Anda review apakah struktur ini sesuai dengan kebutuhan proyek
Konfirmasi apakah ada fitur tambahan yang perlu diakomodasi
Validasi apakah skema database sudah mencukupi
Langkah Selanjutnya (Setelah Approval)
Setup database: Buat migration untuk tabel books
Setup authentication: Konfigurasi login admin sederhana
Buat struktur view: Layout dan component dasar
Implementasi route: Publik dan admin
Implementasi controller: HomeController, BookController
Styling: CSS untuk landing page dan admin panel
IMPORTANT

Ini adalah rekomendasi struktur. Jika ada bagian yang ingin diubah atau ditambah, silakan sampaikan sebelum saya mulai implementasi.