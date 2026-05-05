<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: login_users.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE id_kk='$id'");
$d = mysqli_fetch_assoc($data);

if (isset($_POST['simpan'])) {
    $status = $_POST['status'];
    $komentar_admin = $_POST['komentar_admin'];

    mysqli_query($koneksi, "UPDATE kartu_keluarga SET
        status='$status',
        komentar_admin='$komentar_admin'
        WHERE id_kk='$id'
    ");

    echo "<script>
        alert('Verifikasi berhasil disimpan');
        window.location='tampil_kk.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi KK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4">
        <h3>Verifikasi Data KK</h3>

        <p><b>No KK:</b> <?= $d['no_kk']; ?></p>
        <p><b>Kepala Keluarga:</b> <?= $d['nama_kepala_keluarga']; ?></p>
        <p><b>Alamat:</b> <?= $d['alamat']; ?></p>

        <p>
            <b>Bukti Upload:</b><br>
            <a href="uploads/<?= $d['bukti_upload']; ?>" target="_blank" class="btn btn-primary btn-sm">
                Lihat Bukti
            </a>
        </p>

        <p><b>Komentar User:</b><br>
            <?= !empty($d['komentar_user']) ? $d['komentar_user'] : '-'; ?>
        </p>

        <form method="POST">
            <label>Status Verifikasi</label>
            <select name="status" class="form-select mb-3" required>
                <option value="menunggu" <?= $d['status'] == 'menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                <option value="disetujui" <?= $d['status'] == 'disetujui' ? 'selected' : ''; ?>>Disetujui</option>
                <option value="ditolak" <?= $d['status'] == 'ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                <option value="disetujui" <?= $d['status'] == 'menunggu_perubahan' ? 'selected' : ''; ?>>Setujui Perubahan</option>
            </select>

            <label>Komentar Admin</label>
            <textarea name="komentar_admin" class="form-control mb-3" placeholder="Tulis komentar admin..."><?= $d['komentar_admin']; ?></textarea>

            <button type="submit" name="simpan" class="btn btn-success">Simpan Verifikasi</button>
            <a href="tampil_kk.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

</body>
</html>