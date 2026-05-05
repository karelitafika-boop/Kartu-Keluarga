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
</head>
<body class="bg-light">

<div class="container mt-5">

    <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>

    <h2 class="mb-4">Data Kartu Keluarga</h2>

    <?php if (mysqli_num_rows($data) == 0) { ?>

        <?php if ($role == "user") { ?>
            <div class="alert alert-warning">
                Kamu belum membuat KK.
                <br><br>
                <a href="form.php" class="btn btn-primary">Input KK</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning">Belum ada data KK.</div>
        <?php } ?>

    <?php } else { ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <tr class="table-primary text-center">
                    <th>No</th>
                    <th>No KK</th>
                    <th>Kepala Keluarga</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Bukti Upload</th>
                    <th>Komentar</th>
                    <th>Aksi</th>
                </tr>

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
                            <span class="badge bg-info text-dark">Menunggu Perubahan</span>
                        <?php } ?>
                    </td>

                    <td class="text-center">
                        <?php if (!empty($d['bukti_kk_lama'])) { ?>
                            <a href="uploads/<?= $d['bukti_kk_lama']; ?>" target="_blank" class="btn btn-sm btn-primary mb-1">
                                KK Lama
                            </a>
                        <?php } ?>

                        <?php if (!empty($d['bukti_akta_lahir'])) { ?>
                            <a href="uploads/<?= $d['bukti_akta_lahir']; ?>" target="_blank" class="btn btn-sm btn-success mb-1">
                                Akta Lahir
                            </a>
                        <?php } ?>

                        <?php if (!empty($d['bukti_akta_perkawinan'])) { ?>
                            <a href="uploads/<?= $d['bukti_akta_perkawinan']; ?>" target="_blank" class="btn btn-sm btn-warning mb-1">
                                Akta Perkawinan
                            </a>
                        <?php } ?>
                    </td>

                    <td>
                        <b>User:</b><br>
                        <?= !empty($d['komentar_user']) ? $d['komentar_user'] : '-'; ?>
                        <br><br>
                        <b>Admin:</b><br>
                        <?= !empty($d['komentar_admin']) ? $d['komentar_admin'] : '-'; ?>
                    </td>

                    <td class="text-center">

                        <?php if ($d['status'] == 'disetujui') { ?>
                            <a href="landing.php?id=<?= $d['id_kk']; ?>" class="btn btn-info btn-sm text-white mb-1">
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

                            <a href="verifikasi_kk.php?id=<?= $d['id_kk']; ?>" class="btn btn-success btn-sm mb-1">
                                Verifikasi
                            </a>
                        <?php } else { ?>
                            <form action="ajukan_perubahan.php" method="POST" class="mt-2">
                                <input type="hidden" name="id_kk" value="<?= $d['id_kk']; ?>">
                                <textarea name="komentar_user" class="form-control mb-2" placeholder="Alasan perubahan data..." required></textarea>
                                <button type="submit" class="btn btn-warning btn-sm">
                                    Ajukan Perubahan
                                </button>
                            </form>
                        <?php } ?>

                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>

    <?php } ?>

</div>

</body>
</html>