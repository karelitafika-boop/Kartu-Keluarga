<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.5), transparent 35%),
                linear-gradient(135deg, #67e8f9, #818cf8);
            color: #1e293b;
        }

        .top-bar {
            background: linear-gradient(90deg, #0f172a, #1d4ed8);
            color: white;
            padding: 20px 50px;
            font-size: 23px;
            font-weight: 800;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.25);
        }

        .kk-card {
            max-width: 1150px;
            margin: 42px auto 18px;
            background: rgba(255, 255, 255, 0.94);
            border-radius: 26px;
            padding: 34px;
            box-shadow: 0 22px 50px rgba(15, 23, 42, 0.25);
            border: 1px solid rgba(255,255,255,0.7);
        }

        .kk-header {
            display: grid;
            grid-template-columns: 170px 1fr 190px;
            align-items: center;
            gap: 20px;
            padding-bottom: 25px;
            margin-bottom: 28px;
            border-bottom: 4px solid transparent;
            border-image: linear-gradient(90deg, #2563eb, #06b6d4) 1;
        }

        .logo-left,
        .logo-right {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-left img {
            max-width: 200px;
        }

        .logo-right img {
            max-width: 240px;
        }

        .judul-kk {
            text-align: center;
        }

        .judul-kk h1 {
            font-size: 50px;
            font-weight: 900;
            letter-spacing: 5px;
            margin: 0;
            color: #0f172a;
        }

        .judul-kk p {
            margin: 8px 0 0;
            font-weight: 700;
            font-size: 15px;
            color: #334155;
        }

        .info-box {
            background: linear-gradient(135deg, #fff7cc, #fffbe8);
            border: 1px solid #facc15;
            border-radius: 18px;
            padding: 22px 26px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(250, 204, 21, 0.18);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 12px 18px;
            font-size: 17px;
        }

        .label {
            font-weight: 800;
            color: #0f172a;
        }

        .value {
            color: #334155;
            border-bottom: 1px dashed #d6b94c;
            padding-bottom: 8px;
        }

        .section-title {
            background: linear-gradient(90deg, #0f172a, #1d4ed8);
            color: white;
            padding: 15px 20px;
            font-size: 20px;
            font-weight: 800;
            border-radius: 16px 16px 0 0;
            letter-spacing: .3px;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 0 0 16px 16px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        }

        .table {
            margin-bottom: 0;
            background: white;
        }

        .table th {
            background: linear-gradient(90deg, #dbeafe, #cffafe) !important;
            color: #0f172a;
            text-align: center;
            padding: 16px;
            font-size: 15px;
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

        .table tbody tr:hover {
            background: #eff6ff;
        }

        .back-area {
            max-width: 1150px;
            margin: 0 auto 40px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-secondary {
            background: #475569;
            border: none;
            border-radius: 12px;
            padding: 10px 18px;
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.18);
        }

        .btn-secondary:hover {
            background: #334155;
            transform: translateY(-1px);
        }

        @media print {
            .btn, .navbar, .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .card, .container {
                box-shadow: none !important;
                border: none !important;
            }
        }
        @media (max-width: 768px) {
            .top-bar {
                padding: 16px 22px;
                font-size: 18px;
            }

            .kk-card {
                width: 92%;
                padding: 22px;
                margin-top: 28px;
            }

            .kk-header {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .logo-left img {
                max-width: 105px;
            }

            .logo-right img {
                max-width: 125px;
            }

            .judul-kk h1 {
                font-size: 32px;
                letter-spacing: 2px;
            }

            .judul-kk p {
                font-size: 12px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 4px;
                font-size: 15px;
            }

            .value {
                margin-bottom: 10px;
            }

            .back-area {
                width: 92%;
            }
        }
        .print-area {
            max-width: 1150px;
            margin: 10px auto 50px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(90deg, #2563eb, #06b6d4);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.3);
            transition: 0.2s;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.45);
        }

        .btn-print:active {
            transform: scale(0.96);
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
            <img src="assets/garuda.png" alt="Logo Garuda">
        </div>

        <div class="judul-kk">
            <h1>KARTU KELUARGA</h1>
            <p>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</p>
        </div>

        <div class="logo-right">
            <img src="assets/peta.png" alt="Peta Indonesia">
        </div>
    </div>

    <div class="info-box">
        <div class="info-grid">
            <div class="label">No. KK</div>
            <div class="value"><?= $kk['no_kk']; ?></div>

            <div class="label">Kepala Keluarga</div>
            <div class="value"><?= $kk['nama_kepala_keluarga']; ?></div>

            <div class="label">Alamat</div>
            <div class="value"><?= $kk['alamat']; ?></div>
        </div>
    </div>

    <div class="section-title">
        Daftar Anggota Keluarga
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered align-middle">
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

</div>

<div class="print-area no-print">
    <button onclick="window.print()" class="btn-print">
        <i class="bi bi-printer"></i> Cetak / Simpan PDF
    </button>
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