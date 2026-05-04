<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: landing.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$no = $_POST['no_kk'];
$nama = $_POST['nama_kepala_keluarga'];
$alamat = $_POST['alamat'];

$simpanKK = mysqli_query($koneksi, "INSERT INTO kartu_keluarga 
(user_id, no_kk, nama_kepala_keluarga, alamat)
VALUES
('$user_id', '$no', '$nama', '$alamat')");

if (!$simpanKK) {
    die("Gagal simpan data KK: " . mysqli_error($koneksi));
}

$id = mysqli_insert_id($koneksi);

$nik = $_POST['nik'];
$namaA = $_POST['nama'];
$jk = $_POST['jenis_kelamin'];
$hub = $_POST['hubungan'];

for ($i = 0; $i < count($nik); $i++) {
    $simpanAnggota = mysqli_query($koneksi, "INSERT INTO anggota_keluarga
    (id_kk, nik, nama, jenis_kelamin, hubungan)
    VALUES
    ('$id', '$nik[$i]', '$namaA[$i]', '$jk[$i]', '$hub[$i]')");

    if (!$simpanAnggota) {
        die("Gagal simpan anggota: " . mysqli_error($koneksi));
    }
}

header("Location: landing.php?id=$id");
exit;
?>  