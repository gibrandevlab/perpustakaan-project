# Perpustakaan Digital

Aplikasi manajemen perpustakaan berbasis web menggunakan Laravel.

## Library yang digunakan
- Laravel UI
- Bootstrap 4
- FontAwesome
- realrashid/sweet-alert
- Template Ruang Admin
- Select2 untuk multiple select
- DataTables
- DomPDF

## Fitur
- Ada 2 jenis Anggota: Admin dan Anggota
- Setiap user harus login untuk mengakses web
- User harus terdaftar sebagai anggota untuk meminjam buku
- Satu user hanya dapat memiliki satu profile
- Setiap user dapat mengubah profilenya masing-masing
- Setiap buku dapat memiliki multiple kategori
- Judul buku dapat berjumlah lebih dari 1 (dibedakan melalui kode buku)
- Pencarian buku melalui judul buku
- Admin bisa menambah, mengupdate, dan menghapus data buku, kategori, dan user
- Setiap anggota hanya dapat meminjam maksimal 3 buku
- Peminjaman maksimal 7 hari, lebih dari itu akan dikenakan denda
- Hanya admin yang dapat melakukan pengembalian buku
- Admin dapat melihat dan mencetak riwayat peminjaman buku, anggota hanya dapat melihat list buku yang dipinjam olehnya

## ERD Sistem Informasi Perpustakaan
![ERD](/public/img/erd.png)

## Instalasi
1. Clone repository ini
2. Jalankan `composer install`
3. Copy `.env.example` menjadi `.env` dan atur konfigurasi database
4. Jalankan `php artisan key:generate`
5. Jalankan migrasi dan seeder: `php artisan migrate --seed`
6. Jalankan server: `php artisan serve`

## Lisensi
Proyek ini dilisensikan di bawah MIT License.

---

**Pembuat:** Afwan Gibran Muhammad Algiffari

