<?php
session_start(); // Mulai session untuk akses keranjang
require_once "inc/db.php";
require_once "inc/functions.php";

// Fungsi untuk menambahkan buku ke keranjang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $kode_buku = $_POST['kode_buku'];
    $jumlah = $_POST['jumlah'];

    // Pastikan keranjang ada dalam session
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    // Cek apakah buku sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['keranjang'] as &$item) {
        if ($item['kode_buku'] == $kode_buku) {
            $item['jumlah'] += $jumlah;
            $found = true;
            break;
        }
    }

    // Jika belum ada, tambahkan buku baru ke keranjang
    if (!$found) {
        $_SESSION['keranjang'][] = [
            'kode_buku' => $kode_buku,
            'jumlah' => $jumlah
        ];
    }
}

// Fungsi untuk menghapus buku dari keranjang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'remove') {
    $kode_buku = $_POST['kode_buku'];
    foreach ($_SESSION['keranjang'] as $key => $item) {
        if ($item['kode_buku'] == $kode_buku) {
            unset($_SESSION['keranjang'][$key]);
            break;
        }
    }
    $_SESSION['keranjang'] = array_values($_SESSION['keranjang']); // Re-index array
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
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

    <!-- Keranjang -->
    <main class="flex-grow container mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold mb-6">Keranjang Belanja</h1>

        <?php if (!empty($_SESSION['keranjang'])): ?>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Judul Buku</th>
                            <th class="border px-4 py-2">Jumlah</th>
                            <th class="border px-4 py-2">Total Harga</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_harga = 0;
                        $no = 1;
                        foreach ($_SESSION['keranjang'] as $item):
                            $buku = getBookDetails($conn, $item['kode_buku']); // Ambil detail buku dari database
                            $total_buku = $buku['Harga'] * $item['jumlah'];
                            $total_harga += $total_buku;
                        ?>
                            <tr>
                                <td class="border px-4 py-2"><?= $no++; ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($buku['Judul']); ?></td>
                                <td class="border px-4 py-2"><?= $item['jumlah']; ?></td>
                                <td class="border px-4 py-2">Rp <?= number_format($total_buku, 0, ",", "."); ?></td>
                                <td class="border px-4 py-2">
                                    <form method="POST" action="keranjang.php" class="inline-block">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="kode_buku" value="<?= $item['kode_buku']; ?>">
                                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="border px-4 py-2 text-right font-bold">Total Harga</td>
                            <td class="border px-4 py-2 font-bold">Rp <?= number_format($total_harga, 0, ",", "."); ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Tombol Pesan via WhatsApp -->
            <div class="mt-6">
                <a href="https://wa.me/?text=Halo%2C%20aku%20ingin%20memesan%20buku%20berikut%3A%0A%0A<?php
                $message = '';
                $total_harga = 0;
                foreach ($_SESSION['keranjang'] as $item) {
                    $buku = getBookDetails($conn, $item['kode_buku']);
                    $total_buku = $buku['Harga'] * $item['jumlah'];
                    $message .= '"' . urlencode($buku['Judul']) . '", ' . $item['jumlah'] . ', "Rp ' . number_format($total_buku, 0, ',', '.') . '"';
                    $total_harga += $total_buku;
                }
                $message .= 'Total Harga Rp' . number_format($total_harga, 0, ',', '.');
                echo urlencode($message);
                ?>" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-700" target="_blank">
                    Pesan via WhatsApp
                </a>
            </div>
        <?php else: ?>
            <p class="text-center">Keranjang Anda kosong.</p>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Toko Buku Online. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
