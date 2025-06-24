<?php
session_start();
include 'Koneksi.PHP';

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id_user = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: Logout.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $new_password = $_POST['new_password'];
    
    // Validasi data
    if (empty($username) || empty($email)) {
        $error = "Username dan email harus diisi!";
    } else {
        // Update data user
        $update_query = "UPDATE users SET username = ?, email = ?, phone = ?";
        $params = [$username, $email, $phone];
        $types = "sss";
        
        // Jika ada password baru
        if (!empty($new_password)) {
            $update_query .= ", password = ?";
            $params[] = $new_password;
            $types .= "s";
        }
        
        $update_query .= " WHERE id_user = ?";
        $params[] = $user_id;
        $types .= "i";
        
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        
        if (mysqli_stmt_execute($stmt)) {
            $success = "Profil berhasil diperbarui!";
            // Perbarui data session
            $_SESSION['username'] = $username;
            // Refresh data user
            $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE id_user = $user_id"));
        } else {
            $error = "Gagal memperbarui profil: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="../Design/Data.CSS">
    <link rel="stylesheet" href="../Design/EditProfil.CSS">
</head>
<body>

    <header class="navbar">
        <h1>Edit Profil</h1>
        <nav>
            <a href="Dashboard.php">Dashboard</a>
            <a href="Data.php">Kategori</a>
            <a href="History.php">History</a>
            <a href="Profil.php">Akun</a>
            <a href="Logout.php">Logout</a>
        </nav>
    </header>

    <main class="container">
        <div class="edit-container">
            <?php if ($error): ?>
                <div class="message error"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="message success"><?= $success ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>ID User</label>
                    <input type="text" value="<?= $user['id_user'] ?>" disabled>
                </div>
                
                <div class="form-group">
                    <label>Username *</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                </div>
                
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="new_password" placeholder="Kosongkan jika tidak ingin mengubah">
                    <small>Biarkan kosong jika tidak ingin mengubah password</small>
                </div>
                
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Dashboard Manajemen Nilai</p>
    </footer>
</body>
</html>