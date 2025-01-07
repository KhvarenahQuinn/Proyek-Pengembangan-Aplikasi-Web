<?php
session_start(); 
require_once "inc/db.php";
require_once "inc/functions.php";

// Ambil kode buku dari URL
$kode_buku = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Validasi apakah ID buku valid
if ($kode_buku === 0) {
    echo "ID Buku tidak valid.";
    exit;
}

// Dapatkan detail buku
$buku = getBookDetails($conn, $kode_buku);

// Validasi apakah buku ditemukan
if (!$buku) {
    echo "Buku tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - <?= htmlspecialchars($buku['Judul']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-blue-500 text-white">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="index.php" class="text-2xl font-bold">Toko Buku Online</a>
            <nav class="flex space-x-6">
                <a href="index.php" class="hover:underline">Home</a>
                <a href="keranjang.php" class="hover:underline">Keranjang</a>
                <a href="kategori.php" class="hover:underline">Kategori</a>
                <a href="produk.php" class="hover:underline">Produk</a>
                <a href="tentang_kami.php" class="hover:underline">Tentang Kami</a>
            </nav>
        </div>
    </header>

    <!-- Detail Buku -->
    <div class="container mx-auto py-10 px-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($buku['Judul']); ?></h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex justify-center items-center">
                    <img src="https://placehold.co/300x400" alt="Cover Buku" class="rounded-lg shadow-lg">
                </div>
                <div class="space-y-4">
                    <p><strong>ISBN:</strong> <?= htmlspecialchars($buku['ISBN']); ?></p>
                    <p><strong>Pengarang:</strong> <?= htmlspecialchars($buku['Pengarang']); ?></p>
                    <p><strong>Harga:</strong> Rp <?= number_format($buku['Harga'], 0, ",", "."); ?></p>
                    <p><strong>Stok:</strong> <?= htmlspecialchars($buku['Stok']); ?></p>
                    <p><strong>Kategori:</strong> <?= htmlspecialchars($buku['Kategori']); ?></p>

                    <!-- Formulir Tambah ke Keranjang -->
                    <form method="POST" action="keranjang.php" class="mt-6">
                        <input type="hidden" name="kode_buku" value="<?= $buku['KodeBuku']; ?>">
                        
                        <!-- Input untuk Jumlah Buku -->
                        <label for="jumlah" class="block text-sm">Jumlah Buku</label>
                        <input type="number" name="jumlah" id="jumlah" value="1" min="1" max="<?= $buku['Stok']; ?>" class="w-full p-2 mt-2 border border-gray-300 rounded-md">

                        <button type="submit" name="action" value="add" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-700 w-full mt-4">Tambahkan ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
        <a href="index.php" class="mt-4 block text-blue-500 hover:underline">Kembali ke Beranda</a>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Toko Buku Online. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>