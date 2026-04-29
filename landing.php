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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Keluarga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f0d9;
            font-family: Arial, sans-serif;
        }

        .top-bar {
            background: #0b5cad;
            color: white;
            padding: 16px 80px;
            font-size: 26px;
            font-weight: bold;
        }

        .kk-card {
            max-width: 1100px;
            margin: 30px auto 15px;
            background: #fff7d8;
            border: 4px double #3e9ec0;
            border-radius: 18px;
            padding: 25px 35px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.18);
        }

        .kk-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid #3e9ec0;
            padding-bottom: 18px;
            margin-bottom: 25px;
        }

        .logo-left {
            width: 200px;
            text-align: left;
        }

        .logo-left img {
            width: 210px;
        }

        .logo-right {
            width: 230px;
            text-align: right;
        }

        .logo-right img {
            width: 200px;
        }

        .judul-kk {
            flex: 1;
            text-align: center;
        }

        .judul-kk h1 {
            font-size: 52px;
            font-weight: 800;
            letter-spacing: 3px;
            margin: 0;
        }

        .judul-kk p {
            margin: 6px 0 0;
            font-weight: bold;
            font-size: 15px;
        }

        .info-box {
            background: #fff2ad;
            border: 2px solid #d8ad36;
            border-radius: 10px;
            padding: 18px 22px;
            margin-bottom: 25px;
            font-size: 20px;
        }

        .info-box p {
            margin-bottom: 12px;
            border-bottom: 1px dotted #d0b46a;
            padding-bottom: 8px;
        }

        .info-box p:last-child {
            margin-bottom: 0;
        }

        .section-title {
            background: linear-gradient(90deg, #0b86c9, #0b5cad);
            color: white;
            padding: 12px 18px;
            font-size: 21px;
            font-weight: bold;
            border-radius: 4px 4px 0 0;
        }

        table {
            background: white;
            border: 2px solid #3e9ec0;
        }

        th {
            background: #dff3ff !important;
            color: #003b6f;
            text-align: center;
            font-size: 17px;
        }

        td {
            text-align: center;
            vertical-align: middle;
            font-size: 16px;
        }

        .back-area {
            max-width: 1100px;
            margin: 0 auto 35px;
            text-align: right;
        }
    </style>
</head>
<body>

<div class="top-bar">
    Sistem Informasi Kartu Keluarga
</div>

<div class="kk-card">

    <div class="kk-header">
        <div class="logo-left">
            <img src="assets/garuda.png">
        </div>

        <div class="judul-kk">
            <h1>KARTU KELUARGA</h1>
            <p>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</p>
        </div>

        <div class="logo-right">
            <img src="assets/peta.png">
        </div>
    </div>

    <div class="info-box">
        <p><strong>No. KK:</strong> <?= $kk['no_kk']; ?></p>
        <p><strong>Kepala Keluarga:</strong> <?= $kk['nama_kepala_keluarga']; ?></p>
        <p><strong>Alamat:</strong> <?= $kk['alamat']; ?></p>
    </div>

    <div class="section-title">
        Daftar Anggota Keluarga
    </div>

    <table class="table table-bordered mb-0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Jenis Kelamin</th>
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

<div class="back-area">
    <?php if ($_SESSION['role'] == "admin") { ?>
        <a href="tampil_kk.php" class="btn btn-secondary">← Kembali</a>
    <?php } else { ?>
        <a href="dashboard.php" class="btn btn-secondary">← Kembali</a>
    <?php } ?>
</div>

</body>
</html>