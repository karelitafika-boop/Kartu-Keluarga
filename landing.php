<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $kkQuery = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE id_kk='$id'");
} else {
    $kkQuery = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga ORDER BY id_kk DESC LIMIT 1");
}

$kk = mysqli_fetch_assoc($kkQuery);

if (!$kk) {
    echo "Belum ada data Kartu Keluarga.";
    exit;
}

$id = $kk['id_kk'];

$data = mysqli_query($koneksi, "SELECT * FROM anggota_keluarga WHERE id_kk='$id'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Hasil KK</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-title">Kartu Keluarga</div>
    <div class="nav-menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="form.php">Input Data</a>
        <a href="landing.php">Data KK</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="content">

<h2>KARTU KELUARGA</h2>

<p>No KK: <?= $kk['no_kk']; ?></p>
<p>Nama: <?= $kk['nama_kepala_keluarga']; ?></p>
<p>Alamat: <?= $kk['alamat']; ?></p>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIK</th>
        <th>JK</th>
        <th>Hubungan</th>
    </tr>

    <?php $no = 1; while($a = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $a['nama']; ?></td>
        <td><?= $a['nik']; ?></td>
        <td><?= $a['jenis_kelamin']; ?></td>
        <td><?= $a['hubungan']; ?></td>
    </tr>
    <?php } ?>
</table>

</div>

</body>
</html>