<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_pendataan_kk");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>