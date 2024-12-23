<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Ambil nilai pencarian jika ada
$search = isset($_GET['search']) ? $_GET['search'] : '';
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

// Query untuk mendapatkan data transaksi dengan pencarian dan filter status jika ada
$sqlTransaksi = "SELECT * FROM transaksi WHERE (IDTransaksi LIKE '%$search%' OR IDUser LIKE '%$search%' OR Status LIKE '%$search%')";
if ($statusFilter) {
    $sqlTransaksi .= " AND Status = '$statusFilter'";
}
$resultTransaksi = $conn->query($sqlTransaksi);

// Jika tombol hapus ditekan
if (isset($_GET['hapus'])) {
    $transaksiID = $_GET['hapus'];
    $sqlHapus = "DELETE FROM transaksi WHERE IDTransaksi = '$transaksiID'";
    if ($conn->query($sqlHapus) === TRUE) {
        header("Location: transaksi.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Jika tombol edit ditekan, ambil data transaksi yang ingin diedit
if (isset($_GET['edit'])) {
    $transaksiID = $_GET['edit'];
    $sqlEdit = "SELECT * FROM transaksi WHERE IDTransaksi = '$transaksiID'";
    $resultEdit = $conn->query($sqlEdit);
    $transaksiEdit = $resultEdit->fetch_assoc();
}

// Menangani Formulir Tambah Transaksi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['IDUser'])) {
    $IDUser = $_POST['IDUser'];
    $Status = $_POST['Status'];
    $bukti_transfer = $_FILES['bukti_transfer']['name'];

    if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] == 0) {
        $bukti_transfer = $_FILES['bukti_transfer']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($bukti_transfer);
        move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $target_file);
    } else {
        $bukti_transfer = null; // Atur ke null jika tidak ada file yang diupload
    }

    // Insert transaksi utama
    $sqlInsertTransaksi = "INSERT INTO transaksi (IDUser, Status, bukti_transfer) VALUES ('$IDUser', '$Status', '$bukti_transfer')";
    if ($conn->query($sqlInsertTransaksi) === TRUE) {
        $transaksiID = $conn->insert_id;

        // Loop untuk insert detail transaksi (buku-buku yang dipilih)
        $Total = 0;
        for ($i = 0; $i < count($_POST['KodeBuku']); $i++) {
            $KodeBuku = $_POST['KodeBuku'][$i];
            $Judul = $_POST['Judul'][$i];
            $Harga = $_POST['Harga'][$i];
            $Jumlah = $_POST['Jumlah'][$i];
            $Subtotal = $Harga * $Jumlah;

            // Insert detail transaksi
            $sqlInsertDetail = "INSERT INTO detail_transaksi (IDTransaksi, KodeBuku, Judul, Harga, Jumlah, Subtotal) 
                                VALUES ('$transaksiID', '$KodeBuku', '$Judul', '$Harga', '$Jumlah', '$Subtotal')";
            $conn->query($sqlInsertDetail);

            // Hitung total transaksi
            $Total += $Subtotal;
        }

        // Update total transaksi
        $conn->query("UPDATE transaksi SET Total = '$Total' WHERE IDTransaksi = '$transaksiID'");

        header("Location: transaksi.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi</title>
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
                        <a href="transaksi.php" class="block py-2 px-3 rounded bg-blue-700">Transaksi</a>
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
                <h1 class="text-3xl font-bold">Manajemen Transaksi</h1>
                <button onclick="openAddTransaksiModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Tambah Transaksi
                </button>
            </div>

            <!-- Pencarian dan Filter Status -->
            <form method="GET" action="transaksi.php" class="mb-5 flex gap-4">
                <input type="text" name="search" class="border border-gray-300 p-2 w-1/3" placeholder="Cari berdasarkan ID Transaksi, ID User atau Status" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <select name="status" class="border border-gray-300 p-2">
                    <option value="">Semua Status</option>
                    <option value="diproses" <?= $statusFilter == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                    <option value="selesai" <?= $statusFilter == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                    <option value="dibatalkan" <?= $statusFilter == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Cari</button>
            </form>

            <!-- Daftar Transaksi -->
            <div class="bg-white shadow rounded p-5">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">ID Transaksi</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                            <th class="border border-gray-300 px-4 py-2">ID User</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Total</th>
                            <th class="border border-gray-300 px-4 py-2 w-1/4">Aksi</th> <!-- Lebarkan kolom Aksi -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $resultTransaksi->fetch_assoc()) : ?>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['IDTransaksi']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Tanggal']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['IDUser']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Status']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Total']; ?></td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="?edit=<?= $row['IDTransaksi']; ?>" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700">Edit</a>
                                    <a href="?hapus=<?= $row['IDTransaksi']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700 ml-2">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Tambah Transaksi -->
            <div id="addTransaksiModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center">
                <div class="bg-white p-5 rounded shadow-lg w-2/3 md:w-1/2">
                    <h2 class="text-2xl font-bold mb-4">Tambah Transaksi</h2>
                    <form method="POST" action="transaksi.php" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="IDUser" class="block text-sm font-semibold">ID User</label>
                            <input type="text" name="IDUser" id="IDUser" required class="border border-gray-300 p-2 w-full">
                        </div>
                        <div class="mb-4">
                            <label for="Status" class="block text-sm font-semibold">Status</label>
                            <select name="Status" id="Status" required class="border border-gray-300 p-2 w-full">
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="bukti_transfer" class="block text-sm font-semibold">Bukti Transfer</label>
                            <input type="file" name="bukti_transfer" id="bukti_transfer" class="border border-gray-300 p-2 w-full">
                        </div>

                        <h3 class="text-xl font-semibold mb-2">Daftar Buku</h3>
                        <div id="bukuContainer">
                            <div class="bukuRow mb-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <label for="KodeBuku[]" class="block text-sm font-semibold">Kode Buku</label>
                                        <input type="number" name="KodeBuku[]" class="border border-gray-300 p-2 w-full">
                                    </div>
                                    <div>
                                        <label for="Judul[]" class="block text-sm font-semibold">Judul Buku</label>
                                        <input type="text" name="Judul[]" class="border border-gray-300 p-2 w-full">
                                    </div>
                                    <div>
                                        <label for="Harga[]" class="block text-sm font-semibold">Harga</label>
                                        <input type="number" step="0.01" name="Harga[]" class="border border-gray-300 p-2 w-full">
                                    </div>
                                    <div>
                                        <label for="Jumlah[]" class="block text-sm font-semibold">Jumlah</label>
                                        <input type="number" name="Jumlah[]" class="border border-gray-300 p-2 w-full">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="addBukuBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Buku</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 mt-4">Simpan Transaksi</button>
                        <button type="button" id="closeModalBtn" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 mt-4 ml-2">Tutup</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Fungsi untuk membuka modal
        function openAddTransaksiModal() {
            document.getElementById("addTransaksiModal").classList.remove("hidden");
        }

        // Fungsi untuk menutup modal
        document.getElementById("closeModalBtn").onclick = function() {
            document.getElementById("addTransaksiModal").classList.add("hidden");
        };

        // Menambahkan baris buku baru
        document.getElementById("addBukuBtn").onclick = function() {
            let bukuContainer = document.getElementById("bukuContainer");
            let newBukuRow = document.createElement("div");
            newBukuRow.classList.add("bukuRow", "mb-4");
            newBukuRow.innerHTML = `
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="KodeBuku[]" class="block text-sm font-semibold">Kode Buku</label>
                        <input type="number" name="KodeBuku[]" class="border border-gray-300 p-2 w-full">
                    </div>
                    <div>
                        <label for="Judul[]" class="block text-sm font-semibold">Judul Buku</label>
                        <input type="text" name="Judul[]" class="border border-gray-300 p-2 w-full">
                    </div>
                    <div>
                        <label for="Harga[]" class="block text-sm font-semibold">Harga</label>
                        <input type="number" step="0.01" name="Harga[]" class="border border-gray-300 p-2 w-full">
                    </div>
                    <div>
                        <label for="Jumlah[]" class="block text-sm font-semibold">Jumlah</label>
                        <input type="number" name="Jumlah[]" class="border border-gray-300 p-2 w-full">
                    </div>
                </div>
            `;
            bukuContainer.appendChild(newBukuRow);
        };
    </script>
</body>
</html>
