<?php
    // Koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "cobaweekly");

    // Ambil data
    function tampildata($query){
        global $koneksi; // Variabel $koneksi dapat diakses di luar fungsi
        $result = mysqli_query($koneksi, $query);
        $rows = []; // Wadah untuk menyimpan data
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row; // Mengambil data dan memasukkannya ke dalam wadah
        }
        return $rows; // Mengembalikan data
    }
?>