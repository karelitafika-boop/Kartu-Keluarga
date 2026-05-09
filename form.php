<?php
session_start();

if (isset($_POST['step']) && $_POST['step'] == 4) {

    $_SESSION['post_data'] = $_POST;

    header("Location: simpan.php");
    exit;
}
if(!isset($_POST['step'])){

    unset($_SESSION['kk_lama']);
    unset($_SESSION['akta_lahir']);
    unset($_SESSION['akta_perkawinan']);

}

$step = isset($_POST['step']) ? $_POST['step'] : 1;
$jumlahAnggota = isset($_POST['jumlah_anggota']) ? $_POST['jumlah_anggota'] : '';

include "koneksi.php";


if($step == 2 && isset($_FILES['bukti_kk_lama'])){

    $folder = "uploads/";

    $kk_lama = time()."_".$_FILES['bukti_kk_lama']['name'];
    move_uploaded_file(
        $_FILES['bukti_kk_lama']['tmp_name'],
        $folder.$kk_lama
    );

    $_SESSION['kk_lama'] = $kk_lama;


    $akta_lahir = time()."_".$_FILES['bukti_akta_lahir']['name'];
    move_uploaded_file(
        $_FILES['bukti_akta_lahir']['tmp_name'],
        $folder.$akta_lahir
    );

    $_SESSION['akta_lahir'] = $akta_lahir;


    $akta_nikah = time()."_".$_FILES['bukti_akta_perkawinan']['name'];
    move_uploaded_file(
        $_FILES['bukti_akta_perkawinan']['tmp_name'],
        $folder.$akta_nikah
    );

    $_SESSION['akta_perkawinan'] = $akta_nikah;
}

include "koneksi.php";

$step = isset($_POST['step']) ? $_POST['step'] : 1;
$jumlahAnggota = isset($_POST['jumlah_anggota']) ? $_POST['jumlah_anggota'] : '';

if (!isset($_SESSION['id_user'])) {
    header("Location: landing.php");
    exit;
}

$user_id = $_SESSION['id_user'];

$cek = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE user_id='$user_id'");
$dataKK = mysqli_fetch_assoc($cek);

if ($dataKK) {
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudah Punya KK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="display:flex;justify-content:center;align-items:center;height:100vh;background:linear-gradient(135deg,#dbeafe,#0f172a);">
    
<div style="background:white;padding:40px;border-radius:20px;text-align:center;box-shadow:0 20px 40px rgba(0,0,0,0.3);">
    <h3 style="font-weight:800;">Kamu sudah membuat Kartu Keluarga</h3>
    <p>Setiap user hanya bisa membuat 1 KK.</p>
    <a href="tampil_kk.php" style="display:inline-block;margin-top:20px;padding:12px 20px;border-radius:10px;background:linear-gradient(90deg,#2563eb,#06b6d4);color:white;text-decoration:none;font-weight:700;">Lihat Data KK</a>
    <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>
    <a href="tampil_kk.php" style="display:inline-block;margin-top:20px;padding:12px 20px;border-radius:10px;background:linear-gradient(90deg,#2563eb,#06b6d4);color:white;text-decoration:none;font-weight:700;">Lihat Data KK</a>
</div>

</body>
</html>

<?php
exit;
}
$jumlahAnggota = isset($_POST['jumlah_anggota']) 
    ? $_POST['jumlah_anggota'] 
    : 1;
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data KK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
    .btn-secondary{
        background: rgba(255,255,255,0.08);
        border-radius: 25px;
        padding: 30px;
        backdrop-filter: blur(12px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        border: 1px solid rgba(255,255,255,0.15);
    }
    .anggota-box {
        background: linear-gradient(135deg, #f8fafc, #eff6ffc0);
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
    position: fixed !important;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    display: flex !important;
    justify-content: center;
    align-items: center;

    z-index: 99999;
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

        <form id="formKK" method="POST" enctype="multipart/form-data">

            <h3 class="section-heading">Data Kartu Keluarga</h3>

            <input type="text"
                   name="no_kk"
                   class="form-control"
                   placeholder="No KK"
                   value="<?= $_POST['no_kk'] ?? '' ?>"
                   required>

            <input type="text"
                   name="nama_kepala_keluarga"
                   class="form-control"
                   placeholder="Nama Kepala Keluarga"
                   value="<?= $_POST['nama_kepala_keluarga'] ?? '' ?>"
                   required>

            <label class="fw-bold mb-2">Upload KK Lama</label>

<?php if(!isset($_SESSION['kk_lama'])) { ?>

    <input type="file"
           name="bukti_kk_lama"
           class="form-control"
           accept="image/*,.pdf"
           required>

<?php } else { ?>

    <input type="text"
           class="form-control"
           value="File KK sudah dipilih"
           readonly>

<?php } ?>

            <label class="fw-bold mb-2 mt-3">Upload Akta Lahir</label>

<?php if(!isset($_SESSION['akta_lahir'])) { ?>

    <input type="file"
           name="bukti_akta_lahir"
           class="form-control"
           accept="image/*,.pdf"
           required>

<?php } else { ?>

    <input type="text"
           class="form-control"
           value="File akta lahir sudah dipilih"
           readonly>

<?php } ?>
            <label class="fw-bold mb-2 mt-3">Upload Akta Perkawinan</label>

<?php if(!isset($_SESSION['akta_perkawinan'])) { ?>

    <input type="file"
           name="bukti_akta_perkawinan"
           class="form-control"
           accept="image/*,.pdf"
           required>

<?php } else { ?>

    <input type="text"
           class="form-control"
           value="File akta perkawinan sudah dipilih"
           readonly>

<?php } ?>

            <textarea name="alamat"
                      class="form-control"
                      placeholder="Alamat"
                      required><?= $_POST['alamat'] ?? '' ?></textarea>


            <?php if($step == 1) { ?>

                <h3 class="section-heading">Jumlah Anggota</h3>

                <select name="jumlah_anggota"
                        class="form-select"
                        required>

                    <option value="">Pilih jumlah anggota</option>

                    <?php for($i=1; $i<=10; $i++) { ?>

                        <option value="<?= $i ?>">
                            <?= $i ?> Anggota
                        </option>

                    <?php } ?>

                </select>

                <button type="submit"
                        name="step"
                        value="2"
                        class="btn-save">

                    Lanjut

                </button>

            <?php } ?>


            <?php if($step >= 2) { ?>

                <input type="hidden"
                       name="step"
                       value="2">

                <input type="hidden"
                       name="jumlah_anggota"
                       value="<?= $jumlahAnggota ?>">


                <h3 class="section-heading">Anggota Keluarga</h3>

                <?php for($i=1; $i<=$jumlahAnggota; $i++) { ?>

                    <div class="anggota-box">

                        <h4>Anggota <?= $i ?></h4>

                        <input type="text"
       name="nik[]"
       class="form-control"
       placeholder="NIK"
       value="<?= $_POST['nik'][$i-1] ?? '' ?>"
       required>


<input type="text"
       name="nama[]"
       class="form-control"
       placeholder="Nama"
       value="<?= $_POST['nama'][$i-1] ?? '' ?>"
       required>


<select name="jenis_kelamin[]"
        class="form-select"
        required>

    <option value="">Pilih Jenis Kelamin</option>

    <option value="Laki-laki"
        <?= (($_POST['jenis_kelamin'][$i-1] ?? '') == 'Laki-laki') ? 'selected' : '' ?>>

        Laki-laki

    </option>

    <option value="Perempuan"
        <?= (($_POST['jenis_kelamin'][$i-1] ?? '') == 'Perempuan') ? 'selected' : '' ?>>

        Perempuan

    </option>

</select>


<input type="text"
       name="hubungan[]"
       class="form-control"
       placeholder="Hubungan"
       value="<?= $_POST['hubungan'][$i-1] ?? '' ?>"
       required>

                    </div>

                <?php } ?>


                <div class="button-area">

                    <a href="form.php"
                       class="btn-add"
                       style="text-decoration:none; display:flex; align-items:center;">

                        ← Kembali

                    </a>

                    <button type="submit" name="step" value="3" class="btn-save">Review Data</button>

                </div>
                

            <?php if($step == 3) { ?>

<div style="
    margin-top:25px;
    background: linear-gradient(135deg,#f8fafc,#e0f2fe);
    border-radius:20px;
    padding:25px;
    border:1px solid #dbeafe;
    box-shadow:0 15px 30px rgba(0,0,0,0.15);
    text-align:center;
">

    <h3 style="font-weight:800; color:#0f172a; margin-bottom:10px;">
        Periksa kembali data kamu
    </h3>

    <p style="color:#64748b; font-size:14px;">
        Pastikan semua data sudah benar sebelum disimpan.
    </p>

    <div style="display:flex; gap:10px; justify-content:center; margin-top:20px; flex-wrap:wrap;">

        <!-- 🔁 Ulangi -->
        <button type="submit"
                name="step"
                value="2"
                class="btn-add">

            Ulangi

        </button>

        <!-- ✅ Simpan -->
        <button type="submit"
                name="step"
                value="4"
                class="btn-save">

            Simpan Data

        </button>

    </div>

</div>

<?php } ?>
<?php } ?>
        </form>

    </div>
</div>


</body>
</html>