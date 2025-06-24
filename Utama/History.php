<?php
include 'Koneksi.PHP';
$history = mysqli_query($con, "SELECT * FROM peserta_history ORDER BY deleted_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>History Peserta</title>
    <link rel="stylesheet" href="../Design/Data.CSS">
</head>
<body>

    <header class="navbar">
        <h1>History Peserta Dihapus</h1>
        <nav>
            <a href="Dashboard.php">Dashboard</a>
            <a href="Data.php">Kategori</a>
            <a href="History.php">History</a>
            <a href="Akun.php">Akun</a>
            <a href="Logout.php">Logout</a>
        </nav>
    </header>

    <main class="container">
        <section class="card">
            <div class="card-header">
                <h2>Data Peserta yang Dihapus</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID Peserta</th>
                        <th>Nama Peserta</th>
                        <th>Kelas</th>
                        <th>Waktu Penghapusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($h = mysqli_fetch_assoc($history)): ?>
                    <tr>
                        <td><?= $h['id_peserta'] ?></td>
                        <td><?= $h['nama'] ?></td>
                        <td><?= $h['kelas'] ?></td>
                        <td><?= date('d M Y H:i', strtotime($h['deleted_at'])) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Dashboard Manajemen Nilai</p>
    </footer>
</body>
</html>