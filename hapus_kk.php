<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != "admin") {
    header("Location: login_users.php");
    exit;
}

$id = $_GET['id'];

/* 🔥 Hapus semua anggota dulu */
$hapusAnggota = mysqli_query($koneksi, "DELETE FROM anggota_keluarga WHERE id_kk='$id'");

if (!$hapusAnggota) {
    die("Gagal hapus anggota: " . mysqli_error($koneksi));
}

/* 🔥 Baru hapus KK */
$hapusKK = mysqli_query($koneksi, "DELETE FROM kartu_keluarga WHERE id_kk='$id'");

if (!$hapusKK) {
    die("Gagal hapus KK: " . mysqli_error($koneksi));
}

/* redirect */
header("Location: tampil_kk.php");
exit;
?>