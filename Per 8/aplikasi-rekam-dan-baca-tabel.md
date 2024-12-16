# **Pekerjaan yang Dilakukan Selama Jam Kuliah** #

### 1. Membuat Rancangan Proyek ###

1) Menentukan ide aplikasi: Aplikasi Rekam dan Baca Tabel.
2) Menentukan teknologi yang digunakan:
   - Frontend: HTML, CSS, JavaScript.
   - Backend: PHP dengan MySQL menggunakan PHPMyAdmin (XAMPP).

### 2. Menyusun Struktur Folder ###
1) Membuat folder proyek di htdocs:
   E:\SEMESTER 4\PRAKTIKUM PWSS\Aplikasi\xampp\htdocs\Pertemuan 8
2) Membuat file berikut:
   - index.html → Untuk antarmuka pengguna.
   - backend.php → Untuk backend yang berkomunikasi dengan database.

### 3. Mendesain Halaman HTML ###
1) Membuat form input untuk nama dan email.
2) Membuat tabel untuk menampilkan data yang diambil dari database.
3) Menyusun dan menata tampilan menggunakan CSS.

### 4. Menulis Logika JavaScript ###
1) Membuat fungsi fetchRecords() untuk mengambil data dari backend menggunakan metode GET.
2) Membuat event listener untuk mengirim data ke backend menggunakan metode POST.
3) Menyusun data yang diambil agar tampil di tabel HTML.

### 5. Membuat Backend PHP ###
1) Menyambungkan aplikasi ke database MySQL.
2) Menyediakan API untuk:
   - Menyimpan data dari form (POST).
   - Membaca data dari database (GET).

### 6. Membuat Database ###
1) Membuat database bernama rekam_baca, dan
2) Membuat tabel bernama records di phpmyadmin dengan struktur berikut:

    CREATE TABLE records (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

### 7. Pengujian Aplikasi ###
1) Mengakses aplikasi melalui URL:
   *http://localhost/Pertemuan 8/index.html*
2) Mengisi form untuk merekam data.
   Memeriksa apakah data tampil di tabel setelah berhasil disimpan.

### 8. Mengunggah Proyek ke GitHub ###
1) Membuat repositori di GitHub bernama Per 8.
2) Mengunggah semua file (index.html, backend.php, dll.) ke dalam repositori.
