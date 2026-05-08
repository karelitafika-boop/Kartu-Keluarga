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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f2fe, #1e3a8a);
            min-height: 100vh;
        }

        .card-custom {
            max-width: 850px;
            margin: auto;
            margin-top: 70px;
            border-radius: 25px;
            padding: 35px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        h3 {
            font-weight: 700;
            margin-bottom: 25px;
        }

        .info-box p {
            margin-bottom: 12px;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-block;
        }

        .menunggu { background: #ffc107; color: #000; }
        .disetujui { background: #22c55e; color: #fff; }
        .ditolak { background: #ef4444; color: #fff; }
        .menunggu_perubahan { background: #38bdf8; color: #000; }

        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid #cbd5e1;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }

        .btn-success {
            background: linear-gradient(90deg, #22c55e, #16a34a);
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
        }

        .btn-primary {
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            border: none;
            border-radius: 20px;
        }

        .btn-group-custom {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

    </style>
</head>

<body>

<div class="container">
    <div class="card-custom">

        <h3>Verifikasi Data KK</h3>

        <div class="row">

            <!-- KIRI -->
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
                        <?= ucfirst(str_replace('_',' ',$d['status'])); ?>
                    </span>
                </p>
            </div>

            <!-- KANAN -->
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