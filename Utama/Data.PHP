<?php
include 'Koneksi.PHP';

$peserta = mysqli_query($con, "SELECT * FROM peserta");
$kategori = mysqli_query($con, "SELECT * FROM kategori_lomba");

$nilai_query = "SELECT nl.*, p.nama AS nama_peserta FROM nilai_lomba nl JOIN peserta p ON nl.id_peserta = p.id_peserta";
$nilai = mysqli_query($con, $nilai_query);

// Cek jika terjadi error pada query nilai
if (!$nilai) {
    die("Query nilai_lomba gagal: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peserta & Kategori</title>
    <link rel="stylesheet" href="../Design/Data.CSS">
</head>
<body>

    <header class="navbar">
        <h1>Dashboard</h1>
        <nav>
            <a href="Dashboard.php">Dashboard</a>
            <a href="Data.php">Kategori</a>
            <a href="History.php">History</a>
            <a href="Akun.php">Akun</a>
            <a href="Logout.php">Logout</a>
        </nav>
    </header>

    <main class="container">

        <!-- Tabel Peserta -->
        <section class="card">
            <div class="card-header">
                <h2>Data Peserta</h2>
                <a href="../peserta/PesertaC.PHP" class="btn">+ Tambah Peserta</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Peserta</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($p = mysqli_fetch_assoc($peserta)): ?>
                    <tr>
                        <td><?= $p['nama'] ?></td>
                        <td><?= $p['kelas'] ?></td>
                        <td>
                            <a href="../Peserta/PesertaU.PHP?id=<?= $p['id_peserta'] ?>" class="icon edit-icon" title="Edit">&#9998;</a>
                            <a href="../Peserta/PesertaD.PHP?id=<?= $p['id_peserta'] ?>" class="icon delete-icon" title="Hapus" onclick="return confirm('Hapus data ini?')">&#128465;</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Tabel Kategori -->
        <section class="card">
            <div class="card-header">
                <h2>Kategori Lomba</h2>
                <a href="../Kategori/Create.PHP" class="btn">+ Tambah Kategori</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($k = mysqli_fetch_assoc($kategori)): ?>
                    <tr>
                        <td><?= $k['nama_kategori'] ?></td>
                        <td>
                            <a href="../Kategori/Update.PHP?id=<?= $k['id_kategori'] ?>" class="icon edit-icon" title="Edit">&#9998;</a>
                            <a href="../Kategori/Delete.PHP?id=<?= $k['id_kategori'] ?>" class="icon delete-icon" title="Hapus" onclick="return confirm('Hapus kategori ini?')">&#128465;</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Tabel Nilai Lomba -->
        <section class="card">
            <div class="card-header">
                <h2>Nilai Lomba</h2>
                <a href="../Nilai/NilaiC.PHP" class="btn">+ Tambah Nilai</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Peserta</th>
                        <th>Nilai 1</th>
                        <th>Nilai 2</th>
                        <th>Nilai 3</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($n = mysqli_fetch_assoc($nilai)): ?>
                    <tr>
                        <td><?= $n['nama_peserta'] ?></td>
                        <td><?= $n['nilai1'] ?></td>
                        <td><?= $n['nilai2'] ?></td>
                        <td><?= $n['nilai3'] ?></td>
                        <td><?= $n['keterangan'] ?></td>
                        <td>
                            <a href="../Nilai/NilaiU.PHP?id=<?= $n['id_nilai'] ?>" class="icon edit-icon" title="Edit">&#9998;</a>
                            <a href="../Nilai/NilaiD.PHP?id=<?= $n['id_nilai'] ?>" class="icon delete-icon" title="Hapus" onclick="return confirm('Hapus nilai ini?')">&#128465;</a>
                        </td>
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
