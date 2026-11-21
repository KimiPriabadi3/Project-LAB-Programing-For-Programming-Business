# L&W – Toko Parfum Premium

L&W adalah platform ritel premium tempat pelanggan bisa menjelajahi, mencari, dan membeli koleksi parfum eksklusif dari berbagai merek ternama. Website ini dibangun dengan **PHP Murni (Pure PHP)** dan memakai **HTTP request (GET dan POST)** untuk semua operasi **Create, Read, Update, dan Delete (CRUD)**. Website dikelola oleh admin yang dapat mengatur produk, brand, dan transaksi.

> **Mata Kuliah:** Programming for Business (COSC6050003 | COSC6067052)
> **Kode Soal:** O272-COSC6050-LW03-00
> **Semester:** Ganjil 2026/2027

## Anggota Kelompok

| Nama | NIM |
|------|-----|
| Muhammad Altaf Baihaqi Priabadi | 2902721623 |
| Bryant Riefsha Athallah | 2902723471 |
| Irsyad Alfayyadh Wibowo | 2902693052 |
| Excel Rizky Nazaraya | 2902691173 |

**Kelas:** `LB80`

## Teknologi yang Digunakan

- **Bahasa:** PHP (murni, tanpa framework)
- **Database:** MySQL / MariaDB
- **Server:** XAMPP 8.2.12 (Apache + MySQL)
- **Editor:** Visual Studio Code
- **Frontend:** HTML, CSS, JavaScript

## Role Pengguna dan Fitur

### Guest (belum login)
- Home (banner full-width dengan scroll vertikal)
- Login
- Register
- Katalog Produk (pencarian, filter brand, pengurutan)
- Detail Produk (tidak bisa menambah ke keranjang, otomatis diarahkan ke halaman Login)

### Member
- Home
- Katalog Produk
- Detail Produk (input jumlah dan tombol Add to Cart)
- Cart (pilih item, ubah jumlah, hapus item, total item terpilih)
- Checkout (alamat pengiriman, ringkasan pesanan, stok otomatis berkurang)
- Riwayat Transaksi

### Admin
- Dashboard (jumlah total produk, brand, dan transaksi)
- Manage Products (daftar produk, hapus)
- Add / Edit Product
- Manage Brands (tambah dan edit lewat popup, hapus)
- View Transactions

Setiap halaman menampilkan nama Member atau Admin yang sedang login.

## Aturan Validasi

| Halaman | Field | Aturan |
|---------|-------|--------|
| Login | Email | Wajib diisi, harus cocok dengan database |
| Login | Password | Wajib diisi, harus cocok dengan database |
| Login | Remember me | Menyimpan User ID di cookie setelah login berhasil |
| Register | Username | Wajib diisi, 5–20 karakter, unik |
| Register | Email | Wajib diisi, harus berakhiran `@gmail.com`, unik |
| Register | Password | Wajib diisi, minimal 8 karakter |
| Register | Confirm Password | Harus sama dengan Password |
| Detail Produk | Quantity | Wajib diisi, minimal 1, tidak boleh melebihi stok |
| Checkout | Alamat Pengiriman | Wajib diisi, minimal 15 karakter |
| Form Brand | Nama Brand | Wajib diisi, maksimal 30 karakter |
| Form Brand | Asal Brand | Wajib diisi, maksimal 100 karakter |
| Form Produk | Brand | Harus dipilih dari daftar brand yang ada |
| Form Produk | Nama | Wajib diisi, minimal 3 karakter |
| Form Produk | Harga | Wajib diisi, numerik > 0 |
| Form Produk | Stok | Wajib diisi, numerik >= 0 |
| Form Produk | Gambar | Harus berformat `.jpg` atau `.png` |

Aturan bisnis lainnya:
- Brand hanya bisa dihapus jika tidak dipakai oleh produk mana pun.
- Produk hanya bisa dihapus jika tidak dipakai di transaksi atau cart.
- Setelah checkout berhasil, stok produk otomatis berkurang.
- Semua error validasi ditampilkan dengan jelas melalui `<pesan inline / toast / modal>`.

## Desain Database

Database bernama `<nama_database>` dan terdiri dari 6 tabel:

- `users` (userID, userName, userEmail, userPassword, userRole)
- `brands` (brandID, brandName, brandOrigin)
- `products` (productID, brandID, productName, productDescription, productPrice, productStock, productImage)
- `carts` (userID, productID, quantity)
- `transactions` (transactionID, userID, transactionDate, totalAmount, shippingAddress)
- `transactiondetails` (transactionID, productID, quantity, subtotalPrice)

Script SQL lengkap (CREATE TABLE dan INSERT data contoh) ada di `database/<nama_file>.sql`.

## Cara Instalasi dan Menjalankan

1. Install dan buka **XAMPP 8.2.12**, lalu jalankan **Apache** dan **MySQL**.
2. Salin folder project ke `C:\xampp\htdocs\<nama_folder_project>`.
3. Buka **phpMyAdmin** di `http://localhost/phpmyadmin`.
4. Buat database baru bernama `<nama_database>`, lalu **import** file `database/<nama_file>.sql`.
5. Cek koneksi database di `<file_koneksi>.php` (default XAMPP: host `localhost`, user `root`, password kosong).
6. Buka website di `http://localhost/<nama_folder_project>/`.

## Akun untuk Demo

| Role | Email | Password |
|------|-------|----------|
| Admin | `<email_admin>` | `<password_admin>` |
| Member | `<email_member>` | `<password_member>` |

## Struktur Folder

```
<nama_folder_project>/
├── database/
│   └── <nama_file>.sql
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── admin/
│   ├── dashboard.php
│   ├── manage_products.php
│   ├── product_form.php
│   ├── manage_brands.php
│   └── transactions.php
├── member/
│   ├── cart.php
│   ├── checkout.php
│   └── history.php
├── index.php
├── login.php
├── register.php
├── catalog.php
├── product_detail.php
└── README.md
```
> Sesuaikan struktur ini dengan file project kalian yang sebenarnya.

## Kreativitas Tambahan

- `<Contoh: notifikasi toast untuk pesan sukses dan error>`
- `<Contoh: tampilan responsif untuk mobile>`
- `<Contoh: password di-hash dengan password_hash()>`
- `<Kreativitas lain yang kalian tambahkan>`

## Dokumentasi dan Referensi

- Dokumentasi project (`.doc`) berisi link referensi gambar dan aset lain: `<nama_file>.doc`
- Referensi: https://cnfstore.com/ dan https://cnfstore.com/fragrance/ (sesuai yang tertulis di soal)
- Sumber gambar: `<daftar link gambar>`
