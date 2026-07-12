<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }

    require'fungsi.php';

    // Cek apakah tombol Kirim Data sudah ditekan
    if (isset($_POST['kirim'])) { // isset = apakah sudah diklik atau belum
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $jurusan = $_POST['jurusan'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];

        // PROSES UPLOAD FOTO
        $namaFile = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];

        // Cek apakah ada gambar yang diupload
        if ($error === 0) {
            move_uploaded_file($tmpName, 'images/' . $namaFile);
            $foto = $namaFile;
        } else {
            $foto = ''; // Jika tidak upload foto, isi kosong
        }

        // Query SQL untuk memasukkan data
        $query = "INSERT INTO mahasiswa (nama, nim, jurusan, email, no_hp, foto)
                  VALUES ('', '$nama', '$nim', '$jurusan', '$email', '$no_hp', '$foto')";

        if (mysqli_query($koneksi, $query)) { // Logika jika query berhasil
            echo "<script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'data_mahasiswa.php';
                  </script>";
        } else { // Logika jika query gagal
            echo "Gagal menambahkan data: " . mysqli_error($koneksi);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <a href="data_mahasiswa.php">
        <button class="btn-kembali">Kembali</button>
    </a>
    <h2>Input Data Mahasiswa</h2>
    
    <form action="" method="POST" enctype="multipart/form-data"> 
        <table> 
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>:</td>
                <td><input type="text" id="nama" name="nama" required></td>
            </tr>
            <tr>
                <td><label for="nim">NIM</label></td>   
                <td>:</td>
                <td><input type="text" id="nim" name="nim" required></td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan</label></td>
                <td>:</td>
                <td><input type="text" id="jurusan" name="jurusan" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>:</td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="no_hp">No HP</label></td>
                <td>:</td>
                <td><input type="number" id="no_hp" name="no_hp" required></td>
            </tr>
            <tr>
                <td><label for="foto">Foto</label></td>
                <td>:</td>
                <td>
                    <input type="file" id="foto" name="foto">
                    <p style="font-size: 11px; color: gray; margin: 0;">*Biarkan kosong jika tidak ingin upload foto!</p>
                </td>
            </tr>
        </table>
        <button type="submit" name="kirim" class="btn-kirim">Kirim Data</button>
    </form>
</body>

</html>