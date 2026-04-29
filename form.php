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

<div class="content">
    <h2>Input Data Kartu Keluarga</h2>
    <form id="formKK" action="simpan.php" method="POST">
        <h3>Data Kartu Keluarga</h3>
        <input type="text" name="no_kk" placeholder="No KK" required>
        <input type="text" name="nama_kepala_keluarga" placeholder="Nama Kepala Keluarga" required>
        <textarea name="alamat" placeholder="Alamat" required></textarea>
        <h3>Anggota Keluarga</h3>
        <div id="anggota-area">
            <div class="anggota-box">
                <h4>Anggota 1</h4>
                <input type="text" name="nik[]" placeholder="NIK" required>
                <input type="text" name="nama[]" placeholder="Nama" required>
                
                <select name="jenis_kelamin[]" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                
                <input type="text" name="hubungan[]" placeholder="Hubungan" required>
            </div>
        </div>
        
        <button type="button" onclick="tambahAnggota()">+ Tambah Anggota</button>
        <button type="button" onclick="popup()">Simpan</button>
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