<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$hapusAnggota = mysqli_query($koneksi, "DELETE FROM anggota_keluarga WHERE id_kk='$id'");

if (!$hapusAnggota) {
    die("Gagal hapus anggota: " . mysqli_error($koneksi));
}

$hapusKK = mysqli_query($koneksi, "DELETE FROM kartu_keluarga WHERE id_kk='$id'");

if (!$hapusKK) {
    die("Gagal hapus KK: " . mysqli_error($koneksi));
}

header("Location: tampil_kk.php");
exit;
?>