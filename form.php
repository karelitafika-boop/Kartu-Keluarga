<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: landing.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// 🔥 CEK apakah user sudah punya KK
$cek = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE user_id='$user_id'");
$dataKK = mysqli_fetch_assoc($cek);

if ($dataKK) {
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sudah Punya KK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="display:flex;justify-content:center;align-items:center;height:100vh;background:linear-gradient(135deg,#dbeafe,#0f172a);">

<div style="background:white;padding:40px;border-radius:20px;text-align:center;box-shadow:0 20px 40px rgba(0,0,0,0.3);">
    <h3 style="font-weight:800;">Kamu sudah membuat Kartu Keluarga</h3>
    <p>Setiap user hanya bisa membuat 1 KK.</p>

    <a href="tampil_kk.php" style="display:inline-block;margin-top:20px;padding:12px 20px;border-radius:10px;background:linear-gradient(90deg,#2563eb,#06b6d4);color:white;text-decoration:none;font-weight:700;">
        Lihat Data KK
    </a>
</div>

</body>
</html>
<?php
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

    <!-- 🔥 STYLE KAMU TIDAK DIUBAH -->
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

<!-- 🔥 NAVBAR KAMU -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><span class="text-light">KK </span><span class="text-info">Digital</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
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

        <form id="formKK" action="simpan.php" method="POST" enctype="multipart/form-data">
            <h3 class="section-heading">Data Kartu Keluarga</h3>
                
            
            <input type="text" name="no_kk" class="form-control" placeholder="No KK" required>
            <input type="text" name="nama_kepala_keluarga" class="form-control" placeholder="Nama Kepala Keluarga" required>
            <label class="fw-bold mb-2">Upload KK Lama</label>
            <input type="file" name="bukti_kk_lama" class="form-control" accept="image/*,.pdf" required>
            <small class="text-muted">Upload foto / PDF Kartu Keluarga lama.</small>

            <label class="fw-bold mb-2 mt-3">Upload Akta Lahir</label>
            <input type="file" name="bukti_akta_lahir" class="form-control" accept="image/*,.pdf" required>
            <small class="text-muted">Upload akta lahir sebagai bukti data anggota keluarga.</small>

            <label class="fw-bold mb-2 mt-3">Upload Akta Perkawinan</label>
            <input type="file" name="bukti_akta_perkawinan" class="form-control" accept="image/*,.pdf" required>
            <small class="text-muted">Upload akta perkawinan / buku nikah sebagai bukti hubungan keluarga.</small>
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

            <!-- 🔥 BUTTON FINAL -->
            <div class="button-area">

                <button type="button" onclick="tambahAnggota()" class="btn-add">
                    + Tambah Anggota
                </button>

                <div style="display:flex; gap:10px;">

                    <a href="dashboard.php" class="btn-add" style="text-decoration:none; display:flex; align-items:center;">
                        ← Kembali
                    </a>

                    <button type="button" onclick="popup()" class="btn-save">
                        Cetak Data
                    </button>

                </div>

            </div>

        </form>
    </div>
</div>

<!-- POPUP -->
<div id="popup" class="popup">
    <div class="popup-box">
        <h3>Apakah data sudah benar?</h3>
        <div class="popup-actions">
            <button onclick="ulang()" class="btn-repeat">Ulangi</button>
            <button onclick="lanjut()" class="btn-ok">Lanjut</button>
        </div>
    </div>
</div>

<script>
let jumlahAnggota = 1;

function tambahAnggota() {
    jumlahAnggota++;
    let area = document.getElementById("anggota-area");

    let div = document.createElement("div");
    div.className = "anggota-box";

    div.innerHTML = `
        <h4>Anggota ${jumlahAnggota}</h4>
        <input type="text" name="nik[]" class="form-control" placeholder="NIK" required>
        <input type="text" name="nama[]" class="form-control" placeholder="Nama" required>
        <select name="jenis_kelamin[]" class="form-select" required>
            <option value="">Pilih</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <input type="text" name="hubungan[]" class="form-control" placeholder="Hubungan" required>
        <button type="button" onclick="hapusAnggota(this)" class="btn btn-danger mt-2">Hapus</button>
    `;

    area.appendChild(div);
}

function hapusAnggota(btn){
    btn.parentElement.remove();
}

function popup(){
    document.getElementById("popup").style.display="flex";
}
function ulang(){
    document.getElementById("popup").style.display="none";
}
function lanjut(){
    document.getElementById("formKK").submit();
}
</script>

</body>
</html>