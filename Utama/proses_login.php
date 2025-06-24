<?php
session_start();
include 'Koneksi.PHP';

$username = $_POST['username'];
$password = $_POST['password'];

// Gunakan prepared statement untuk mencegah SQL injection
$query = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {
    // Verifikasi password (asumsi password disimpan tanpa hash di database)
    // Jika menggunakan password_hash(), gunakan password_verify()
    if ($user['password'] === $password) {
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        header("Location: Dashboard.php");
        exit;
    }
}
