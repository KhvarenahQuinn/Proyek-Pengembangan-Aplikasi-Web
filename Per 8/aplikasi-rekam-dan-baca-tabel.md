## Pekerjaan yang Dilakukan Selama Jam Kuliah ##

    Membuat Rancangan Proyek
        Menentukan ide aplikasi: Aplikasi Rekam dan Baca Tabel.
        Menentukan teknologi yang digunakan:
            Frontend: HTML, CSS, JavaScript.
            Backend: PHP dengan MySQL menggunakan PHPMyAdmin (XAMPP).

    Menyusun Struktur Folder
        Membuat folder proyek di htdocs:

    C:\xampp\htdocs\rekam_baca

    Membuat file berikut:
        index.html → Untuk antarmuka pengguna.
        backend.php → Untuk backend yang berkomunikasi dengan database.

Mendesain Halaman HTML

    Membuat form input untuk nama dan email.
    Membuat tabel untuk menampilkan data yang diambil dari database.
    Menyusun dan menata tampilan menggunakan CSS.

Menulis Logika JavaScript

    Membuat fungsi fetchRecords() untuk mengambil data dari backend menggunakan metode GET.
    Membuat event listener untuk mengirim data ke backend menggunakan metode POST.
    Menyusun data yang diambil agar tampil di tabel HTML.

Membuat Backend PHP

    Menyambungkan aplikasi ke database MySQL.
    Menyediakan API untuk:
        Menyimpan data dari form (POST).
        Membaca data dari database (GET).

Membuat Database

    Membuat database bernama rekam_baca.
    Membuat tabel bernama records dengan struktur berikut:

    CREATE TABLE records (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

Pengujian Aplikasi

    Mengakses aplikasi melalui URL:

    http://localhost/rekam_baca/index.html

    Mengisi form untuk merekam data.
    Memeriksa apakah data tampil di tabel setelah berhasil disimpan.

Mengunggah Proyek ke GitHub

    Membuat repositori di GitHub bernama rekam_baca.
    Mengunggah semua file (index.html, backend.php, dll.) ke dalam repositori.
