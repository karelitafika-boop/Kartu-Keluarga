<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}

$jml = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as total FROM kartu_keluarga"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">

</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color:navy;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#"><span class="text-info">Kartu</span><span class="text-light">Keluarga</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-light fw-bold" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="form.php">Input Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="landing.php">Data KK</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="text-white text-center d-flex align-items-center justify-content-center" style="height: 300px; background: url('bg.jpg') center/cover;">
<div style="background: rgba(0, 0, 0, 0.41); padding:20px; border-radius:10px;">
    <h2>Sistem Pendataan Kartu Keluarga</h2>
    <p>Kelola data keluarga dengan mudah dan cepat</p>
    <a href="form.php" class="btn btn-primary">Input Data KK</a>
</div>
</div>

<div class="content">
    <h1>Dashboard</h1>
    <p>Total KK: <b><?= $jml['total']; ?></b></p>
</div>

</body>
</html>
