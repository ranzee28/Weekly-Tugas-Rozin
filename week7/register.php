<?php
session_start();

// Jika sudah login, redirect ke beranda
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

require 'fungsi.php';

if (isset($_POST['register'])) {
    $username = strtolower(stripslashes(mysqli_real_escape_string($koneksi, $_POST['username'])));
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);

    // Cek apakah username sudah ada di database
    $result = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    
    if (mysqli_fetch_assoc($result)) {
        $error_msg = "Username sudah terdaftar! Pilih username lain.";
    } else {
        // Cek kecocokan password
        if ($password !== $confirm_password) {
            $error_msg = "Konfirmasi password tidak sesuai!";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan ke database
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
            if (mysqli_query($koneksi, $query)) {
                echo "<script>
                        alert('Registrasi berhasil! Silakan login.');
                        document.location.href = 'login.php';
                      </script>";
                exit;
            } else {
                $error_msg = "Gagal mendaftarkan user baru: " . mysqli_error($koneksi);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Web RZN</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-body">
    <div class="auth-wrapper">
        <div class="auth-card">
            <h2>Daftar Akun</h2>
            <p class="subtitle">Buat akun Anda untuk mengakses fitur web.</p>

            <?php if (isset($error_msg)) : ?>
                <div class="auth-alert">
                    <?= $error_msg; ?>
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
                <div class="auth-group">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                <button type="submit" name="register" class="auth-btn">Daftar</button>
            </form>

            <div class="auth-footer">
                Sudah punya akun? <a href="login.php">Masuk sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>
