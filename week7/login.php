<?php
session_start();

// Jika sudah login, redirect ke beranda
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

require 'fungsi.php';

if (isset($_POST['login'])) {
    $username = strtolower(stripslashes(mysqli_real_escape_string($koneksi, $_POST['username'])));
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    // Cek username
    if (mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Set session
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Web RZN</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-body">
    <div class="auth-wrapper">
        <div class="auth-card">
            <h2>Login</h2>
            <p class="subtitle">Selamat datang kembali! Silakan masuk ke akun Anda.</p>

            <?php if (isset($error)) : ?>
                <div class="auth-alert">
                    Username atau password salah!
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="auth-form">
                <div class="auth-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="auth-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit" name="login" class="auth-btn">Masuk</button>
            </form>

            <div class="auth-footer">
                Belum punya akun? <a href="register.php">Daftar sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>
