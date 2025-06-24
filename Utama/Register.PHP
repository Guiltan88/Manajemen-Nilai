<?php
include 'Koneksi.PHP';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    // Cek apakah username sudah dipakai
    $cek = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan.";
    } else {
        $query = mysqli_query($con, "INSERT INTO users (username, email, password, phone) VALUES ('$username', '$email', '$password', '$phone')");
        if ($query) {
            echo "<script>alert('Akun berhasil dibuat! Silakan login.'); location.href='login.php';</script>";
            exit;
        } else {
            $error = "Gagal membuat akun.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi</title>
  <link rel="stylesheet" href="../Design/Register.CSS">
</head>
<body>
  <main class="form-card">
    <h2>Registrasi</h2>
    <form method="post">
      <label>Username</label>
      <input type="text" name="username" required>

      <label>Email</label>
      <input type="email" name="email">

      <label>No. HP</label>
      <input type="text" name="phone">

      <label>Password</label>
      <input type="password" name="password" required>

      <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

      <div class="form-actions">
        <button type="submit" class="btn primary">Daftar</button>
      </div>

      <p style="text-align:center;">Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
  </main>
</body>
</html>
