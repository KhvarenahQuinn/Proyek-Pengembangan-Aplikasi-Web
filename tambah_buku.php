<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Tambah Buku
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isbn = $_POST['isbn'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $kodeBuku = $_POST['kode_buku'];

    $sql = "INSERT INTO Buku (ISBN, JudulBuku, Pengarang, KodeBuku) VALUES ('$isbn', '$judul', '$pengarang', '$kodeBuku')";
    if ($conn->query($sql) === TRUE) {
        header("Location: edit_buku.php");
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
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white shadow rounded p-10">
            <h1 class="text-2xl font-bold mb-5">Tambah Buku Baru</h1>
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="isbn" class="block font-semibold mb-2">ISBN</label>
                    <input type="text" id="isbn" name="isbn" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label for="judul" class="block font-semibold mb-2">Judul Buku</label>
                    <input type="text" id="judul" name="judul" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label for="pengarang" class="block font-semibold mb-2">Pengarang</label>
                    <input type="text" id="pengarang" name="pengarang" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label for="kode_buku" class="block font-semibold mb-2">Kode Buku</label>
                    <input type="text" id="kode_buku" name="kode_buku" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="flex justify-end">
                <a href="edit_buku.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 mr-2">
                        Kembali
                    </a>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
