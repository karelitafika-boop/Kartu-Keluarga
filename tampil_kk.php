<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location:landing.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.45), transparent 35%),
                linear-gradient(135deg, #67e8f9, #818cf8);
            margin: 0;
            color: #1e293b;
        }

        .top-bar {
            background: linear-gradient(90deg, #0f172a, #1d4ed8);
            color: white;
            padding: 20px 45px;
            font-size: 23px;
            font-weight: 800;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.25);
        }

        .card-list {
            max-width: 1120px;
            margin: 45px auto;
            background: rgba(255, 255, 255, 0.93);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.25);
            backdrop-filter: blur(10px);
        }

        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 8px 14px;
            border: none;
        }

        .btn-secondary {
            background: #475569;
        }

        .btn-secondary:hover {
            background: #334155;
            transform: translateY(-1px);
        }

        .title-box {
            text-align: center;
            padding-bottom: 22px;
            margin-bottom: 28px;
            border-bottom: 3px solid transparent;
            border-image: linear-gradient(90deg, #2563eb, #06b6d4) 1;
        }

        .title-box h1 {
            font-size: 38px;
            font-weight: 800;
            margin-bottom: 8px;
            color: #0f172a;
            letter-spacing: 1px;
        }

        .title-box p {
            color: #64748b;
            font-size: 15px;
        }

        .table {
            overflow: hidden;
            border-radius: 16px;
            margin-bottom: 0;
            background: white;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        }

        .table th {
            background: linear-gradient(90deg, #dbeafe, #cffafe) !important;
            color: #0f172a;
            text-align: center;
            font-size: 14px;
            padding: 16px;
            border: none;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
            padding: 15px;
            font-size: 14px;
            color: #334155;
            border-color: #e2e8f0;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8fafc;
        }

        .table tbody tr {
            transition: 0.2s ease;
        }

        .table tbody tr:hover {
            background: #eff6ff;
        }

        .btn-info {
            background: #0ea5e9;
        }

        .btn-info:hover {
            background: #0284c7;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
            color: white;
        }

        .btn-danger {
            background: #ef4444;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .alert {
            border: none;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.10);
        }

        .alert-warning {
            background: #fff7ed;
            color: #9a3412;
        }

        @media (max-width: 768px) {
            .top-bar {
                padding: 16px 22px;
                font-size: 18px;
            }

            .card-list {
                width: 92%;
                padding: 22px;
                margin: 28px auto;
            }

            .title-box h1 {
                font-size: 27px;
            }

            .table th,
            .table td {
                padding: 10px;
                font-size: 13px;
            }

            td .btn {
                margin-bottom: 5px;
            }
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

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
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
        </div>

    <?php } ?>

</div>

</body>
</html>