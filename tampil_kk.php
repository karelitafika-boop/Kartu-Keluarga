<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: login_users.php");
    exit;
}

$role = $_SESSION['role'];

if ($role == "admin") {
    $data = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga");
} else {
    $user_id = $_SESSION['id_user'];
    $data = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE user_id='$user_id'");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data KK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
    * {
        font-family: 'Poppins', sans-serif;
        color: white;
    }

    body {
        margin: 0;
        min-height: 100vh;
        background: linear-gradient(135deg, #0f172a, #1e3a8a);
        display: flex;
        justify-content: center;
    }

    .container {
        margin-top: 50px;
        max-width: 1100px;
    }

    .glass-card {
        background: rgba(255,255,255,0.08);
        border-radius: 25px;
        padding: 30px;
        backdrop-filter: blur(12px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        border: 1px solid rgba(255,255,255,0.15);
    }

    h2 {
        font-weight: 800;
        text-align: center;
        margin-bottom: 25px;
    }

    .btn {
        border-radius: 12px;
        font-weight: 600;
        border: none;
    }

    .btn-primary { background: linear-gradient(90deg, #3b82f6, #06b6d4); }
    .btn-secondary { background: rgba(255,255,255,0.15); }
    .btn-warning { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .btn-danger { background: linear-gradient(90deg, #ef4444, #dc2626); }
    .btn-success { background: linear-gradient(90deg, #22c55e, #16a34a); }
    .btn-info { background: linear-gradient(90deg, #0ea5e9, #38bdf8); }

    .table {
        color: white;
        border-radius: 15px;
        overflow: hidden;
    }

    .table thead {
    background: linear-gradient(90deg, #3b82f6, #06b6d4);
    }

    .table thead th {
        color: white;
        background: linear-gradient(90deg, #142b4e, rgb(4, 18, 46));
    }

    .table tbody tr {
        background: rgba(255,255,255,0.05);
        transition: 0.2s;
    }

    .table tbody tr:hover {
        background: rgba(255,255,255,0.12);
    }

    .badge {
        padding: 6px 10px;
        border-radius: 8px;
    }

    .alert {
        background: rgba(255,255,255,0.1);
        border-radius: 15px;
    }

    textarea.form-control {
        border-radius: 10px;
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
    }
    </style>
</head>

<body>

<div class="container">
<div class="glass-card">

    <?php if ($role == "admin") { ?>
    <a href="login_users.php" class="btn btn-secondary mb-3">← Kembali</a>
    <?php } else { ?>
        <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>
    <?php } ?>

    <h2>Data Kartu Keluarga</h2>

    <?php if (mysqli_num_rows($data) == 0) { ?>

        <?php if ($role == "user") { ?>
            <div class="alert">
                Kamu belum membuat KK.
                <br><br>
                <a href="form.php" class="btn btn-primary">Input KK</a>
            </div>
        <?php } else { ?>
            <div class="alert">Belum ada data KK.</div>
        <?php } ?>

    <?php } else { ?>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>No KK</th>
                    <th>Kepala Keluarga</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Bukti Upload</th>
                    <th>Komentar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $no = 1;
            while ($d = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $d['no_kk']; ?></td>
                <td><?= $d['nama_kepala_keluarga']; ?></td>
                <td><?= $d['alamat']; ?></td>

                <td class="text-center">
                    <?php if ($d['status'] == 'menunggu') { ?>
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    <?php } elseif ($d['status'] == 'disetujui') { ?>
                        <span class="badge bg-success">Disetujui</span>
                    <?php } elseif ($d['status'] == 'ditolak') { ?>
                        <span class="badge bg-danger">Ditolak</span>
                    <?php } else { ?>
                        <span class="badge bg-info text-dark">Perubahan</span>
                    <?php } ?>
                </td>

                <td class="text-center">
                    <?php if ($d['bukti_kk_lama']) { ?>
                        <a href="uploads/<?= $d['bukti_kk_lama']; ?>" target="_blank" class="btn btn-sm btn-primary mb-1">KK Lama</a>
                    <?php } ?>
                    <?php if ($d['bukti_akta_lahir']) { ?>
                        <a href="uploads/<?= $d['bukti_akta_lahir']; ?>" target="_blank" class="btn btn-sm btn-success mb-1">Akta Lahir</a>
                    <?php } ?>
                    <?php if ($d['bukti_akta_perkawinan']) { ?>
                        <a href="uploads/<?= $d['bukti_akta_perkawinan']; ?>" target="_blank" class="btn btn-sm btn-warning mb-1">Akta Kawin</a>
                    <?php } ?>
                </td>

                <td>
                    <b>User:</b><br>
                    <?= $d['komentar_user'] ?: '-' ?><br><br>
                    <b>Admin:</b><br>
                    <?= $d['komentar_admin'] ?: '-' ?>
                </td>

                <td class="text-center">

                    <?php if ($d['status'] == 'disetujui') { ?>
                        <a href="landing.php?id=<?= $d['id_kk']; ?>" class="btn btn-info btn-sm mb-1">
                            Detail / Cetak
                        </a>
                    <?php } else { ?>
                        <button class="btn btn-secondary btn-sm mb-1" disabled>
                            Belum Bisa Cetak
                        </button>
                    <?php } ?>

                    <?php if ($role == "admin") { ?>
                        <br>

                        <a href="edit_kk.php?id=<?= $d['id_kk']; ?>" class="btn btn-warning btn-sm mb-1">
                            Edit
                        </a>

                        <a href="hapus_kk.php?id=<?= $d['id_kk']; ?>"
                           class="btn btn-danger btn-sm mb-1"
                           onclick="return confirm('Yakin ingin hapus data ini?')">
                           Hapus
                        </a>

                        <?php if ($d['status'] != 'disetujui') { ?>
                            <a href="verifikasi_kk.php?id=<?= $d['id_kk']; ?>" class="btn btn-success btn-sm mb-1">
                                Verifikasi
                            </a>
                        <?php } else { ?>
                            <button class="btn btn-success btn-sm mb-1" disabled>
                                Sudah Disetujui
                            </button>
                        <?php } ?>

                    <?php } else { ?>
                        <form action="ajukan_perubahan.php" method="POST" class="mt-2">
                            <input type="hidden" name="id_kk" value="<?= $d['id_kk']; ?>">
                            <textarea name="komentar_user" class="form-control mb-2" placeholder="Alasan perubahan..." required></textarea>
                            <button type="submit" class="btn btn-warning btn-sm"> Keterangan
                            </button>
                        </form>
                    <?php } ?>

                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php } ?>

</div>
</div>

</body>
</html>