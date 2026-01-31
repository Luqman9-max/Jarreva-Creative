# Struktur Folder Laravel - Jarreva Creative

Website portfolio buku dan blog dengan admin panel. Tidak ada fitur e-commerce atau autentikasi publik.

---

## Struktur yang Direkomendasikan

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/                    # Controller khusus admin
│   │   │   ├── BookController.php
│   │   │   ├── PostController.php
│   │   │   └── DashboardController.php
│   │   └── Public/                   # Controller untuk halaman publik
│   │       ├── HomeController.php
│   │       ├── PortfolioController.php
│   │       └── BlogController.php
│   ├── Requests/
│   │   ├── Admin/
│   │   │   ├── StoreBookRequest.php
│   │   │   ├── UpdateBookRequest.php
│   │   │   ├── StorePostRequest.php
│   │   │   └── UpdatePostRequest.php
│   └── Middleware/
│       └── AdminMiddleware.php       # Proteksi route admin
├── Models/
│   ├── Book.php
│   ├── Post.php
│   ├── Category.php                  # Opsional, jika butuh kategori
│   └── Admin.php                     # Model untuk admin user
├── Services/                         # Opsional, untuk logic kompleks
│   ├── ImageService.php              # Handle upload gambar
│   └── SlugService.php               # Generate slug otomatis
└── Providers/

config/                               # Default Laravel, tidak perlu diubah

database/
├── migrations/
│   ├── create_books_table.php
│   ├── create_posts_table.php
│   ├── create_categories_table.php   # Opsional
│   └── create_admins_table.php
├── seeders/
│   ├── AdminSeeder.php
│   └── DatabaseSeeder.php
└── factories/                        # Untuk testing/demo data

public/
├── css/
├── js/
├── images/
│   ├── books/                        # Upload gambar buku
│   └── posts/                        # Upload gambar blog
└── index.php

resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php             # Layout utama publik
│   │   └── admin.blade.php           # Layout admin panel
│   ├── components/
│   │   ├── navbar.blade.php
│   │   ├── footer.blade.php
│   │   ├── book-card.blade.php       # Komponen reusable
│   │   ├── post-card.blade.php
│   │   └── admin/
│   │       ├── sidebar.blade.php
│   │       └── header.blade.php
│   ├── public/                       # Halaman publik
│   │   ├── home.blade.php
│   │   ├── portfolio/
│   │   │   ├── index.blade.php       # Daftar buku
│   │   │   └── show.blade.php        # Detail buku
│   │   └── blog/
│   │       ├── index.blade.php       # Daftar artikel
│   │       └── show.blade.php        # Detail artikel
│   ├── admin/                        # Halaman admin
│   │   ├── dashboard.blade.php
│   │   ├── books/
│   │   │   ├── index.blade.php       # Tabel daftar buku
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── posts/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   └── auth/
│   │       └── login.blade.php
│   └── partials/                     # Snippet kecil reusable
│       ├── meta.blade.php            # SEO meta tags
│       └── flash-message.blade.php
├── css/
│   └── app.css                       # Custom CSS
└── js/
    └── app.js                        # Custom JS

routes/
├── web.php                           # Route publik + admin
└── console.php

storage/
└── app/public/
    ├── books/                        # Simpan file upload buku
    └── posts/                        # Simpan file upload blog

tests/
├── Feature/
│   ├── Admin/
│   │   ├── BookTest.php
│   │   └── PostTest.php
│   └── Public/
│       ├── PortfolioTest.php
│       └── BlogTest.php
└── Unit/
```

---

## Penjelasan Setiap Direktori

### Controllers

Dipisah menjadi dua namespace:

- **Admin/** → Semua controller untuk CRUD di admin panel. Masing-masing entity (Book, Post) punya controller sendiri dengan method standard: `index`, `create`, `store`, `edit`, `update`, `destroy`.

- **Public/** → Controller untuk halaman yang dilihat pengunjung. Hanya perlu method `index` (daftar) dan `show` (detail). Tidak ada mutasi data di sini.

Pemisahan ini membuat routing lebih bersih dan middleware lebih mudah diterapkan.

---

### Requests

Form Request diletakkan di `Requests/Admin/` karena hanya admin yang melakukan input data. Ini memisahkan validasi dari controller dan membuatnya testable.

Untuk website ini, cukup buat request untuk operasi `Store` dan `Update`. Tidak perlu request untuk read/delete.

---

### Models

Flat di folder `Models/`. Untuk website skala ini, tidak perlu sub-folder. Model yang dibutuhkan:

- **Book** → Portfolio buku (judul, deskripsi, cover, tahun terbit, link beli jika ada)
- **Post** → Artikel blog (judul, konten, thumbnail, tanggal publish)
- **Category** → Opsional, jika ingin mengkategorikan buku atau blog
- **Admin** → Model untuk admin user, terpisah dari model User default Laravel jika perlu.

---

### Services (Opsional)

Folder ini untuk logic yang dipakai di banyak tempat:

- **ImageService** → Handle upload, resize, dan hapus gambar
- **SlugService** → Generate slug dari judul

Jika logic masih sederhana, bisa langsung di controller. Services ditambahkan saat ada pengulangan kode.

---

### Views

Struktur views mengikuti pola yang jelas:

| Folder | Fungsi |
|--------|--------|
| `layouts/` | Template utama (HTML head, body wrapper) |
| `components/` | Komponen reusable (card, button, form field) |
| `public/` | Semua halaman yang dilihat pengunjung |
| `admin/` | Semua halaman panel admin |
| `partials/` | Snippet kecil yang di-include (meta, flash) |

Setiap module (books, posts) punya sub-folder sendiri dengan file konsisten: `index`, `create`, `edit`, `show`.

---

### Assets (CSS/JS)

Untuk website ini, pendekatan sederhana:

1. **Development**: File CSS/JS di `resources/css` dan `resources/js`, dikompilasi dengan Vite
2. **Output**: Hasil build masuk ke `public/build/`
3. **Gambar statis**: Logo, ikon → langsung di `public/images/`
4. **Upload user**: Gambar buku/blog → di `storage/app/public/` dengan symlink

---

### Routes

Semua route di `web.php`, dikelompokkan dengan prefix dan middleware:

```php
// Public routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/portfolio/{book:slug}', [PortfolioController::class, 'show']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{post:slug}', [BlogController::class, 'show']);

// Admin routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('books', BookController::class);
    Route::resource('posts', PostController::class);
});
```
Keputusan Arsitektur
Mengapa tidak pakai Repository Pattern?
Website ini cukup sederhana. Repository pattern menambah layer abstraksi yang tidak diperlukan. Eloquent langsung di controller atau service sudah cukup.

Mengapa Admin terpisah dari User?
Karena tidak ada user publik, model Admin lebih eksplisit. Jika nanti butuh user publik (misalnya untuk komentar), bisa tambah model User tanpa mengubah logic admin.

Mengapa pakai components Blade biasa, bukan Livewire?
Untuk website konten statis seperti ini, Blade components sudah cukup. Livewire cocok untuk interaksi dinamis yang kompleks, yang tidak dibutuhkan di sini.

Langkah Selanjutnya
Setelah struktur disetujui:
1. Buat folder-folder yang belum ada
2. Buat migrations untuk tabel books, posts, admins
3. Buat model dengan relasi yang diperlukan
4. Setup route dan controller skeleton
5. Mulai implementasi CRUD admin
6. Buat tampilan publik

NOTE:
Struktur ini bisa langsung diimplementasikan. Jika ada penyesuaian yang diinginkan (misalnya menambah fitur kategori, tag, atau halaman statis lain), beri tahu sebelum mulai coding.