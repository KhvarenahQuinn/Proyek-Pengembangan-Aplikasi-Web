<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data yang dikirimkan dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['ID'];
    $nama = $_POST['Nama'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $role = $_POST['Role'];

    // Jika password tidak kosong, maka update password, jika kosong, biarkan tetap
    if (!empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET Nama = '$nama', Username = '$username', Password = '$passwordHash', Role = '$role' WHERE ID = '$userID'";
    } else {
        $sql = "UPDATE user SET Nama = '$nama', Username = '$username', Role = '$role' WHERE ID = '$userID'";
    }

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman user setelah berhasil update
        header("Location: user.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
