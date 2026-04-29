<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if ($_SESSION['role'] == "admin") {
    $query = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga");
} else {
    $user_id = $_SESSION['user_id'];
    $query = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE user_id='$user_id'");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tampil KK</title>
</head>
<body>

<h2>Data Kartu Keluarga</h2>

<?php
if ($_SESSION['role'] == "admin") {
    echo '<a href="dashboard_db.php">Kembali</a>';
} else {
    echo '<a href="dashboard.php">Kembali</a>';
}
?>

<br><br>

<?php if (mysqli_num_rows($query) == 0) { ?>

    <p>Tidak ada data KK.</p>

<?php } else { ?>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>No KK</th>
        <th>Nama Kepala Keluarga</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    while ($kk = mysqli_fetch_assoc($query)) {
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $kk['no_kk']; ?></td>
        <td><?php echo $kk['nama_kepala_keluarga']; ?></td>
        <td><?php echo $kk['alamat']; ?></td>
        <td>
            <a