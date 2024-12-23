<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'TokoBukuOnline');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Query jumlah user
$sqlUser = "SELECT COUNT(*) AS total_user FROM User";
$resultUser = $conn->query($sqlUser);
$totalUser = $resultUser->fetch_assoc()['total_user'];

// Query jumlah transaksi
$sqlTransaksi = "SELECT COUNT(*) AS total_transaksi FROM Transaksi";
$resultTransaksi = $conn->query($sqlTransaksi);
$totalTransaksi = $resultTransaksi->fetch_assoc()['total_transaksi'];

// Query jumlah buku
$sqlBuku = "SELECT COUNT(*) AS total_buku FROM Buku";
$resultBuku = $conn->query($sqlBuku);
$totalBuku = $resultBuku->fetch_assoc()['total_buku'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-500 text-white min-h-screen p-5">
            <h1 class="text-2xl font-bold mb-5">Admin Panel</h1>
            <nav>
                <ul>
                    <li class="mb-3">
                        <a href="transaksi.php" class="block py-2 px-3 rounded hover:bg-blue-700">Transaksi</a>
                    </li>
                    <li class="mb-3">
                        <a href="edit_buku.php" class="block py-2 px-3 rounded hover:bg-blue-700">Edit Data Buku</a>
                    </li>
                    <li class="mb-3">
                        <a href="user.php" class="block py-2 px-3 rounded hover:bg-blue-700">User</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-5">
            <h1 class="text-3xl font-bold mb-5">Welcome to Admin Dashboard</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Statistik -->
                <div class="bg-white shadow rounded p-5">
                    <h2 class="text-xl font-bold mb-3">Jumlah Statistik</h2>
                    <p><strong>User:</strong> <?= $totalUser; ?></p>
                    <p><strong>Transaksi:</strong> <?= $totalTransaksi; ?></p>
                    <p><strong>Buku:</strong> <?= $totalBuku; ?></p>
                </div>

                <!-- Chart -->
                <div class="bg-white shadow rounded p-5 col-span-2">
                    <h2 class="text-xl font-bold mb-3">Statistik dalam Grafik</h2>
                    <canvas id="chartStatistik"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Data Statistik dari PHP
        const dataStatistik = {
            labels: ['User', 'Transaksi', 'Buku'],
            datasets: [{
                label: 'Jumlah',
                data: [<?= $totalUser; ?>, <?= $totalTransaksi; ?>, <?= $totalBuku; ?>],
                backgroundColor: ['#4caf50', '#ff9800', '#2196f3'],
                borderColor: ['#4caf50', '#ff9800', '#2196f3'],
                borderWidth: 1
            }]
        };

        // Konfigurasi Chart
        const config = {
            type: 'pie', // Tipe chart: Pie
            data: dataStatistik,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        };

        // Render Chart
        const chart = new Chart(
            document.getElementById('chartStatistik'),
            config
        );
    </script>
</body>
</html>
