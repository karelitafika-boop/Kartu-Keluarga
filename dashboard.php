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
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="nav-title">Kartu Keluarga</div>
    <div class="nav-menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="form.php">Input Data</a>
        <a href="landing.php">Data KK</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="content">
    <h1>Dashboard</h1>
    <p>Total KK: <b><?= $jml['total']; ?></b></p>
</div>

</body>
</html>