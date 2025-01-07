<?php

/**
 * Ambil detail buku berdasarkan kode buku.
 *
 * @param mysqli $conn Koneksi database
 * @param int $kode_buku Kode buku
 * @return array|null Data buku atau null jika tidak ditemukan
 */
function getBookDetails($conn, $kode_buku) {
    $sql = "SELECT * FROM buku WHERE KodeBuku = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kode_buku);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

?>
