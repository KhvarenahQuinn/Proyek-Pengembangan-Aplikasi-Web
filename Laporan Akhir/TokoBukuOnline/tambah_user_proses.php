<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Memeriksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama = $conn->real_escape_string($_POST['Nama']);
    $username = $conn->real_escape_string($_POST['Username']);
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Enkripsi password
    $role = $conn->real_escape_string($_POST['Role']);

    // Query untuk menambah user baru
    $sql = "INSERT INTO user (Nama, Username, Password, Role) VALUES ('$nama', '$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        // Redirect setelah berhasil menambah user
        header("Location: user.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
