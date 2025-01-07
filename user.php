<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Query untuk mendapatkan data user
$sqlUser = "SELECT * FROM user";
$resultUser = $conn->query($sqlUser);

// Ambil nilai pencarian jika ada
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mendapatkan data user dengan pencarian jika ada
$sqlUser = "SELECT * FROM user WHERE Nama LIKE '%$search%' OR Username LIKE '%$search%' OR Role Like '%$search%'";
$resultUser = $conn->query($sqlUser);

// Jika tombol hapus ditekan
if (isset($_GET['hapus'])) {
    $userID = $_GET['hapus'];
    $sqlHapus = "DELETE FROM user WHERE ID = '$userID'";
    if ($conn->query($sqlHapus) === TRUE) {
        header("Location: user.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Jika tombol edit ditekan, ambil data user yang ingin diedit
if (isset($_GET['edit'])) {
    $userID = $_GET['edit'];
    $sqlEdit = "SELECT * FROM user WHERE ID = '$userID'";
    $resultEdit = $conn->query($sqlEdit);
    $userEdit = $resultEdit->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
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
                        <a href="user.php" class="block py-2 px-3 rounded bg-blue-700">User</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-5">
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-3xl font-bold">Manajemen User</h1>
                <button onclick="openAddUserModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Tambah User
                </button>
            </div>
            <!-- Pencarian -->
            <form method="GET" action="user.php" class="mb-5">
                <input type="text" name="search" class="border border-gray-300 p-2 w-1/2" placeholder="Cari berdasarkan Nama, Username, dan Role" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Cari</button>
            </form>

            <!-- Daftar User -->
            <div class="bg-white shadow rounded p-5">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Lengkap</th>
                            <th class="border border-gray-300 px-4 py-2">Username</th>
                            <th class="border border-gray-300 px-4 py-2">Role</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $resultUser->fetch_assoc()) : ?>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['ID']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['Nama']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Username']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['Role']; ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <button onclick="openEditUserModal(<?= $row['ID']; ?>)" 
                                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-700">Edit</button>
                                    <a href="user.php?hapus=<?= $row['ID']; ?>" 
                                       class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal untuk Tambah User -->
    <div id="addUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-2xl font-bold mb-5">Tambah User</h2>
            <form action="tambah_user_proses.php" method="POST">
                <label class="block text-sm mb-2">Nama Lengkap</label>
                <input type="text" name="Nama" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Username</label>
                <input type="text" name="Username" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Password</label>
                <input type="password" name="Password" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Role</label>
                <select name="Role" class="w-full border border-gray-300 p-2 mb-3" required>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>

                <div class="flex justify-end">
                    <button type="button" onclick="closeAddUserModal()" class="bg-gray-300 text-black px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal untuk Edit User -->
    <div id="editUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-2xl font-bold mb-5">Edit User</h2>
            <form action="edit_user_proses.php" method="POST">
                <input type="hidden" name="ID" id="editUserID">
                <label class="block text-sm mb-2">Nama Lengkap</label>
                <input type="text" name="Nama" id="editNama" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Username</label>
                <input type="text" name="Username" id="editUsername" class="w-full border border-gray-300 p-2 mb-3" required>

                <label class="block text-sm mb-2">Password</label>
                <input type="password" name="Password" id="editPassword" class="w-full border border-gray-300 p-2 mb-3">

                <label class="block text-sm mb-2">Role</label>
                <select name="Role" id="editRole" class="w-full border border-gray-300 p-2 mb-3" required>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>

                <div class="flex justify-end">
                    <button type="button" onclick="closeEditUserModal()" class="bg-gray-300 text-black px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddUserModal() {
            document.getElementById("addUserModal").classList.remove("hidden");
        }

        function closeAddUserModal() {
            document.getElementById("addUserModal").classList.add("hidden");
        }

        function openEditUserModal(userID) {
            // Mengisi data user pada modal edit
            fetch(`get_user_data.php?id=${userID}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("editUserID").value = data.ID;
                    document.getElementById("editNama").value = data.Nama;
                    document.getElementById("editUsername").value = data.Username;
                    document.getElementById("editRole").value = data.Role;
                    document.getElementById("editUserModal").classList.remove("hidden");
                });
        }

        function closeEditUserModal() {
            document.getElementById("editUserModal").classList.add("hidden");
        }
    </script>
</body>
</html>
