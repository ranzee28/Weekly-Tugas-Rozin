<?php
    // 1. Koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "cobaweekly");

    if (!$koneksi) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }

    // 2. Ambil ID yang dikirim lewat URL
    $id_mahasiswa = $_GET['id'];

    // 3. Jalankan Query SQL DELETE berdasarkan ID tersebut
    $query = "DELETE FROM mahasiswa WHERE id = $id_mahasiswa";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'data_mahasiswa.php';
              </script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
?>