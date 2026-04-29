<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$kk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE id_kk='$id'"));
$anggota = mysqli_query($koneksi, "SELECT * FROM anggota_keluarga WHERE id_kk='$id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil KK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <!-- TOMBOL KEMBALI -->
    <?php if ($_SESSION['role'] == "admin") { ?>
    <a href="tampil_kk.php" class="btn btn-secondary mb-3">← Kembali</a>
<?php } else { ?>
    <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>
<?php } ?>

    <h2 class="fw-bold">KARTU KELUARGA</h2>

    <p><strong>No KK:</strong> <?= $kk['no_kk']; ?></p>
    <p><strong>Nama:</strong> <?= $kk['nama_kepala_keluarga']; ?></p>
    <p><strong>Alamat:</strong> <?= $kk['alamat']; ?></p>

    <table class="table table-bordered mt-3">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>JK</th>
            <th>Hubungan</th>
        </tr>

        <?php
        $no = 1;
        while ($a = mysqli_fetch_assoc($anggota)) {
        ?>
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