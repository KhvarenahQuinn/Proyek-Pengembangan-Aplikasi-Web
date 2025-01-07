<?php
require_once "inc/db.php";
require_once "inc/functions.php";

// Cek apakah ada kategori yang dipilih dari URL
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Jika kategori ada, ubah query untuk mengambil buku berdasarkan kategori
if ($kategori) {
    $sql = "SELECT * FROM buku WHERE Kategori = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kategori);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Jika tidak ada kategori, ambil semua buku
    $sql = "SELECT * FROM buku";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Toko Buku</title>
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
                <a href="keranjang.php" class="hover:underline">Keranjang</a>
                <a href="tentang_kami.php" class="hover:underline">Tentang Kami</a>
            </nav>
        </div>
    </header>

    <!-- Produk List -->
    <section class="bg-gray-50 py-16 px-6">
        <div class="container mx-auto">
            <?php if ($kategori): ?>
                <h2 class="text-2xl font-bold text-center mb-8">Kategori Buku: <?= htmlspecialchars($kategori); ?></h2>
            <?php else: ?>
                <h2 class="text-2xl font-bold text-center mb-8">Daftar Buku</h2>
            <?php endif; ?>
            
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
