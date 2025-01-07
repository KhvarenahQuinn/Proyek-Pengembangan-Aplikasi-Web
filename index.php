<?php
require_once "inc/db.php";
require_once "inc/functions.php";

// Ambil daftar buku dari database
$sql = "SELECT * FROM buku LIMIT 6"; // Mengambil 6 buku pertama (atau sesuaikan dengan kebutuhan)
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Toko Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-blue-500 text-white">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <a href="index.php" class="text-2xl font-bold">Toko Buku Online</a>
        <nav class="flex space-x-6">
            <a href="index.php" class="hover:underline">Home</a>
            <a href="kategori.php" class="hover:underline">Kategori</a>
            <a href="produk.php" class="hover:underline">Produk</a>
            <a href="keranjang.php" class="hover:underline">Keranjang</a> <!-- Link to the shopping cart -->
            <a href="tentang_kami.php" class="hover:underline">Tentang Kami</a>
        </nav>
    </div>
</header>


    <!-- Hero Section -->
    <section class="bg-blue-100">
        <div class="container mx-auto flex flex-col md:flex-row items-center py-16 px-6">
            <div class="md:w-1/2">
                <h1 class="text-4xl font-bold text-blue-600 mb-4">Temukan Buku Favoritmu!</h1>
                <p class="text-lg text-gray-700 mb-6">
                    Selamat datang di Toko Buku Online, tempat terbaik untuk mencari buku yang Anda butuhkan. 
                    Jelajahi ribuan buku dari berbagai kategori.
                </p>
                <a href="kategori.php" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-700">Jelajahi Kategori</a>
            </div>
            <div class="md:w-1/2">
                <img src="https://via.placeholder.com/600x400" alt="Books" class="rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <!-- Produk Terbaru -->
    <section class="bg-gray-50 py-16 px-6">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold text-center mb-8">Buku Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($buku = $result->fetch_assoc()): ?>
                        <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden">
                            <img src="https://via.placeholder.com/400x300" alt="<?= htmlspecialchars($buku['Judul']); ?>" class="w-full">
                            <div class="p-4">
                                <h3 class="text-lg font-bold mb-2"><?= htmlspecialchars($buku['Judul']); ?></h3>
                                <p class="text-gray-600">Rp <?= number_format($buku['Harga'], 0, ",", "."); ?></p>
                                <a href="detail_buku.php?id=<?= $buku['KodeBuku']; ?>" class="block mt-4 bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-700">Detail</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center w-full">Tidak ada produk yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Toko Buku Online. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
