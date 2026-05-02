<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username'])){
    header("Location: login_users.php");
    exit;
}

$jml = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as total FROM kartu_keluarga"));
$jml_anggota = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM anggota_keluarga"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard KK Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            background: #e0f2fe;
            color: #0f172a;
        }

        .navbar {
            background: linear-gradient(90deg, #0f172a, #1d4ed8);
            padding: 14px 42px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.25);
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .nav-link {
            margin: 0 6px;
            border-radius: 10px;
            padding: 8px 14px !important;
            transition: 0.3s;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.18);
            transform: translateY(-1px);
        }

        .hero {
            min-height: 700px;
            background: url(assets/keluarga.png) center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 100px;
            padding-right: 40px;
        }

        .hero-box {
            background: rgba(15, 23, 42, 0.72);
            padding: 36px;
            border-radius: 24px;
            max-width: 580px;
            color: white;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.35);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.25);
        }

        .hero-box h2 {
            font-size: 36px;
            font-weight: 900;
            line-height: 1.3;
            margin-bottom: 16px;
        }

        .hero-box h2 span {
            color: #38bdf8;
        }

        .hero-box p {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 22px;
            color: #e2e8f0;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-main {
            background: linear-gradient(90deg, #2563eb, #06b6d4);
            color: white;
            border: none;
            border-radius: 13px;
            padding: 11px 20px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.22);
            transition: 0.3s;
        }

        .btn-main:hover {
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.32);
        }

        .btn-outline-custom {
            background: rgba(255,255,255,0.9);
            color: #1d4ed8;
            border: none;
            border-radius: 13px;
            padding: 11px 20px;
            font-weight: 800;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-outline-custom:hover {
            background: white;
            color: #0f172a;
            transform: translateY(-3px);
        }

        .admin-login {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: linear-gradient(90deg, #0f172a, #1d4ed8);
            color: white;
            padding: 12px 22px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.35);
            z-index: 999;
            transition: 0.3s;
        }

        .admin-login:hover {
            color: white;
            background: linear-gradient(90deg, #1e293b, #2563eb);
            transform: translateY(-3px);
        }

        .section-blue {
            background: linear-gradient(90deg, #0f172a, #1d4ed8);
            padding: 65px 20px;
        }

        .section-blue.second {
            padding-top: 30px;
        }

        .section-title {
            color: white;
            font-weight: 900;
            margin-bottom: 35px;
            text-shadow: 0 4px 12px rgba(15, 23, 42, 0.25);
        }

        .custom-card {
            width: 310px;
            border: none;
            border-radius: 22px;
            overflow: hidden;
            background: rgba(255,255,255,0.96);
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.18);
            transition: 0.3s;
        }

        .custom-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 45px rgba(15, 23, 42, 0.25);
        }

        .custom-card .card-body {
            padding: 30px 24px;
        }

        .custom-card h5 {
            color: #1d4ed8;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .custom-card h2 {
            color: #0f172a;
            font-size: 44px;
            font-weight: 900;
            margin: 0;
        }

        .custom-card p {
            color: #475569;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 0;
        }

        footer {
            background: #0f172a !important;
            padding-top: 45px !important;
        }

        footer h5 {
            font-weight: 800;
            margin-bottom: 16px;
        }

        footer p {
            color: #94a3b8 !important;
            font-size: 14px;
            line-height: 1.7;
        }

        footer hr {
            border-color: rgba(255,255,255,0.2);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 12px 18px;
            }

            .hero {
                min-height: 620px;
                padding: 30px 20px;
                justify-content: center;
                text-align: center;
            }

            .hero-box {
                padding: 25px;
            }

            .hero-box h2 {
                font-size: 28px;
            }

            .hero-actions {
                justify-content: center;
            }

            .section-blue {
                padding: 48px 16px;
            }

            .admin-login {
                bottom: 18px;
                right: 18px;
                padding: 10px 18px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <span class="text-light">KK </span><span class="text-info">Digital</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-3">
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="form.php">Input Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="tampil_kk.php">Tampil KK Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<a href="login_db.php" class="admin-login">Admin</a>

<div class="hero">
    <div class="hero-box">
        <h2>Sistem Pendataan <br><span>Kartu Keluarga Digital</span></h2>
        <p>
            Sistem Pendataan Kartu Keluarga Digital merupakan platform berbasis web
            untuk mempermudah proses pendataan keluarga secara cepat dan praktis.
        </p>

        <div class="hero-actions">
            <a href="form.php" class="btn-main">Input Data</a>
            <a href="tampil_kk.php" class="btn-outline-custom">Tampil KK Saya</a>
        </div>
    </div>
</div>

<section class="section-blue text-center">
    <h3 class="section-title">Data Kartu Keluarga</h3>

    <div class="d-flex gap-4 justify-content-center flex-wrap">
        <div class="card custom-card">
            <div class="card-body">
                <h5>Total Data Kartu Keluarga</h5>
                <h2><?= $jml['total']; ?></h2>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-body">
                <h5>Total Anggota Keluarga</h5>
                <h2><?= $jml_anggota['total']; ?></h2>
            </div>
        </div>
    </div>
</section>

<section class="section-blue second text-center">
    <h3 class="section-title">Tahap Pengajuan Pendaftaran Kartu Keluarga</h3>

    <div class="d-flex gap-4 justify-content-center flex-wrap">
        <div class="card custom-card">
            <div class="card-body">
                <h5>Data Kepala Keluarga</h5>
                <p>Inputkan No. Kartu Keluarga, nama kepala keluarga, dan alamat pada form.</p>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-body">
                <h5>Data Anggota</h5>
                <p>Input data anggota keluarga berupa NIK, nama, jenis kelamin, dan hubungan keluarga.</p>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-body">
                <h5>Simpan Data</h5>
                <p>Cek kembali data yang sudah diisi, kemudian klik tombol simpan.</p>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-white mt-0 p-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5><span class="text-light">KK </span><span class="text-info">Digital</span></h5>
                <p>Sistem Pendataan Kartu Keluarga Digital merupakan platform berbasis web untuk mempermudah proses pendataan keluarga secara cepat dan praktis.</p>
            </div>

            <div class="col-md-4 mb-3">
                <h5>Menu</h5>
                <p>Dashboard</p>
                <p>Input Data</p>
                <p>Tampil KK Saya</p>
                <p>Kontak</p>
            </div>

            <div class="col-md-4 mb-3">
                <h5>Kontak</h5>
                <p>Jl. Babarsari, Kec. Depok, Kab. Sleman, Daerah Istimewa Yogyakarta.</p>
                <p>0821-3489-4509</p>
                <p>keluargadigital@gmail.com</p>
            </div>
        </div>

        <hr>

        <p class="text-center mb-0">&copy; 2026 KartuKeluarga Digital, All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>