<?php
    // Koneksi ke database cobaweekly
    $koneksi = mysqli_connect("localhost", "root", "", "cobaweekly");

    // Cek koneksi untuk memastikan tidak ada error
    if (!$koneksi) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }
    
    // Ambil data dari tabel mahasiswa
    $query = "SELECT * FROM mahasiswa";
    $result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - Biodata</title>
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
    <a href="latihan1.php">
        <button class="btn-latihan">Latihan</button>
    </a>
    
    <h3>Berikut adalah data mahasiswa Informatika Universitas Muhammadiyah Semarang:</h3>
    
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
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1; // Variabel penomoran baris tabel
            // Melakukan looping untuk mengambil semua baris data dari database
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
                        <img src="images/<?= $row['foto']; ?>" alt="Foto <?= $row['nama']; ?>" width="100" height="100" style="object-fit: cover;">
                    <?php else : ?>
                        <p style="font-size: 12px; color: gray;">Tidak ada foto</p>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>

    <h3>Latihan Layout</h3>
    <table border="1" cellspacing="0" cellpadding="8">
        <tr>
            <td>1.1</td>
            <td>1.2</td>
            <td>1.3</td>
            <td>1.4</td>
        </tr>
        <tr>
            <td>2.1</td>
            <td colspan="2" rowspan="2" align="center">?</td>
            <td>2.4</td>
        </tr>
        <tr>
            <td>3.1</td>
            <td>3.4</td>
        </tr>
        <tr>
            <td>4.1</td>
            <td>4.2</td>
            <td>4.3</td>
            <td>4.4</td>
        </tr>
    </table>
</body>

</html>