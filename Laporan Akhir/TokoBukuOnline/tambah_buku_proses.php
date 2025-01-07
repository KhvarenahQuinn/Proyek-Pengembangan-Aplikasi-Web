<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Memeriksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $isbn = $conn->real_escape_string($_POST['ISBN']);
    $judul = $conn->real_escape_string($_POST['Judul']);
    $pengarang = $conn->real_escape_string($_POST['Pengarang']);
    $harga = $conn->real_escape_string($_POST['Harga']);
    $stok = $conn->real_escape_string($_POST['Stok']);
    $kategori = $conn->real_escape_string($_POST['Kategori']);

    // Query untuk menambah buku baru
    $sql = "INSERT INTO Buku (ISBN, Judul, Pengarang, Harga, Stok, Kategori) 
            VALUES ('$isbn', '$judul', '$pengarang', '$harga', '$stok', '$kategori')";

    if ($conn->query($sql) === TRUE) {
        // Redirect setelah berhasil menambah buku
        header("Location: edit_buku.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
