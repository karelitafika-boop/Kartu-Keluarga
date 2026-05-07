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

/* ambil data anggota */
$anggota = mysqli_query($koneksi, "SELECT * FROM anggota_keluarga WHERE id_kk='$id'");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit KK</title>
    

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

        .card-form {
            max-width: 600px;
            margin: auto;
            margin-top: 80px;
            padding: 30px;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        h2 {
            font-weight: 700;
            margin-bottom: 25px;
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(255,107,53,0.25);
            border-color: #ff6b35;
        }

        .btn-primary {
            background: #ff6b35;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background: #e65a28;
        }

        .btn-secondary {
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-group-custom {
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card-form">

        <h2>Edit Data Kartu Keluarga</h2>

        <!-- FORM -->
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
                <textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat']; ?></textarea>
            </div>

            <!-- 🔥 DATA ANGGOTA -->
            <h5 style="margin-top:30px;">Data Anggota Keluarga</h5>

            <table class="table">
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Hubungan</th>
                    <th>Aksi</th>
                </tr>

                <?php while($a = mysqli_fetch_assoc($anggota)) { ?>
                <tr>

                    <td>
                        <input type="text" name="nik[]" value="<?= $a['nik']; ?>" class="form-control">
                    </td>

                    <td>
                        <input type="text" name="nama_anggota[]" value="<?= $a['nama']; ?>" class="form-control">
                    </td>

                    <td>
                        <input type="text" name="hubungan[]" value="<?= $a['hubungan']; ?>" class="form-control">
                    </td>

                    <td>
                        <a href="hapus_anggota.php?id=<?= $a['id_anggota']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus anggota ini?')">
                           Hapus
                        </a>
                    </td>

                    <input type="hidden" name="id_anggota[]" value="<?= $a['id_anggota']; ?>">

                </tr>
                <?php } ?>

            </table>

            <div class="btn-group-custom">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="tampil_kk.php" class="btn btn-secondary">Kembali</a>
            </div>

        </form>

    </div>
</div>

</body>
</html>