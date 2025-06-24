<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Design/Dashboard.CSS">
    <link rel="stylesheet" href="../Design/Data.CSS">
    </style>
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

    <div class="container">
        <!-- Statistik -->
        <div class="stat-container">
            <?php
            include 'Koneksi.php';
            $statSql = "SELECT 
            SUM(nilai1) + SUM(nilai2) + SUM(nilai3) AS Jumlah,
            AVG(nilai1 + nilai2 + nilai3) AS rata_rata,
            MAX(nilai1 + nilai2 + nilai3) AS nilai_tertinggi,
            MIN(nilai1 + nilai2 + nilai3) AS nilai_terendah,
            COUNT(id_peserta) AS JumlahPeserta
            FROM nilai_lomba";
            $statResult = $con->query($statSql);
            $statData = $statResult->fetch_assoc();
            ?>
            <div class="stat-box">
                <div class="stat-value"><?= number_format($statData['rata_rata'] ?? 0, 2) ?></div>
                <div class="stat-label">Rata-rata Nilai</div>
            </div>
            <div class="stat-box">
                <div class="stat-value"><?= number_format($statData['nilai_tertinggi'] ?? 0, 2) ?></div>
                <div class="stat-label">Nilai Tertinggi</div>
            </div>
            <div class="stat-box">
                <div class="stat-value"><?= number_format($statData['nilai_terendah'] ?? 0, 2) ?></div>
                <div class="stat-label">Nilai Terendah</div>
            </div>
            <div class="stat-box">
                <div class="stat-value"><?= number_format($statData['Jumlah'] ?? 0, 2) ?></div>
                <div class="stat-label">Jumlah Nilai</div>
            </div>
            <div class="stat-box">
                <div class="stat-value"><?= number_format($statData['JumlahPeserta'] ?? 0, ) ?></div>
                <div class="stat-label">Jumlah Peserta</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Data Peringkat Peserta</h2>
                <!-- FILTER & SEARCH -->
                <form method="get" action="">
                    <div class="filter-container">
                        <label for="nilaiFilter">Filter Nilai:</label>
                        <select id="nilaiFilter" name="filter">
                            <option value="semua" <?= isset($_GET['filter']) && $_GET['filter'] == 'semua' ? 'selected' : '' ?>>Tampilkan Semua</option>
                            <option value="tertinggi" <?= isset($_GET['filter']) && $_GET['filter'] == 'tertinggi' ? 'selected' : '' ?>>Nilai Tertinggi</option>
                            <option value="terendah" <?= isset($_GET['filter']) && $_GET['filter'] == 'terendah' ? 'selected' : '' ?>>Nilai Terendah</option>
                        </select>

                        <label for="search">Cari Nama:</label>
                        <input type="text" name="search" id="search" placeholder="Nama Peserta" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">

                        <button type="submit" class="btn">Terapkan</button>
                    </div>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Nama Peserta</th>
                        <th>Jenis Lomba</th>
                        <th>Total Nilai</th>
                        <th>Peringkat</th>
                        <th>Rata-rata Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = isset($_GET['search']) ? $con->real_escape_string($_GET['search']) : '';
                    $filter = $_GET['filter'] ?? 'semua';

                    $sql = "SELECT 
                                vpp.*, 
                                ROUND((vpp.total_nilai / 3), 2) AS rata_nilai 
                            FROM view_peringkat_peserta vpp";

                    $conditions = [];

                    if ($filter == 'tertinggi') {
                        $conditions[] = "total_nilai = (SELECT MAX(total_nilai) FROM view_peringkat_peserta)";
                    } elseif ($filter == 'terendah') {
                        $conditions[] = "total_nilai = (SELECT MIN(total_nilai) FROM view_peringkat_peserta)";
                    }

                    if (!empty($search)) {
                        $conditions[] = "nama_peserta LIKE '%$search%'";
                    }

                    if (!empty($conditions)) {
                        $sql .= " WHERE " . implode(" AND ", $conditions);
                    }

                    $result = $con->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['nama_peserta']}</td>
                                <td>{$row['jenis_lomba']}</td>
                                <td>{$row['total_nilai']}</td>
                                <td>{$row['peringkat']}</td>
                                <td>{$row['rata_nilai']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data ditemukan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Jadwal Lomba</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Kategori Lomba</th>
                        <th>Lomba</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT k.nama_kategori, l.nama_lomba, l.tanggal_lomba 
                            FROM lomba l
                            JOIN kategori_lomba k ON l.id_kategori = k.id_kategori";
                    $result = $con->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['nama_kategori']}</td>
                            <td>{$row['nama_lomba']}</td>
                            <td>{$row['tanggal_lomba']}</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        &copy; 2025 Dashboard Manajemen Nilai
    </footer>
</body>
</html>
