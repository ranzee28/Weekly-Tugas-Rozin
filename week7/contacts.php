<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Kontak - Biodata
    </title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <table border="1" cellspacing="0" cellpadding="8">
        <tr>
            <td><a href="index.php">Beranda</a></td>
            <td><a href="profile.php">Profil</a></td>
            <td><a href="contacts.php">Kontak</a></td>
            <td><a href="data_mahasiswa.php">Data Mahasiswa</a></td>
            <td><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?');" style="color: #f63b3b;">Logout</a></td>
        </tr>
    </table>
    <hr>

    <h1>
        KONTAK
    </h1>
    <h3>
        Anda dapat menghubungi saya melalui beberapa platform di bawah ini:
    </h3>
    <div class="social-icons-dark">
        <a href="https://www.linkedin.com/in/ahmadrozinr17/" target="_blank" tittle="Connect LinkedIn">
            <i class="fa-brands fa-linkedin"></i>
        </a>
        <br>
        <a href="#" target="_blank" title="Instagram">
            <i class="fa-brands fa-instagram"></i>
        </a>
    </div>
</body>

</html>