<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }

    require'fungsi.php';
    $mahasiswa = "SELECT * FROM mahasiswa";
    $mahasiswas = tampildata($mahasiswa);

    tampildata($mahasiswa); // Mengambil data dalam wadah 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
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

    <h1>DATA MAHASISWA</h1>
    <a href="inputdata.php">
        <button class="btn-tambah">Tambah Data</button>
    </a>
    <br><br>
    
    <table border="1" cellspacing="0" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach($mahasiswas as $mhs){ // Looping data mahasiswa
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $mhs['nama']; ?></td>
                <td><?= $mhs['nim']; ?></td>
                <td><?= $mhs['jurusan']; ?></td>
                <td><?= $mhs['email']; ?></td>
                <td><?= $mhs['no_hp']; ?></td>
                <td align="center">
                    <?php if (!empty($mhs['foto'])) : ?>
                        <img src="images/<?= $mhs['foto']; ?>" width="100" height="100" style="object-fit: cover;">
                    <?php else : ?>
                        <p style="font-size: 12px; color: gray;">Tidak ada foto</p>
                    <?php endif; ?>
                </td>
                <td align="center">
                    <a href="editdata.php?id=<?= $mhs['id']; ?>" style="text-decoration: none;"><button style="background-color: #007bff; color: white; cursor: pointer; border: none; padding: 5px 10px; margin-right: 5px; border-radius: 4px;">Edit</button>
                    </a>
                    <a href="hapusdata.php?id=<?= $mhs['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="text-decoration: none;"><button style="background-color: red; color: white; cursor: pointer; border: none; padding: 5px 10px; border-radius: 4px;">Hapus</button></a>
                </td>
            </tr>
            <?php } ?>
      </tbody>
    </table>
</body>
</html>