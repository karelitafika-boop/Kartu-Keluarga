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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tampil KK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f0dc;
            font-family: Arial, sans-serif;
        }

        .top-bar {
            background: #0d5cab;
            color: white;
            padding: 18px 40px;
            font-size: 24px;
            font-weight: bold;
        }

        .card-list {
            max-width: 1100px;
            margin: 35px auto;
            background: #fff8dc;
            border: 4px solid #4aa3c7;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .title-box {
            text-align: center;
            border-bottom: 3px solid #4aa3c7;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .title-box h1 {
            font-size: 38px;
            font-weight: bold;
        }

        th {
            background: #dff3ff !important;
            color: #003b6f;
            text-align: center;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="top-bar">
    Sistem Informasi Kartu Keluarga
</div>

<div class="card-list">

    <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="title-box">
        <h1>DATA KARTU KELUARGA</h1>
        <p class="mb-0">Daftar data Kartu Keluarga yang tersimpan</p>
    </div>

    <?php if (mysqli_num_rows($data) == 0) { ?>

        <?php if ($role == "user") { ?>
            <div class="alert alert-warning text-center">
                <h5>Kamu belum buat KK.</h5>
                <p>Mau buat dulu?</p>
                <a href="form.php" class="btn btn-primary">Input KK</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning text-center">
                Belum ada data KK.
            </div>
        <?php } ?>

    <?php } else { ?>

        <table class="table table-bordered table-striped">
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