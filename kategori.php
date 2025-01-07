<?php
session_start();
require_once "inc/db.php";
require_once "inc/functions.php";

// Ambil daftar kategori yang unik dari tabel buku
$query = "SELECT DISTINCT Kategori FROM buku";
$result = $conn->query($query);

// Cek jika query berhasil
if ($result) {
    $kategori = $result->fetch_all(MYSQLI_ASSOC); // Ambil hasil sebagai array asosiasi
} else {
    echo "Query gagal: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

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

    <!-- Kategori Buku -->
    <main class="flex-grow container mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold mb-6">Kategori Buku</h1>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            <?php foreach ($kategori as $item): ?>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h2 class="text-xl font-semibold"><?= htmlspecialchars($item['Kategori']); ?></h2>
                    <a href="produk.php?kategori=<?= urlencode($item['Kategori']); ?>" class="mt-4 block text-blue-500 hover:underline">Lihat Buku</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Toko Buku Online. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
