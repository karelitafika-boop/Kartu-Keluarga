<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Data KK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.35), transparent 35%),
                linear-gradient(135deg, #dbeafe, #0f172a);
            color: #0f172a;
        }

        .navbar {
            background: linear-gradient(90deg, #0f172a, #1d4ed8);
            padding: 14px 42px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.25);
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 800;
        }

        .nav-link {
            margin: 0 6px;
            border-radius: 10px;
            padding: 8px 14px !important;
            transition: 0.3s;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.18);
            transform: translateY(-1px);
        }

        .form-wrapper {
            max-width: 900px;
            margin: 55px auto;
            padding: 0 18px;
        }

        .form-card {
            background: rgba(255,255,255,0.94);
            border-radius: 26px;
            padding: 36px;
            box-shadow: 0 25px 55px rgba(15, 23, 42, 0.28);
            border: 1px solid rgba(255,255,255,0.6);
            backdrop-filter: blur(8px);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-title h2 {
            font-size: 34px;
            font-weight: 900;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .form-title p {
            color: #64748b;
            margin-bottom: 0;
            font-size: 14px;
        }

        .section-heading {
            font-size: 20px;
            font-weight: 800;
            color: #1d4ed8;
            margin: 24px 0 16px;
            padding-bottom: 10px;
            border-bottom: 2px solid #dbeafe;
        }

        .form-control,
        .form-select {
            border-radius: 13px;
            padding: 13px 15px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
            margin-bottom: 14px;
            background-color: #f8fafc;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
            background-color: white;
        }

        textarea.form-control {
            min-height: 95px;
            resize: vertical;
        }

        .anggota-box {
            background: linear-gradient(135deg, #f8fafc, #eff6ff);
            padding: 22px;
            border-radius: 20px;
            margin-bottom: 18px;
            border: 1px solid #dbeafe;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        }

        .anggota-box h4 {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 16px;
        }

        .button-area {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 22px;
            flex-wrap: wrap;
        }

        .btn-add {
            background: #475569;
            color: white;
            padding: 12px 18px;
            border: none;
            border-radius: 13px;
            font-weight: 800;
            transition: 0.3s;
        }

        .btn-add:hover {
            background: #334155;
            transform: translateY(-2px);
        }

        .btn-save {
            background: linear-gradient(90deg, #2563eb, #06b6d4);
            color: white;
            padding: 12px 22px;
            border: none;
            border-radius: 13px;
            font-weight: 800;
            transition: 0.3s;
            box-shadow: 0 10px 22px rgba(37, 99, 235, 0.28);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(37, 99, 235, 0.36);
        }

        .popup {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 18px;
        }

        .popup-box {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 24px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 25px 55px rgba(0,0,0,0.35);
        }

        .popup-box h3 {
            font-size: 24px;
            font-weight: 900;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .popup-box p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .popup-actions {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .btn-repeat {
            background: #64748b;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 18px;
            font-weight: 800;
        }

        .btn-ok {
            background: linear-gradient(90deg, #2563eb, #06b6d4);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 22px;
            font-weight: 800;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 12px 18px;
            }

            .form-wrapper {
                margin: 32px auto;
            }

            .form-card {
                padding: 24px;
            }

            .form-title h2 {
                font-size: 26px;
            }

            .button-area {
                flex-direction: column;
            }

            .btn-add,
            .btn-save {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <span class="text-light">KK </span><span class="text-info">Digital</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-3">
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="form.php">Input Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="tampil_kk.php">Data KK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="login_db.php">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="form-wrapper">
    <div class="form-card">
        <div class="form-title">
            <h2>Input Data Kartu Keluarga</h2>
            <p>Lengkapi data kartu keluarga dan anggota keluarga dengan benar.</p>
        </div>

        <form id="formKK" action="simpan.php" method="POST">
            <h3 class="section-heading">Data Kartu Keluarga</h3>

            <input type="text" name="no_kk" class="form-control" placeholder="No KK" required>
            <input type="text" name="nama_kepala_keluarga" class="form-control" placeholder="Nama Kepala Keluarga" required>
            <textarea name="alamat" class="form-control" placeholder="Alamat" required></textarea>

            <h3 class="section-heading">Anggota Keluarga</h3>

            <div id="anggota-area">
                <div class="anggota-box">
                    <h4>Anggota 1</h4>

                    <input type="text" name="nik[]" class="form-control" placeholder="NIK" required>
                    <input type="text" name="nama[]" class="form-control" placeholder="Nama" required>

                    <select name="jenis_kelamin[]" class="form-select" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    <input type="text" name="hubungan[]" class="form-control" placeholder="Hubungan" required>
                </div>
            </div>

            <div class="button-area">
                <button type="button" onclick="tambahAnggota()" class="btn-add">
                    + Tambah Anggota
                </button>

                <button type="button" onclick="popup()" class="btn-save">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<div id="popup" class="popup">
    <div class="popup-box">
        <h3>Apakah data sudah benar?</h3>
        <p>Kalau masih ada yang salah, klik Ulangi untuk kembali mengoreksi data.</p>

        <div class="popup-actions">
            <button type="button" onclick="ulang()" class="btn-repeat">Ulangi</button>
            <button type="button" onclick="lanjut()" class="btn-ok">OK</button>
        </div>
    </div>
</div>

<script>
let jumlahAnggota = 1;

function tambahAnggota() {
    jumlahAnggota++;

    let area = document.getElementById("anggota-area");

    let anggotaBaru = document.createElement("div");
    anggotaBaru.className = "anggota-box";

    anggotaBaru.innerHTML = `
        <h4>Anggota ${jumlahAnggota}</h4>

        <input type="text" name="nik[]" class="form-control" placeholder="NIK" required>
        <input type="text" name="nama[]" class="form-control" placeholder="Nama" required>

        <select name="jenis_kelamin[]" class="form-select" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <input type="text" name="hubungan[]" class="form-control" placeholder="Hubungan" required>
    `;

    area.appendChild(anggotaBaru);
}

function popup() {
    let form = document.getElementById("formKK");

    if (form.checkValidity()) {
        document.getElementById("popup").style.display = "flex";
    } else {
        alert("Masih ada data yang belum diisi.");
        form.reportValidity();
    }
}

function ulang() {
    document.getElementById("popup").style.display = "none";
}

function lanjut() {
    document.getElementById("formKK").submit();
}
</script>

</body>
</html>