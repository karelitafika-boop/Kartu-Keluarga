<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: login_users.php");
    exit;
}

$id_kk = $_POST['id_kk'];
$komentar_user = $_POST['komentar_user'];

mysqli_query($koneksi, "UPDATE kartu_keluarga SET 
komentar_user='$komentar_user',
status='menunggu_perubahan'
WHERE id_kk='$id_kk'");

echo "<script>
    alert('Pengajuan perubahan berhasil dikirim. Menunggu persetujuan admin.');
    window.location='tampil_kk.php';
</script>";
?>