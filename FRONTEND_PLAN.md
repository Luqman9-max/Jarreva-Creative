Jarreva Creative - Rencana Frontend
Gambaran Besar Arsitektur Frontend
Website ini memiliki dua area frontend yang sepenuhnya terpisah:

Frontend Publik --> Tujuan: Menampilkan portfolio buku kepada pengunjung --> akses: Terbuka untuk semua orang
Frontend Admin	Tujuan: Mengelola konten buku (CRUD) --> akses: Hanya admin via URL khusus

Kedua area ini tidak berbagi komponen UI. Desain, layout, dan navigasi dibuat independen agar:

- Tidak ada risiko kebocoran UI admin ke publik
- Maintenance lebih mudah karena perubahan di satu area tidak mempengaruhi area lain
- Pengalaman pengguna (UX) dapat dioptimalkan sesuai konteks masing-masing

BAGIAN A: FRONTEND PUBLIK
1. Daftar Halaman Publik
Hanya 2 halaman yang diperlukan:

Halaman	URL	Fungsi
Landing Page	/	Halaman utama + showcase semua buku
Detail Buku	/book/{slug}	Informasi lengkap satu buku
Tidak ada halaman portfolio terpisah karena portfolio langsung ditampilkan di landing page.

2. Struktur Konten Landing Page
Landing page disusun dalam urutan vertikal (scroll-based) dengan section berikut:

Section 1: Hero
Isi: Tagline utama + deskripsi singkat tentang Jarreva Creative
Tujuan: Memberi kesan pertama yang kuat dan profesional
Elemen pendukung: Background visual (bisa solid color/gradient atau gambar abstrak)
Section 2: Tentang (Opsional)
Isi: 2-3 kalimat tentang siapa/apa Jarreva Creative
Tujuan: Membangun kredibilitas sebelum menampilkan karya
Catatan: Bisa digabung ke Hero jika ingin lebih ringkas
Section 3: Portfolio Buku
Isi: Grid/galeri kartu buku
Setiap kartu menampilkan: Cover buku, judul, (opsional: kategori/tahun)
Interaksi: Klik kartu → membuka halaman detail buku
Tujuan: Ini adalah inti dari website - showcase karya
Section 4: Footer
Isi: Info kontak, credit, copyright
Tujuan: Penutup halaman dengan informasi pendukung

3. Komponen UI Utama Landing Page
Komponen	Lokasi	Deskripsi
Navbar	Atas halaman (sticky opsional)	Logo + navigasi sederhana (jika ada anchor ke section)
Hero Section	Paling atas	Area visual utama dengan tagline
Book Card	Section Portfolio	Kartu individual untuk setiap buku
Book Grid	Section Portfolio	Container yang menyusun book cards
Footer	Paling bawah	Info kontak dan copyright
Tentang Book Card
Setiap kartu buku sebaiknya menampilkan:

Cover image (dominan, jadi fokus visual)
Judul buku
Opsional: Kategori atau tahun terbit
Hover effect sederhana untuk menunjukkan interaktivitas

4. Struktur Halaman Detail Buku
Halaman ini menampilkan informasi lengkap satu buku.

Layout yang Direkomendasikan
Gunakan layout dua kolom pada layar lebar:

Kolom kiri: Gambar cover buku (besar, jelas)
Kolom kanan: Informasi teks
Informasi yang Ditampilkan
Judul buku
Deskripsi lengkap
Penulis (jika relevan)
Tahun terbit
Kategori
Tombol "Kembali ke Portfolio" atau navigasi breadcrumb
Responsivitas
Pada layar kecil, layout berubah menjadi satu kolom (cover di atas, teks di bawah).

5. Pola Navigasi Pengunjung Publik
Masuk Website (/)
       ↓
   Landing Page
       ↓
   Scroll ke Portfolio
       ↓
   Klik Book Card
       ↓
   Halaman Detail Buku
       ↓
   Tombol "Kembali" atau logo navbar
       ↓
   Kembali ke Landing Page
Prinsip navigasi:

Navigasi harus sangat sederhana karena hanya ada 2 halaman
Tidak perlu menu dropdown atau navigasi kompleks
Logo di navbar selalu mengarah ke landing page
Halaman detail memiliki cara jelas untuk kembali


6. Prinsip UX Frontend Publik
Fokus pada Visual

Buku adalah produk visual. Cover harus menjadi hero di setiap Book Card.
Gunakan whitespace yang cukup agar tidak terasa sesak.
Kesederhanaan

Tidak ada elemen yang tidak perlu (sidebar, widget, popup).
Satu tujuan per halaman: Landing = showcase, Detail = informasi lengkap.
Responsif

Harus nyaman diakses dari mobile karena banyak pengunjung browsing dari HP.
Kecepatan

Optimasi gambar cover (compressed, lazy loading).
Minimal JavaScript untuk menjaga performa.
Profesionalisme

Tipografi bersih dan konsisten.
Warna yang harmonis, tidak mencolok berlebihan.


BAGIAN B: FRONTEND ADMIN

7. Daftar Halaman Admin
Halaman	URL	Fungsi
Login	/admin/login	Autentikasi admin
Dashboard	/admin/dashboard	Ringkasan dan navigasi utama
Daftar Buku	/admin/books	Melihat semua buku
Tambah Buku	/admin/books/create	Form input buku baru
Edit Buku	/admin/books/{id}/edit	Form edit buku existing
(Opsional) Detail Buku	/admin/books/{id}	Preview buku sebelum edit

8. Struktur UI Halaman Login Admin
Karakteristik
Halaman mandiri, tidak menggunakan layout admin
Desain minimalis, fokus pada form login
Tidak ada link ke halaman publik
Elemen UI
Logo atau nama "Jarreva Creative Admin"
Form login:
Input email
Input password
Tombol "Masuk"
Pesan error (jika login gagal)
UX Notes
Tidak perlu link "Lupa Password" untuk website skala kecil
Tidak ada link register karena admin dibuat manual

9. Struktur UI Dashboard Admin
Tujuan Dashboard
Memberikan ringkasan cepat dan akses langsung ke fitur utama.

Elemen yang Direkomendasikan
Elemen	Fungsi
Header	Nama admin yang login + tombol logout
Statistik ringkas	Jumlah buku total, buku featured, buku terbaru
Quick Actions	Tombol "Tambah Buku Baru"
Daftar Buku Terbaru	5 buku terakhir ditambahkan (dengan link ke edit)
Layout
Sidebar (kiri) untuk navigasi
Area konten utama (kanan) untuk informasi

10. Alur Navigasi Admin (CRUD Buku)
Melihat Daftar Buku
Dashboard → Klik "Buku" di sidebar → Halaman Daftar Buku
Menambah Buku Baru
Dashboard → Tombol "Tambah Buku" 
    ATAU
Daftar Buku → Tombol "Tambah Buku Baru"
    ↓
Form Tambah Buku → Isi data → Simpan
    ↓
Redirect ke Daftar Buku (dengan notifikasi sukses)
Mengedit Buku
Daftar Buku → Klik tombol "Edit" pada baris buku
    ↓
Form Edit Buku → Ubah data → Simpan
    ↓
Redirect ke Daftar Buku (dengan notifikasi sukses)
Menghapus Buku
Daftar Buku → Klik tombol "Hapus" pada baris buku
    ↓
Konfirmasi dialog (untuk mencegah kesalahan)
    ↓
Buku dihapus → Tetap di Daftar Buku (dengan notifikasi sukses)

11. Komponen UI Utama Admin
Sidebar Navigasi
Menu Item	Target
Dashboard	/admin/dashboard
Buku	/admin/books
Logout	Aksi logout
Tabel Daftar Buku
Kolom yang ditampilkan:

Cover (thumbnail kecil)
Judul
Kategori
Status (Featured / Draft / Published)
Tanggal dibuat
Aksi (Edit, Hapus)
Form Buku (Create/Edit)
Field yang diperlukan:

Judul (text input, required)
Slug (auto-generate dari judul, atau manual)
Deskripsi (textarea/rich text)
Cover Image (file upload dengan preview)
Penulis (text input, opsional)
Tahun (number input, opsional)
Kategori (dropdown atau text input)
Is Featured (checkbox)
Is Published (checkbox)
Notifikasi
Toast notification untuk feedback aksi (sukses/error)
Posisi: pojok kanan atas
Auto-dismiss setelah beberapa detik

12. Prinsip UX Frontend Admin
Efisiensi

Admin harus bisa menyelesaikan tugas dengan klik minimal.
Quick actions di dashboard untuk tugas yang sering dilakukan.
Kejelasan Status

Selalu tampilkan feedback setelah aksi (berhasil/gagal).
Indikator visual untuk status buku (published, draft, featured).
Pencegahan Error

Konfirmasi sebelum hapus.
Validasi form yang jelas dengan pesan error yang spesifik.
Konsistensi

Layout, warna, dan pola interaksi sama di semua halaman admin.
Tombol aksi di posisi yang konsisten (misal: tombol simpan selalu di bawah form).
Tidak Berlebihan

Hindari dashboard yang terlalu ramai dengan statistik tidak relevan.
Fokus pada fitur yang benar-benar digunakan.
Rekomendasi Pendekatan UI Admin
Ada dua pendekatan umum untuk admin panel:

Pendekatan	Deskripsi	Trade-off
A. Sidebar + Content	Navigasi di sidebar kiri, konten di kanan	Lebih terstruktur, cocok untuk admin dengan banyak menu
B. Top Nav + Content	Navigasi di atas, konten di bawah	Lebih sederhana, cocok untuk admin dengan sedikit menu
Rekomendasi: Pendekatan A (Sidebar + Content)
Alasan:

Meskipun saat ini hanya ada menu "Buku", pendekatan sidebar siap untuk berkembang jika nanti ada fitur tambahan (misal: Pengaturan, Laporan)
Sidebar memberikan navigasi yang selalu terlihat, tidak perlu klik untuk membuka menu
Lebih umum digunakan di admin panel profesional, sehingga familiar bagi user
Ringkasan Visual Arsitektur
┌─────────────────────────────────────────────────────────────┐
│                    JARREVA CREATIVE                         │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│   FRONTEND PUBLIK                FRONTEND ADMIN             │
│   ───────────────                ──────────────             │
│                                                             │
│   [/]                            [/admin/login]             │
│   Landing Page                   Login Page                 │
│   ├── Hero                            ↓                     │
│   ├── Portfolio Grid             [/admin/dashboard]         │
│   └── Footer                     Dashboard                  │
│         ↓                        ├── Statistik              │
│   [/book/{slug}]                 └── Quick Actions          │
│   Detail Buku                          ↓                    │
│   ├── Cover                      [/admin/books]             │
│   ├── Info                       CRUD Buku                  │
│   └── Back Button                ├── List                   │
│                                  ├── Create                 │
│                                  ├── Edit                   │
│                                  └── Delete                 │
│                                                             │
└─────────────────────────────────────────────────────────────┘
IMPORTANT

Dokumen ini adalah rencana frontend. Implementasi kode akan dilakukan setelah rencana ini disetujui.