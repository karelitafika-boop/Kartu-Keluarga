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
    <title>Form KK</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-title">Kartu Keluarga</div>

    <div class="nav-menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="form.php">Input Data</a>
        <a href="landing.php">Data KK</a>
        <a href="logout.php">Logout</a>
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