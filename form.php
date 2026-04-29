<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color:navy;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#"><span class="text-light">KK </span><span class="text-info">Digital</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-light fw-bold" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="form.php">Input Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="landing.php">Data KK</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="logout.php">Logout</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light fw-bold" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
          <ul class="dropdown-menu" aria-labelledby="adminDropdown">
            <li><a class="dropdown-item" href="login_db.php">Login Admin</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div style="max-width:800px; margin:50px auto; background:#fff; padding:30px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.1); font-family:'Poppins';">
  <h2 style="text-align:center; margin-bottom:20px; color:darkblue; font-weight: bold;">Input Data Kartu Keluarga</h2>
  <form id="formKK" action="simpan.php" method="POST">
    <h3 style="margin-top:20px; font-weight: bold; font-size: 20px;">Data Kartu Keluarga</h3>
    <input type="text" name="no_kk" placeholder="No KK" required style="width:100%; padding:10px; margin:8px 0; border-radius:8px; border:1px solid #ccc;">
    <input type="text" name="nama_kepala_keluarga" placeholder="Nama Kepala Keluarga" required style="width:100%; padding:10px; margin:8px 0; border-radius:8px; border:1px solid #ccc;">
    <textarea name="alamat" placeholder="Alamat" required style="width:100%; padding:10px; margin:8px 0; border-radius:8px; border:1px solid #ccc;"></textarea>
    <h3 style="margin-top:20px; font-weight: bold; font-size: 20px;">Anggota Keluarga</h3>
    <div id="anggota-area">
      <div style="background:#f9fbff; padding:15px; border-radius:10px; margin-bottom:15px; border:1px solid #dbe7ff;">
        <h4>Anggota 1</h4>
        <input type="text" name="nik[]" placeholder="NIK" required style="width:100%; padding:10px; margin:8px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="nama[]" placeholder="Nama" required style="width:100%; padding:10px; margin:8px 0; border-radius:8px; border:1px solid #ccc;">
        <select name="jenis_kelamin[]" required style="width:100%; padding:10px; margin:8px 0; border-radius:8px; border:1px solid #ccc;">
          <option value="">Pilih Jenis Kelamin</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
        <input type="text" name="hubungan[]" placeholder="Hubungan" required style="width:100%; padding:10px; margin:8px 0; border-radius:8px; border:1px solid #ccc;">
      </div>
    </div>
    
    <div style="display:flex; justify-content:space-between; margin-top:10px;">
      <button type="button" onclick="tambahAnggota()" style="background:#6c757d; color:white; padding:10px 15px; border:none; border-radius:8px; cursor:pointer;">+ Tambah Anggota</button>
      <button type="button" onclick="popup()" style="background:#007bff; color:white; padding:10px 15px; border:none; border-radius:8px; cursor:pointer;">Simpan</button>
    </div>
  </form>
</div>

<div id="popup" class="popup">
    <div class="popup-box">
        <h3>Apakah data sudah benar?</h3>
        <p>Kalau masih ada yang salah, klik Ulangi untuk kembali mengoreksi data.</p>
        <button type="button" onclick="ulang()">Ulangi</button>
        <button type="button" onclick="lanjut()">OK</button>
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

        <input type="text" name="nik[]" placeholder="NIK" required>

        <input type="text" name="nama[]" placeholder="Nama" required>

        <select name="jenis_kelamin[]" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <input type="text" name="hubungan[]" placeholder="Hubungan" required>
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