<p align="center">
  <strong > Laporan Proyek Pengembangan Aplikasi Web
  <br> Aplikasi Penjualan Buku Berbasis Web Pada Toko Taman Baca Rindang 
  </strong>
</p>

<p align="center">
  <img src="https://github.com/KhvarenahQuinn/Proyek-Pengembangan-Aplikasi-Web/blob/main/Laporan%20Akhir/logo%20utdi.png" alt="Logo UTDI">
</p>

<p align="center">
  Penyusun: 
  <br> - Rean Layung Sukmo (225410091)
  <br> - Ulul Azmi A. Latala (225410086)
</p>

<p align="center">
  <strong > Program Studi Informatika Kelas 1 
  <br> Fakultas Teknologi Informasi
  <br> Universitas Teknologi Digital Indonesia (UTDI)
  <br> 2024
  </strong>
</p>

### A. Pendahuluan

**1. Latar Belakang :**
  Pengelolaan stok buku dan transaksi di toko buku konvensional sering mengalami berbagai permasalahan yang mempengaruhi efisiensi operasional dan kualitas   layanan. Beberapa masalah umum yang dihadapi toko buku konvensional adalah kesalahan pencatatan stok buku, nota pembelian yang hilang atau rusak, serta kesulitan dalam menghasilkan laporan transaksi yang akurat dan tepat waktu. Hal ini tentu saja dapat menghambat pengambilan keputusan yang berbasis data dan merugikan keuntungan toko buku.
  Dengan adanya aplikasi penjualan buku online, toko buku dapat mengatasi permasalahan-permasalahan tersebut dengan memanfaatkan sistem digital yang otomatis dan efisien. Selain itu, toko buku dapat memperluas jangkauan pasarnya kepada audiens yang lebih luas yang mungkin tidak terjangkau oleh toko buku fisik. Aplikasi penjualan buku ini akan memungkinkan proses pengelolaan stok yang lebih akurat, laporan transaksi yang transparan, dan memudahkan proses transaksi secara online.

**2. Tujuan :**  
  Tujuan dari pengembangan aplikasi penjualan buku ini adalah untuk:
  - Mengelola stok buku secara otomatis dengan pembaruan real-time sehingga pengelolaan stok lebih efisien dan menghindari kesalahan pencatatan.
  - Mengelola laporan transaksi secara lebih mudah dan transparan dengan menyediakan laporan yang dapat diakses kapan saja, baik untuk penjualan, pembelian, atau transaksi lainnya.
  - Menyediakan platform untuk penjualan buku online, yang memungkinkan toko buku untuk menjangkau pasar yang lebih luas dengan memanfaatkan kemudahan e-commerce.
     
**3. Batasan Masalah :**  
  Proyek ini difokuskan pada pengembangan sistem yang mengelola stok buku dan transaksi penjualan di toko buku. Beberapa fitur utama yang akan dikembangkan adalah:
  - Pengelolaan data buku: Menyimpan informasi terkait buku seperti judul, pengarang, harga, kategori, dan stok.
  - Pengelolaan transaksi: Melacak penjualan buku, mencatat laporan transaksi, dan memantau status transaksi (berhasil atau gagal).
  - Penjualan online: Platform website yang memungkinkan pelanggan untuk membeli buku secara online.
  
  Namun, ada beberapa fitur yang tidak akan dikembangkan dalam proyek ini, antara lain:
  - Integrasi dengan sistem pembayaran pihak ketiga (misalnya, PayPal, Stripe, atau e-wallet).
  - Fitur pengelolaan gudang fisik atau pengiriman (logistik pengiriman buku).
  - Fitur bookmark yang memungkinkan pengguna untuk menandai buku yang mereka minati.

 ### B. Perancangan Sistem

**1. Rancangan Awal**
  Pada tahap awal, sistem aplikasi ini dirancang dengan fokus pada pengelolaan stok buku, manajemen transaksi penjualan, dan penjualan online. Sistem akan dibangun dengan pendekatan modular, sehingga setiap fitur dapat dikembangkan dan diuji secara terpisah. Desain antarmuka pengguna akan dibuat dengan tujuan agar sederhana dan mudah digunakan, terutama bagi pengguna yang tidak terbiasa dengan teknologi.
  Fitur utama aplikasi mencakup:
  - Halaman admin untuk mengelola stok dan transaksi.
  - Fitur pencarian buku di website.
  - Halaman produk yang menampilkan buku yang tersedia untuk dibeli.
  - Laporan transaksi yang dapat diakses oleh admin.
    ![](Pict/DB.png)
    
**2. Realisasi**
  Setelah tahap perancangan, sistem akan direalisasikan melalui tahap pengembangan perangkat lunak dengan melibatkan berbagai teknologi dan bahasa pemrograman untuk membangun aplikasi ini secara efektif. Sistem akan melalui pengujian untuk memastikan fungsionalitas dan performa yang optimal.
    ![](Pict/db_realisasi.png)
    
### C. Teknologi

**1. Tailwind CSS :**
Tailwind CSS digunakan untuk desain antarmuka aplikasi di frontend. Sebagai utility-first CSS framework, Tailwind memungkinkan pengembang untuk merancang tampilan aplikasi dengan cepat dan fleksibel tanpa harus menulis banyak CSS tambahan. Dengan menggunakan Tailwind, desain bisa lebih modular, responsif, dan mudah disesuaikan. Penggunaan Tailwind juga memastikan aplikasi tampil dengan baik di berbagai perangkat, dari desktop hingga mobile.
  
**2. MySQL :**
MySQL dipilih sebagai sistem manajemen database untuk menyimpan data buku, transaksi, dan pengguna. Keunggulan MySQL adalah stabilitas, kecepatan, dan kemampuannya untuk menangani volume data yang tinggi. Dengan integrasi yang baik antara MySQL dan Laravel (framework backend), pengelolaan database menjadi lebih mudah dan efisien.

**3. PHP (Hypertext Preprocessor) :**
  PHP dipilih sebagai bahasa pemrograman utama untuk backend aplikasi karena kemampuannya dalam membangun aplikasi web dinamis. PHP memiliki ekosistem yang luas dan didukung oleh berbagai server web. Dengan menggunakan PHP, aplikasi ini dapat menangani logika aplikasi seperti pengolahan data transaksi, pengelolaan stok buku, dan penghubungan dengan database MySQL.
  
### D. Implemetasi
  Pada tahap implementasi, aplikasi ini difokuskan pada pengembangan halaman admin, yang memungkinkan admin untuk melakukan pengelolaan stok buku, transaksi, dan laporan. Fitur-fitur yang sudah diimplementasikan meliputi:
  - Pengelolaan Buku: Menambahkan, mengedit, atau menghapus data buku.
  - Pengelolaan Transaksi: Mencatat dan memantau transaksi penjualan yang dilakukan oleh pelanggan.
  - Laporan Penjualan: Admin dapat melihat laporan transaksi berdasarkan periode tertentu.
  Namun, sistem ini masih terbatas pada halaman admin dan belum mencakup penjualan online untuk pelanggan, meskipun struktur dan fungsionalitas halaman admin telah berjalan dengan baik.

### E. Kesimpulan dan Saran

**1. Kesimpulan :**
  Aplikasi penjualan buku online yang dikembangkan ini bertujuan untuk mempermudah pengelolaan stok buku dan transaksi penjualan di toko buku. Dengan menggunakan teknologi yang tepat, seperti Tailwind CSS untuk desain frontend, MySQL untuk database, dan PHP untuk logika aplikasi, sistem ini dapat membantu toko buku untuk meningkatkan efisiensi dan memperluas jangkauan pasar. Meskipun aplikasi saat ini terbatas pada pengelolaan admin, pengembangan lebih lanjut akan memungkinkan toko buku untuk beroperasi secara online dan meningkatkan pelayanan pelanggan.

**2. Saran :**
  Beberapa saran untuk pengembangan aplikasi ini di masa depan antara lain:
  - Fitur Upload Multi-Data Buku: Pada bagian input transaksi pada menu admin, perlu ada opsi untuk meng-upload lebih dari dua data buku sekaligus. Fitur ini akan mempercepat proses penambahan buku ke dalam database, terutama ketika toko buku memiliki banyak buku untuk dimasukkan.
  - Verifikasi Keamanan untuk Halaman Admin: Agar keamanan sistem lebih terjamin, perlu adanya verifikasi login dengan peran pengguna yang membatasi akses hanya untuk admin. Pengguna yang bukan admin tidak boleh bisa mengakses halaman admin untuk menghindari potensi penyalahgunaan sistem.
  - Pengembangan Penjualan Online: Selanjutnya, perlu dikembangkan fitur penjualan buku online di platform web, sehingga pelanggan dapat membeli buku secara langsung, memilih metode pembayaran, dan memproses pengiriman buku.
  Dengan pengembangan lebih lanjut, aplikasi ini dapat memberikan solusi yang lebih lengkap dan efisien untuk pengelolaan toko buku konvensional menuju digital.

