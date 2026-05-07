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

/* UPDATE DATA KK */
$query = mysqli_query($koneksi, "UPDATE kartu_keluarga SET
    no_kk='$no',
    nama_kepala_keluarga='$nama',
    alamat='$alamat'
    WHERE id_kk='$id'
");

/* 🔥 TAMBAHAN: UPDATE SEMUA ANGGOTA */
if (isset($_POST['id_anggota'])) {

    $id_anggota = $_POST['id_anggota'];
    $nama_anggota = $_POST['nama_anggota'];
    $hubungan = $_POST['hubungan'];

    for ($i = 0; $i < count($id_anggota); $i++) {

        mysqli_query($koneksi, "UPDATE anggota_keluarga SET
            nama='".$nama_anggota[$i]."',
            hubungan='".$hubungan[$i]."'
            WHERE id_anggota='".$id_anggota[$i]."'
        ");
    }
}

/* REDIRECT */
if ($query) {
    header("Location: tampil_kk.php");
    exit;
} else {
    echo "Gagal update data: " . mysqli_error($koneksi);
}
?>