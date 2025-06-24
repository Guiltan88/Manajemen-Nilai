<?php
session_start();
include 'Koneksi.PHP';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit;
}

// Ambil data user dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id_user = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt); // Perbaikan: simpan hasil query
$user = mysqli_fetch_assoc($result); // Perbaikan: gunakan $result untuk fetch

// Jika user tidak ditemukan
if (!$user) {
    session_destroy();
    header("Location: Login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="../Design/Data.CSS">
    <link rel="stylesheet" href="../Design/Akun.CSS">
    
</head>
<body>

    <header class="navbar">
        <h1>Profil Saya</h1>
        <nav>
            <a href="Dashboard.php">Dashboard</a>
            <a href="Data.php">Kategori</a>
            <a href="History.php">History</a>
            <a href="Profil.php">Akun</a>
            <a href="Logout.php">Logout</a>
        </nav>
    </header>

    <main class="container">
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?= strtoupper(substr($user['username'], 0, 1)) ?>
                </div>
                <h2><?= htmlspecialchars($user['username']) ?></h2>
            </div>
            
            <div class="profile-info">
                <div class="info-row">
                    <div class="info-label">ID User</div>
                    <div class="info-value"><?= $user['id_user'] ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Username</div>
                    <div class="info-value"><?= htmlspecialchars($user['username']) ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value"><?= htmlspecialchars($user['email']) ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Nomor Telepon</div>
                    <div class="info-value"><?= htmlspecialchars($user['phone']) ?></div>
                </div>
                
                <a href="EditProfil.php" class="btn-edit">Edit Profil</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Dashboard Manajemen Nilai</p>
    </footer>
</body>
</html>