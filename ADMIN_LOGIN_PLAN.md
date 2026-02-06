# Admin Login Integration Plan

Dokumen ini merinci langkah-langkah untuk mengintegrasikan desain halaman Login Admin (Login V3) yang diberikan user ke dalam project Laravel "Jarreva Creative".

## 1. Analisis Kebutuhan
User memberikan kode HTML lengkap yang menggunakan:
- **Tailwind CSS (via CDN)** dengan konfigurasi custom ekstensif (Warna, Font, Animasi).
- **Google Fonts** (Montserrat).
- **Material Symbols Outlined** (Icons).
- **Custom CSS** (`.mesh-gradient-bg`, `.jarreva-gradient`).

**Tantangan**: Project saat ini menggunakan **Tailwind CSS v4.0**.
**Solusi**: Kita akan memporting konfigurasi CDN (v3 style) ke lingkungan native Vite + Tailwind v4 project agar performa maksimal dan sesuai standar produksi.

## 2. Langkah Implementasi

### Langkah 1: Install Plugin Tambahan
Kode HTML menggunakan plugin `forms` dan `container-queries`. Kita perlu menginstallnya via NPM.
```bash
npm install -D @tailwindcss/forms @tailwindcss/container-queries
```

### Langkah 2: Konfigurasi Tailwind & Font
Dalam Tailwind v4, konfigurasi dilakukan langsung di file CSS (`resources/css/app.css`) menggunakan direktif `@theme`. Kita akan memindahkan konfigurasi warna, font, dan animasi ke sana.

**Target**: `resources/css/app.css`
- Menambahkan import font Montserrat.
- Mendefinisikan `@theme` untuk warna (`--color-primary`, dll), font (`--font-display`), dan animasi.
- Menambahkan class `.mesh-gradient-bg` dan `.jarreva-gradient`.

### Langkah 3: Implementasi View Blade
Update file `resources/views/admin/auth/login.blade.php` dengan struktur HTML baru.

**Perubahan pada HTML:**
- Hapus tag `<script src="cdn...">` dan `<script id="tailwind-config">`.
- Ganti `<style>` manual dengan penggunaan class native dari build.
- Tambahkan direktif `@vite(['resources/css/app.css', 'resources/js/app.js'])`.
- Pertahankan link Google Fonts dan Material Symbols di `<head>`.

### Langkah 4: Build Assets
Jalankan perintah build untuk mengcompile CSS baru.
```bash
npm run build
```

## 3. Detail Konfigurasi (Referensi)

### Tailwind Theme (v4 CSS Style)
```css
@theme {
    /* Colors */
    --color-primary: #F97316;
    --color-secondary: #1E3A8A;
    /* ... other colors ... */

    /* Fonts */
    --font-display: 'Montserrat', sans-serif;
    --font-sans: 'Montserrat', sans-serif;

    /* Animations & Keyframes */
    --animate-shimmer: shimmer 2s infinite;
    /* ... other animations ... */
    
    @keyframes shimmer {
        0% { transform: translateX(-100%) skewX(-15deg); }
        100% { transform: translateX(200%) skewX(-15deg); }
    }
    /* ... other keyframes ... */
}
```

---

## 4. Eksekusi
Setelah plan ini disetujui, saya akan:
1. Menginstall plugin npm.
2. Update `resources/css/app.css` (Porting config).
3. Update `resources/views/admin/auth/login.blade.php`.
4. Menjalankan build.
