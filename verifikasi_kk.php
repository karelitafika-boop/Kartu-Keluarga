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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(90deg, #0f172a, #1d4ed8);
            min-height: 100vh;
        }

        .card-custom {
            max-width: 900px;
            margin: auto;
            margin-top: 60px;
            border-radius: 20px;
            padding: 30px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        h3 {
            font-weight: 700;
            margin-bottom: 25px;
        }

        .info-box p {
            margin-bottom: 10px;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .menunggu { background: #ffc107; color: #000; }
        .disetujui { background: #28a745; color: #fff; }
        .ditolak { background: #dc3545; color: #fff; }

        .form-control, .form-select {
            border-radius: 10px;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(255,107,53,0.25);
            border-color: #ff6b35;
        }

        .btn-success {
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-secondary {
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-primary {
            border-radius: 20px;
        }

        .btn-group-custom {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card-custom">

        <h3>Verifikasi Data KK</h3>

        <div class="row">

            <!-- KIRI: DATA -->
            <div class="col-md-6 info-box">
                <p><b>No KK:</b><br><?= $d['no_kk']; ?></p>
                <p><b>Kepala Keluarga:</b><br><?= $d['nama_kepala_keluarga']; ?></p>
                <p><b>Alamat:</b><br><?= $d['alamat']; ?></p>

                <p>
                    <b>Bukti Upload:</b><br>
                    <a href="uploads/<?= $d['bukti_upload']; ?>" target="_blank" class="btn btn-primary btn-sm mt-1">
                        Lihat Bukti
                    </a>
                </p>

                <p><b>Komentar User:</b><br>
                    <?= !empty($d['komentar_user']) ? $d['komentar_user'] : '<i>Tidak ada komentar</i>'; ?>
                </p>

                <p>
                    <b>Status Saat Ini:</b><br>
                    <span class="badge-status <?= $d['status']; ?>">
                        <?= ucfirst($d['status']); ?>
                    </span>
                </p>
            </div>

            <!-- KANAN: FORM -->
            <div class="col-md-6">
                <form method="POST">

                    <label class="mb-1">Status Verifikasi</label>
                    <select name="status" class="form-select mb-3" required>
                        <option value="menunggu" <?= $d['status'] == 'menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                        <option value="disetujui" <?= $d['status'] == 'disetujui' ? 'selected' : ''; ?>>Disetujui</option>
                        <option value="ditolak" <?= $d['status'] == 'ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                        <option value="menunggu_perubahan" <?= $d['status'] == 'menunggu_perubahan' ? 'selected' : ''; ?>>Menunggu Perubahan</option>
                    </select>

                    <label class="mb-1">Komentar Admin</label>
                    <textarea name="komentar_admin" class="form-control mb-3" rows="4"
                        placeholder="Tulis komentar admin..."><?= $d['komentar_admin']; ?></textarea>

                    <div class="btn-group-custom">
                        <button type="submit" name="simpan" class="btn btn-success">
                            Simpan Verifikasi
                        </button>
                        <a href="tampil_kk.php" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>

</body>
</html>