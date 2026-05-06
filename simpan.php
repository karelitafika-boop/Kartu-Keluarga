<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: login_users.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// cek 1 user hanya boleh buat 1 KK
$cek = mysqli_query($koneksi, "SELECT * FROM kartu_keluarga WHERE user_id='$user_id'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Kamu sudah membuat KK. Setiap user hanya boleh membuat 1 KK.');
        window.location='tampil_kk.php';
    </script>";
    exit;
}

$no = $_POST['no_kk'];
$nama = $_POST['nama_kepala_keluarga'];
$alamat = $_POST['alamat'];


// ============================
// FUNCTION UPLOAD
// ============================
function uploadBukti($nama_input) {
    $folder = "uploads/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    if (!isset($_FILES[$nama_input]) || $_FILES[$nama_input]['error'] != 0) {
        die("Upload " . $nama_input . " gagal. Pastikan file dipilih.");
    }

    $nama_file = $_FILES[$nama_input]['name'];
    $tmp_file = $_FILES[$nama_input]['tmp_name'];

    $nama_baru = time() . "" . $nama_input . "" . $nama_file;
    $lokasi = $folder . $nama_baru;

    if (!move_uploaded_file($tmp_file, $lokasi)) {
        die("Gagal memindahkan file " . $nama_input);
    }

    return $nama_baru;
}


// ============================
// UPLOAD FILE
// ============================
$bukti_kk_lama = uploadBukti("bukti_kk_lama");
$bukti_akta_lahir = uploadBukti("bukti_akta_lahir");
$bukti_akta_perkawinan = uploadBukti("bukti_akta_perkawinan");


// ============================
// SIMPAN KK
// ============================
$simpanKK = mysqli_query($koneksi, "INSERT INTO kartu_keluarga 
(user_id, no_kk, nama_kepala_keluarga, alamat, bukti_kk_lama, bukti_akta_lahir, bukti_akta_perkawinan, status)
VALUES
('$user_id', '$no', '$nama', '$alamat', '$bukti_kk_lama', '$bukti_akta_lahir', '$bukti_akta_perkawinan', 'menunggu')");

$id = mysqli_insert_id($koneksi);


// ============================
// SIMPAN ANGGOTA
// ============================
$nik = $_POST['nik'];
$namaA = $_POST['nama'];
$jk = $_POST['jenis_kelamin'];
$hub = $_POST['hubungan'];

for ($i = 0; $i < count($nik); $i++) {
    mysqli_query($koneksi, "INSERT INTO anggota_keluarga
    (id_kk, nik, nama, jenis_kelamin, hubungan)
    VALUES
    ('$id', '{$nik[$i]}', '{$namaA[$i]}', '{$jk[$i]}', '{$hub[$i]}')");
}


// ============================
// REDIRECT
// ============================
echo "<script>
    alert('Data KK berhasil diajukan. Menunggu persetujuan admin.');
    window.location='tampil_kk.php';
</script>";
exit;
?>