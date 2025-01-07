<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Ambil kode buku dari parameter GET
$kodeBuku = $_GET['kodeBuku'];

// Query untuk mendapatkan data buku
$sql = "SELECT * FROM Buku WHERE KodeBuku = '$kodeBuku'";
$result = $conn->query($sql);

// Mengambil data buku jika ada
if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode([]);
}

$conn->close();
?>
