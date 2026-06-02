<?php
    // Koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "cobaweekly");

    if (!$koneksi) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }
    
    // Ambil data
    $query = "SELECT * FROM mahasiswa";
    $result = mysqli_query($koneksi, $query);
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
            while ($row = mysqli_fetch_assoc($result)) : 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['nim']; ?></td>
                <td><?= $row['jurusan']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['no_hp']; ?></td>
                <td align="center">
                    <?php if (!empty($row['foto'])) : ?>
                        <img src="images/<?= $row['foto']; ?>" width="100" height="100" style="object-fit: cover;">
                    <?php else : ?>
                        <p style="font-size: 12px; color: gray;">Tidak ada foto</p>
                    <?php endif; ?>
                </td>
                <td align="center">
                    <a href="editdata.php?id=<?= $row['id']; ?>" style="text-decoration: none;"><button style="background-color: #007bff; color: white; cursor: pointer; border: none; padding: 5px 10px; margin-right: 5px; border-radius: 4px;">Edit</button>
                    </a>
                    <a href="hapusdata.php?id=<?= $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="text-decoration: none;"><button style="background-color: red; color: white; cursor: pointer; border: none; padding: 5px 10px; border-radius: 4px;">Hapus</button></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>