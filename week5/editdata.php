<?php
    // 1. Koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "cobaweekly");

    if (!$koneksi) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }

    // 2. Ambil ID mahasiswa yang ingin diedit dari URL
    $id_mahasiswa = $_GET['id'];

    // 3. Ambil data mahasiswa yang bersangkutan dari database untuk ditampilkan di form
    $query_select = "SELECT * FROM mahasiswa WHERE id = $id_mahasiswa";
    $result = mysqli_query($koneksi, $query_select);
    $mhs = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan, tendang kembali ke halaman utama
    if (!$mhs) {
        header("Location: data_mahasiswa.php");
        exit;
    }

    // 4. Cek apakah tombol Ubah Data sudah ditekan
    if (isset($_POST['ubah'])) {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $jurusan = $_POST['jurusan'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];

        // Ambil data foto lama sebagai cadangan jika user tidak mengganti foto
        $fotoLama = $mhs['foto'];

        // Cek apakah user mengupload foto baru
        if ($_FILES['foto']['error'] === 0) {
            $namaFile = $_FILES['foto']['name'];
            $tmpName = $_FILES['foto']['tmp_name'];
            
            // Pindahkan foto baru ke folder images
            move_uploaded_file($tmpName, 'images/' . $namaFile);
            $foto = $namaFile;
        } else {
            // Jika tidak mengupload foto baru, gunakan foto yang sudah ada sebelumnya
            $foto = $fotoLama;
        }

        // 5. Jalankan Query SQL UPDATE untuk memperbarui data di database
        $query_update = "UPDATE mahasiswa SET 
                            nama = '$nama', 
                            nim = '$nim', 
                            jurusan = '$jurusan', 
                            email = '$email', 
                            no_hp = '$no_hp', 
                            foto = '$foto' 
                         WHERE id = $id_mahasiswa";

        if (mysqli_query($koneksi, $query_update)) {
            echo "<script>
                    alert('Data mahasiswa berhasil diperbarui!');
                    document.location.href = 'data_mahasiswa.php';
                  </script>";
        } else {
            echo "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a href="data_mahasiswa.php">
        <button class="btn-kembali">Kembali</button>
    </a>
    <h2>Edit Data Mahasiswa</h2>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <table> 
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>:</td>
                <td><input type="text" id="nama" name="nama" value="<?= $mhs['nama']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="nim">NIM</label></td>   
                <td>:</td>
                <td><input type="text" id="nim" name="nim" value="<?= $mhs['nim']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan / Prodi</label></td>
                <td>:</td>
                <td><input type="text" id="jurusan" name="jurusan" value="<?= $mhs['jurusan']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>:</td>
                <td><input type="email" id="email" name="email" value="<?= $mhs['email']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="no_hp">No HP</label></td>
                <td>:</td>
                <td><input type="text" id="no_hp" name="no_hp" value="<?= $mhs['no_hp']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="foto">Foto Saat Ini</label></td>
                <td>:</td>
                <td>
                    <?php if(!empty($mhs['foto'])) : ?>
                        <img src="images/<?= $mhs['foto']; ?>" width="80" height="80" style="object-fit: cover; display: block; margin-bottom: 5px;">
                    <?php endif; ?>
                    <input type="file" id="foto" name="foto">
                    <p style="font-size: 11px; color: gray; margin: 0;">*Biarkan kosong jika tidak ingin mengubah foto</p>
                </td>
            </tr>
        </table>
        <br>
        <button type="submit" name="ubah" class="btn-kirim">Ubah Data</button>
    </form>
</body>
</html>