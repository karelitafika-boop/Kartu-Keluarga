<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$role = $_SESSION['role'];

if ($role == "admin") {
    $data = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga");
} else {
    $user_id = $_SESSION['user_id'];
    $data = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE user_id='$user_id'");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kartu Keluarga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <a href="dashboard.php" class="btn btn-secondary mb-3">Kembali</a>

    <h2>Data Kartu Keluarga</h2>

    <?php if (mysqli_num_rows($data) == 0) { ?>

        <?php if ($role == "user") { ?>
            <div class="alert alert-warning mt-3">
                <h5>Kamu belum buat KK.</h5>
                <p>Mau buat dulu?</p>
                <a href="form.php" class="btn btn-primary">Input KK</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning mt-3">
                Belum ada data KK.
            </div>
        <?php } ?>

    <?php } else { ?>

        <table class="table table-bordered mt-3">
            <tr>
                <th>No</th>
                <th>No KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;
            while ($d = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['no_kk']; ?></td>
                <td><?= $d['nama_kepala_keluarga']; ?></td>
                <td><?= $d['alamat']; ?></td>
                <td>
                    <a href="landing.php?id=<?= $d['id_kk']; ?>" class="btn btn-info btn-sm text-white">Detail</a>

                    <?php if ($role == "admin") { ?>
                        <a href="edit_kk.php?id=<?= $d['id_kk']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_kk.php?id=<?= $d['id_kk']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin hapus data ini?')">
                           Hapus
                        </a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>

    <?php } ?>

</div>

</body>
</html>