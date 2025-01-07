<?php
// Set konfigurasi database
$host = "localhost"; // Host database
$username = "root"; // Username database (biasanya root di localhost)
$password = ""; // Password database (kosongkan jika tidak ada password)
$dbname = "tokobukuonline"; // Nama database yang digunakan

// Membuat koneksi ke database
$mysqli = new mysqli($host, $username, $password, $dbname);

// Cek apakah koneksi berhasil
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>
