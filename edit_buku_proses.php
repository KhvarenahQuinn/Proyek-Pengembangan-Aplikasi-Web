<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Memeriksa apakah ada data yang dikirimkan untuk update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kodeBuku = $_POST['KodeBuku'];
    $isbn = $_POST['ISBN'];
    $judul = $_POST['Judul'];
    $pengarang = $_POST['Pengarang'];
    $harga = $_POST['Harga'];
    $stok = $_POST['Stok'];
    $kategori = $_POST['Kategori'];

    // Update data buku
    $sqlUpdate = "UPDATE Buku SET ISBN = ?, Judul = ?, Pengarang = ?, Harga = ?, Stok = ?, Kategori = ? WHERE KodeBuku = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("sssssss", $isbn, $judul, $pengarang, $harga, $stok, $kategori, $kodeBuku);
    
    if ($stmt->execute()) {
        // Redirect ke halaman edit_buku.php setelah update berhasil
        header("Location: edit_buku.php?edit=$kodeBuku&update=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
