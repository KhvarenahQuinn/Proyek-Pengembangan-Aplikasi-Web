<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil ID user dari parameter URL
if (isset($_GET['id'])) {
    $userID = $_GET['id'];

    // Query untuk mengambil data user berdasarkan ID
    $sql = "SELECT * FROM user WHERE ID = '$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data user
        $user = $result->fetch_assoc();
        // Kirim data dalam format JSON
        echo json_encode($user);
    } else {
        echo json_encode(["error" => "User tidak ditemukan"]);
    }
} else {
    echo json_encode(["error" => "ID tidak diberikan"]);
}

$conn->close();
?>
