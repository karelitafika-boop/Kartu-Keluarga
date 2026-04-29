<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != "admin") {
    header("Location: login_db.php");
    exit;
}

$id = $_POST['id_kk'];
$no = $_POST['no_kk'];
$nama = $_POST['nama_kepala_keluarga'];
$alamat = $_POST['alamat'];

$query = mysqli_query($koneksi, "UPDATE kartu_keluarga SET
    no_kk='$no',
    nama_kepala_keluarga='$nama',
    alamat='$alamat'
    WHERE id_kk='$id'
");

if ($query) {
    header("Location: tampil_kk.php");
    exit;
} else {
    echo "Gagal update data: " . mysqli_error($koneksi);
}
?>