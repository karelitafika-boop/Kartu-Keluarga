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

$anggota = mysqli_query($koneksi, "SELECT * FROM anggota_keluarga WHERE id_kk='$id'");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit KK</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f2fe, #1e3a8a);
            min-height: 100vh;
        }

        .card-form {
            max-width: 750px;
            margin: auto;
            margin-top: 70px;
            padding: 35px;
            border-radius: 25px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        h2 {
            font-weight: 700;
            margin-bottom: 25px;
        }

        h5 {
            margin-top: 35px;
            font-weight: 600;
            color: #1e3a8a;
        }

        label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 12px;
            padding: 10px;
            border: 1px solid #cbd5e1;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }

        .table th {
           background: linear-gradient(90deg, #142b4e, rgb(4, 18, 46));
            color: white;
            text-align: center;
        }

        .table tbody tr:hover {
            background: #f1f5f9;
        }

        .btn-primary {
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
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

        .btn-danger {
            border-radius: 10px;
        }

        .btn-group-custom {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card-form">
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
                <textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat']; ?></textarea>
            </div>

            <h5>Data Anggota Keluarga</h5>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
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

                        <td class="text-center">
                            <a href="hapus_anggota.php?id=<?= $a['id_anggota']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus anggota ini?')">Hapus
                            </a>
                        </td>

                        <input type="hidden" name="id_anggota[]" value="<?= $a['id_anggota']; ?>">

                    </tr>

                    <?php } ?>

                </table>
            </div>

            <div class="btn-group-custom">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="tampil_kk.php" class="btn btn-secondary">Kembali</a>
            </div>

        </form>

    </div>
</div>

</body>
</html>