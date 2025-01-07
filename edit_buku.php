<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Ambil nilai pencarian jika ada
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mendapatkan buku berdasarkan pencarian (jika ada)
$sqlBuku = "SELECT * FROM Buku WHERE Judul LIKE '%$search%' OR ISBN LIKE '%$search%' OR Pengarang LIKE '%$search%' OR Kategori LIKE '%$search%'";
$resultBuku = $conn->query($sqlBuku);

// Jika tombol hapus ditekan
if (isset($_GET['hapus'])) {
    $kodeBuku = $_GET['hapus'];
    $sqlHapus = "DELETE FROM Buku WHERE KodeBuku = '$kodeBuku'";
    if ($conn->query($sqlHapus) === TRUE) {
        header("Location: edit_buku.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Jika tombol edit ditekan
if (isset($_GET['edit'])) {
    $kodeBuku = $_GET['edit'];
    $sqlEdit = "SELECT * FROM Buku WHERE KodeBuku = '$kodeBuku'";
    $resultEdit = $conn->query($sqlEdit);
    $rowEdit = $resultEdit->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-500 text-white min-h-screen p-5">
            <h1 class="text-2xl font-bold mb-5"><a href="admindashboard.php" class="hover:underline">Admin Panel</a></h1>
            <nav>
                <ul>
                    <li class="mb-3">
                        <a href="transaksi.php" class="block py-2 px-3 rounded hover:bg-blue-700">Transaksi</a>
                    </li>
                    <li class="mb-3">
                        <a href="edit_buku.php" class="block py-2 px-3 rounded hover:bg-blue-700">Edit Data Buku</a>
                    </li>
                    <li class="mb-3">
                        <a href="user.php" class="block py-2 px-3 rounded hover:bg-blue-700">User</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-5">
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-3xl font-bold">Edit Data Buku</h1>
                <!-- Button untuk membuka modal tambah buku -->
                <button onclick="openModal('tambahBukuModal')" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Tambah Buku
                </button>
            </div>

            <!-- Form Pencarian -->
            <form method="GET" action="edit_buku.php" class="mb-5">
                <div class="flex items-center">
                    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="w-1/2 border border-gray-300 p-2 mr-2" placeholder="Cari buku berdasarkan judul, pengarang, ISBN, dan kategori">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Cari</button>
                </div>
            </form>

            <!-- Daftar Buku -->
            <div class="bg-white shadow rounded p-5">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Kode Buku</th>
                            <th class="border border-gray-300 px-4 py-2">ISBN</th>
                            <th class="border border-gray-300 px-4 py-2">Judul Buku</th>
                            <th class="border border-gray-300 px-4 py-2">Pengarang</th>
                            <th class="border border-gray-300 px-4 py-2">Harga</th>
                            <th class="border border-gray-300 px-4 py-2">Stok</th>
                            <th class="border border-gray-300 px-4 py-2">Kategori</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $resultBuku->fetch_assoc()) : ?>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['KodeBuku']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['ISBN']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Judul']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Pengarang']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Harga']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Stok']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Kategori']; ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <button onclick="openModal('editBukuModal', '<?= $row['KodeBuku']; ?>')" 
                                                class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-700 text-sm w-24">
                                            Edit
                                        </button>
                                        <a href="edit_buku.php?hapus=<?= $row['KodeBuku']; ?>" 
                                           class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-700 text-sm w-24"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal untuk Tambah Buku -->
    <div id="tambahBukuModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-2xl font-bold mb-5">Tambah Buku</h2>
            <form action="tambah_buku_proses.php" method="POST">
                <label class="block text-sm mb-2">ISBN</label>
                <input type="text" name="ISBN" class="w-full border border-gray-300 p-2 mb-3" required>
                
                <label class="block text-sm mb-2">Judul Buku</label>
                <input type="text" name="Judul" class="w-full border border-gray-300 p-2 mb-3" required>
                
                <label class="block text-sm mb-2">Pengarang</label>
                <input type="text" name="Pengarang" class="w-full border border-gray-300 p-2 mb-3" required>
                
                <label class="block text-sm mb-2">Harga</label>
                <input type="text" name="Harga" class="w-full border border-gray-300 p-2 mb-3" required>
                
                <label class="block text-sm mb-2">Stok</label>
                <input type="number" name="Stok" class="w-full border border-gray-300 p-2 mb-3" required>
                
                <label class="block text-sm mb-2">Kategori</label>
                <select name="Kategori" class="w-full border border-gray-300 p-2 mb-3" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Fiksi">Fiksi</option>
                    <option value="Non-Fiksi">Non-Fiksi</option>
                    <option value="Komik">Komik</option>
                    <option value="Biografi">Biografi</option>
                    <option value="Sains">Sains</option>
                </select>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <button type="button" class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400" onclick="closeModal('tambahBukuModal')">Batal</button>
            </form>
        </div>
    </div>

    <!-- Modal untuk Edit Buku -->
    <div id="editBukuModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-2xl font-bold mb-5">Edit Buku</h2>
            <form action="edit_buku_proses.php" method="POST">
                <input type="hidden" name="KodeBuku" id="editKodeBuku">

                <label class="block text-sm mb-2">ISBN</label>
                <input type="text" name="ISBN" id="editISBN" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Judul Buku</label>
                <input type="text" name="Judul" id="editJudul" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Pengarang</label>
                <input type="text" name="Pengarang" id="editPengarang" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Harga</label>
                <input type="text" name="Harga" id="editHarga" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Stok</label>
                <input type="number" name="Stok" id="editStok" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Kategori</label>
                <select name="Kategori" id="editKategori" class="w-full border border-gray-300 p-2 mb-3" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Fiksi">Fiksi</option>
                    <option value="Non-Fiksi">Non-Fiksi</option>
                    <option value="Komik">Komik</option>
                    <option value="Biografi">Biografi</option>
                    <option value="Sains">Sains</option>
                </select>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                <button type="button" class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400" onclick="closeModal('editBukuModal')">Batal</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId, kodeBuku = '') {
            document.getElementById(modalId).classList.remove('hidden');
            if (modalId === 'editBukuModal') {
                fetch('get_buku.php?kode=' + kodeBuku)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editKodeBuku').value = data.KodeBuku;
                        document.getElementById('editISBN').value = data.ISBN;
                        document.getElementById('editJudul').value = data.Judul;
                        document.getElementById('editPengarang').value = data.Pengarang;
                        document.getElementById('editHarga').value = data.Harga;
                        document.getElementById('editStok').value = data.Stok;
                        document.getElementById('editKategori').value = data.Kategori;
                    });
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</body>
</html>
