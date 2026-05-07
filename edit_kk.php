<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login_db.php");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    echo "Akses ditolak. Silakan login sebagai admin.";
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE id_kk='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data KK tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit KK</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Data Kartu Keluarga</h2>
    <form action="update_kk.php" method="POST">
        <input type="hidden" name="id_kk" value="<?= $data['id_kk']; ?>">
        <div class="mb-3">
            <label>No KK</label>
            <input type="text" name="no_kk" class="form-control" value="<?= $data['no_kk']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Nama Kepala Keluarga</label>
            <input type="text" name="nama_kepala_keluarga" class="form-control" value="<?= $data['nama_kepala_keluarga']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="tampil_kk.php" class="btn btn-secondary">Kembali</a>
    </form>
    
</div>

</body>
</html>