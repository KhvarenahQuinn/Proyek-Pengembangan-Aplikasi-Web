<?php
$transaksiID = isset($_GET['transaksiID']) ? $_GET['transaksiID'] : '';
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT * FROM transaksi WHERE IDTransaksi = '$transaksiID'";
$result = $conn->query($sql);
$transaksi = $result->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; border: 1px solid #000; padding: 20px;">
        <h2>Struk Transaksi</h2>
        <p><strong>ID Transaksi:</strong> <?= $transaksi['IDTransaksi'] ?></p>
        <p><strong>Tanggal:</strong> <?= $transaksi['Tanggal'] ?></p>
        <p><strong>Total:</strong> <?= $transaksi['Total'] ?></p>
        <p><strong>Status:</strong> <?= $transaksi['Status'] ?></p>
    </div>
</body>
</html>
