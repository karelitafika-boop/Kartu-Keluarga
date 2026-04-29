<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}
$jml = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as total FROM kartu_keluarga"));
$jml_anggota = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM anggota_keluarga"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>
<body>
  
<nav class="navbar navbar-expand-lg" style="background-color:navy;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#"><span class="text-light">KK </span><span class="text-info">Digital</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="form.php">Input Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="tampil_kk.php">Tampil KK Saya</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light fw-bold" href="#" data-bs-toggle="dropdown">Admin</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="login_db.php">Login Admin</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="text-white text-center d-flex align-items-center justify-content-start"
     style="height: 700px; background: url(assets/keluarga.png) center/cover; padding-left: 100px;">

  <div style="background: rgba(1, 141, 255, 0.55); padding:20px; border-radius:10px; max-width: 550px;">

    <h2 style="font-family:'Poppins'; font-size: 30px; font-weight:bold;">
      Sistem Pendataan <br> Kartu Keluarga Digital
    </h2>

    <p style="font-family:'Poppins'; font-size: 15px; line-height: 1.7;">
      Sistem Pendataan Kartu Keluarga Digital merupakan platform berbasis web
      untuk mempermudah proses pendataan keluarga secara cepat dan praktis.
    </p>

    <a href="form.php" class="btn btn-light">Input Data</a>
    <a href="tampil_kk.php" class="btn btn-info text-white">Tampil KK Saya</a>

  </div>
</div>

<section class="container-fluid text-center pt-5 pb-5" style="background-color:lightskyblue">
  <h3 class="fw-bold mb-4" style="color:white;">Data Kartu Keluarga</h3>

  <div class="d-flex gap-3 justify-content-center flex-wrap">
    <div class="card text-center shadow-sm" style="width: 300px;">
      <div class="card-body">
        <h5 style="color:darkblue;">Total Data Kartu Keluarga</h5>
        <h2 style="color:darkblue;"><?= $jml['total']; ?></h2>
      </div>
    </div>
    
    <div class="card text-center shadow-sm" style="width: 300px;">
      <div class="card-body">
        <h5 style="color:darkblue;">Total Anggota Keluarga</h5>
        <h2 style="color:darkblue;"><?= $jml_anggota['total']; ?></h2>
      </div>
    </div>
  </div>
</section>

<section class="container-fluid text-center pt-5 pb-5" style="background-color:lightskyblue">
  <h3 class="fw-bold mb-4" style="color:white;">Tahap Pengajuan Pendaftaran Kartu Keluarga</h3>

  <div class="d-flex gap-3 justify-content-center flex-wrap">
    <div class="card text-center shadow-sm" style="width: 300px;">
      <div class="card-body">
        <h5 style="color:darkblue;">Data Kepala Keluarga</h5>
        <p>Inputkan No.Kartu Keluarga, nama kepala keluarga, dan alamat pada form.</p>
      </div>
    </div>

    <div class="card text-center shadow-sm" style="width: 300px;">
      <div class="card-body">
        <h5 style="color:darkblue;">Data Anggota</h5>
        <p>Input data anggota keluarga berupa NIK, nama, jenis kelamin, dan hubungan. Anggota selanjutnya ditambahkan dengan klik tombol tambah anggota.</p>
      </div>
    </div>

    <div class="card text-center shadow-sm" style="width: 300px;">
      <div class="card-body">
        <h5 style="color:darkblue;">Simpan Data</h5>
        <p>Cek kembali data yang sudah diisi, kemudian klik simpan.</p>
      </div>
    </div>
  </div>
</section>
</body>
</html>