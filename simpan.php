<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != "user") {
    header("Location: login_users.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$no = $_POST['no_kk'];
$nama = $_POST['nama_kepala_keluarga'];
$alamat = $_POST['alamat'];

mysqli_query($koneksi, "INSERT INTO kartu_keluarga 
(user_id, no_kk, nama_kepala_keluarga, alamat)
VALUES
('$user_id', '$no', '$nama', '$alamat')");

$id = mysqli_insert_id($koneksi);

$nik = $_POST['nik'];
$namaA = $_POST['nama'];
$jk = $_POST['jenis_kelamin'];
$hub = $_POST['hubungan'];

for ($i = 0; $i < count($nik); $i++) {
    mysqli_query($koneksi, "INSERT INTO anggota_keluarga
    (id_kk, nik, nama, jenis_kelamin, hubungan)
    VALUES
    ('$id', '$nik[$i]', '$namaA[$i]', '$jk[$i]', '$hub[$i]')");
}

header("Location: landing.php?id=$id");
exit;