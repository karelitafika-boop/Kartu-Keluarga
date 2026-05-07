<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM anggota_keluarga WHERE id_anggota='$id'");

header("Location: tampil_kk.php");
exit;
?>