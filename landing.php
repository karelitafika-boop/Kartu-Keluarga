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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Keluarga</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        min-height: 100vh;
        margin: 0;
        background:
            radial-gradient(circle at top left, rgba(255,255,255,0.65), transparent 35%),
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
        letter-spacing: .3px;
    }

    .kk-card {
        max-width: 1150px;
        margin: 42px auto 18px;
        background: rgba(255,255,255,0.96);
        border-radius: 30px;
        padding: 38px;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.28);
        border: 1px solid rgba(255,255,255,0.75);
    }

    .kk-header {
        display: grid;
        grid-template-columns: 170px 1fr 190px;
        align-items: center;
        gap: 20px;
        padding-bottom: 26px;
        margin-bottom: 30px;
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
        max-width: 135px;
    }

    .logo-right img {
        max-width: 180px;
    }

    .judul-kk {
        text-align: center;
    }

    .judul-kk h1 {
        font-size: 50px;
        font-weight: 900;
        letter-spacing: 6px;
        margin: 0;
        color: #0f172a;
    }

    .judul-kk p {
        margin: 9px 0 0;
        font-weight: 700;
        font-size: 15px;
        color: #334155;
    }

    .info-box {
        background: linear-gradient(135deg, #fff7cc, #fffbea);
        border: 1px solid #facc15;
        border-radius: 20px;
        padding: 24px 28px;
        margin-bottom: 32px;
        box-shadow: 0 10px 25px rgba(250, 204, 21, 0.18);
    }

    .info-grid {
        display: grid;
        grid-template-columns: 230px 1fr;
        gap: 14px 20px;
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
        padding: 16px 22px;
        font-size: 20px;
        font-weight: 800;
        border-radius: 18px 18px 0 0;
    }

    .table-wrapper {
        overflow-x: auto;
        border-radius: 0 0 18px 18px;
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

    .print-area,
    .back-area {
        max-width: 1150px;
        margin: 14px auto;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-print {
        background: linear-gradient(90deg, #2563eb, #06b6d4);
        color: white;
        border: none;
        border-radius: 14px;
        padding: 11px 22px;
        font-weight: 800;
        box-shadow: 0 10px 22px rgba(37, 99, 235, 0.32);
        transition: .3s;
    }

    .btn-print:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(37, 99, 235, 0.42);
    }

    .btn-secondary {
        background: #475569;
        border: none;
        border-radius: 14px;
        padding: 11px 22px;
        font-weight: 800;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.18);
        transition: .3s;
    }

    .btn-secondary:hover {
        background: #334155;
        transform: translateY(-2px);
    }

    @media print {

        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            background: white !important;
            color: black !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .top-bar,
        .no-print,
        .back-area,
        .print-area,
        .btn-kembali {
            display: none !important;
        }

        .kk-card {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 20px !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            border: 2px solid #1e293b !important;

            background:
                linear-gradient(
                    rgba(255,255,255,0.92),
                    rgba(255,255,255,0.92)
                ),
                url(assets/peta.png);

            background-repeat: no-repeat;
            background-position: center center;
            background-size: 520px;
            position: relative !important;
            overflow: hidden !important;
        }

        .kk-header,
        .info-box,
        .section-title,
        .table-wrapper {
            position: relative !important;
            z-index: 2 !important;
        }

        .kk-header {
            display: grid !important;
            grid-template-columns: 110px 1fr 130px !important;
            gap: 10px !important;
            padding-bottom: 16px !important;
            margin-bottom: 18px !important;
            border-bottom: 3px double #1d4ed8 !important;
        }

        .logo-left img {
            width: 80px !important;
        }

        .logo-right img {
            width: 120px !important;
        }

        .judul-kk h1 {
            font-size: 32px !important;
            letter-spacing: 5px !important;
            color: #0f172a !important;
            margin: 0 !important;
        }

        .judul-kk p {
            font-size: 11px !important;
            color: #1e293b !important;
            margin-top: 5px !important;
        }

        .info-box {
            background: rgba(255, 248, 220, 0.90) !important;
            border: 1.5px solid #ca8a04 !important;
            box-shadow: none !important;
            border-radius: 10px !important;
            padding: 14px 18px !important;
            margin-bottom: 18px !important;
        }

        .info-grid {
            grid-template-columns: 150px 1fr !important;
            gap: 8px 14px !important;
            font-size: 12px !important;
        }

        .label {
            font-weight: 800 !important;
            color: #111827 !important;
        }

        .value {
            border-bottom: 1px dotted #64748b !important;
            padding-bottom: 4px !important;
            color: #111827 !important;
        }

        .section-title {
            background: linear-gradient(90deg, #0f172a, #1d4ed8) !important;
            color: white !important;
            padding: 10px 14px !important;
            font-size: 13px !important;
            border-radius: 6px 6px 0 0 !important;
            margin-bottom: 0 !important;
        }

        .table-wrapper {
            box-shadow: none !important;
            border-radius: 0 !important;
            overflow: visible !important;
        }

        .table {
            width: 100% !important;
            border-collapse: collapse !important;
            background: rgba(255,255,255,0.88) !important;
        }

        .table th {
            background: #dbeafe !important;
            color: #0f172a !important;
            font-size: 11px !important;
            padding: 8px !important;
            border: 1px solid #64748b !important;
            text-align: center !important;
        }

        .table td {
            font-size: 10.5px !important;
            padding: 8px !important;
            border: 1px solid #94a3b8 !important;
            color: #111827 !important;
            text-align: center !important;
        }

        img {
            max-width: 100% !important;
            height: auto !important;
        }
    }
</style>

</head>
<body>

<div class="top-bar">Sistem Informasi Kartu Keluarga</div>
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
        <a href="dashboard.php" class="btn btn-secondary btn-kembali">← Kembali</a>
    <?php } ?>
</div>

</body>
</html>