### 1. Pendahuluan

- **Latar Belakang**:  
  Pengelolaan stok buku dan transaksi di toko buku konvensional sering menghadapi berbagai masalah, seperti kesalahan pencatatan stok, nota pembelian yang hilang atau rusak, serta kesulitan dalam laporan transaksi. Hal ini mengakibatkan kesulitan dalam mengelola data penjualan dan merencanakan strategi pemasaran yang lebih luas. Dengan adanya aplikasi penjualan buku online, toko buku dapat mengatasi masalah-masalah ini dan memperluas jangkauan pemasaran ke audiens yang lebih luas melalui platform digital.

- **Tujuan**:  
  Tujuan dari pengembangan aplikasi ini adalah untuk mempermudah pengelolaan stok buku, mengoptimalkan laporan transaksi, dan memungkinkan penjualan secara online dengan sistem yang efisien. Aplikasi ini bertujuan untuk:
  1. Mengelola stok buku secara otomatis dengan pembaruan real-time.
  2. Mengelola laporan transaksi dengan lebih mudah dan transparan.
  3. Menyediakan platform untuk penjualan buku secara online, meningkatkan jangkauan pasar.

- **Batasan Masalah**:  
  Proyek ini difokuskan pada pengembangan sistem yang dapat mengelola stok buku dan transaksi penjualan di toko buku, dengan fitur-fitur berikut:
  1. Pengelolaan data buku (judul, pengarang, harga, kategori, dan stok).
  2. Pengelolaan transaksi (penjualan, laporan, dan status transaksi).
  3. Penjualan online yang dapat diakses melalui website.
  
  Fitur-fitur yang tidak akan dikembangkan dalam proyek ini antara lain:
  1. Integrasi dengan sistem pembayaran pihak ketiga.
  2. Fitur pengelolaan gudang fisik atau pengiriman.
  3. Fitur bookmark

 ### 2. Perancangan Sistem

- **Rancangan Awal**
    ![](Pict/DB.png)
- **Realisasi**
    ![](Pict/db_realisasi.png)
### 3. Teknologi


- **Tailwind CSS**:  
  Tailwind CSS digunakan untuk desain frontend aplikasi. Tailwind adalah utility-first CSS framework yang memungkinkan pengembang untuk membuat antarmuka dengan cepat dan fleksibel. Dengan menggunakan Tailwind, kami dapat menyesuaikan desain dengan mudah tanpa menulis banyak CSS tambahan, serta memastikan tampilan aplikasi responsif di berbagai perangkat.

- **MySQL**:  
  MySQL dipilih sebagai sistem manajemen database karena kestabilannya, dukungan yang luas, dan kemampuannya untuk menangani data transaksi dengan volume yang tinggi. MySQL juga berfungsi dengan baik bersama Laravel, karena Laravel memiliki integrasi built-in untuk MySQL yang mempermudah pengelolaan database.

- **PHP (Hypertext Preprocessor)**:  
  PHP dipilih sebagai bahasa pemrograman utama untuk membangun aplikasi ini karena kemampuannya yang sudah terbukti dalam pengembangan aplikasi web dinamis. PHP memiliki ekosistem yang luas, dokumentasi yang baik, dan dukungan yang kuat di berbagai server. Dengan menggunakan PHP, kami dapat mengelola logika aplikasi, pengolahan transaksi, dan penghubungan dengan database MySQL secara efisien.

### 4. Implemetasi
  Hanya sampai di halaman admin

### 5. Kesimpulan dan Saran
-**Kesimpulan**

-**Saran**
  Pada bagian input transaksi pada menu admin, dapat ditambahkan agar bisa upload lebih dari 2 data buku sekaligus. Tambahkan juga verifikasi keamanan untuk halaman admin, dimana user yang bukan admin tidak bisa masuk ke halaman admin.
