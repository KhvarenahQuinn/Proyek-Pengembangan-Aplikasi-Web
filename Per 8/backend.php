<?php
header("Content-Type: application/json");

// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'my_app';

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Koneksi gagal: " . $conn->connect_error]));
}

// Baca input JSON
$input = json_decode(file_get_contents('php://input'), true);
$action = isset($_GET['action']) ? $_GET['action'] : $input['action'];

if ($action === 'create') {
    // Tambah data
    $name = $conn->real_escape_string($input['name']);
    $email = $conn->real_escape_string($input['email']);

    $sql = "INSERT INTO records (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => $conn->error]);
    }
} elseif ($action === 'read') {
    // Ambil data
    $sql = "SELECT * FROM records ORDER BY id DESC";
    $result = $conn->query($sql);

    $records = [];
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
    echo json_encode($records);
} else {
    echo json_encode(["success" => false, "message" => "Aksi tidak valid"]);
}

$conn->close();
?>
