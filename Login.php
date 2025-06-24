<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: Dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../Design/Data.CSS">
    <link rel="stylesheet" href="../Design/Login.CSS">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Login Dashboard</h2>
        </div>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
                Username atau password salah!
            </div>
        <?php endif; ?>
        
        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>