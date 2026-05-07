<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: login_users.php");
    exit;
}

$user_id = $_SESSION['id_user'];


// cek 1 user = 1 KK
$cek = mysqli_query($koneksi,
"SELECT * FROM kartu_keluarga WHERE user_id='$user_id'");

if(mysqli_num_rows($cek) > 0){
    echo "<script>
        alert('Kamu sudah membuat KK');
        window.location='tampil_kk.php';
    </script>";
    exit;
}


// ambil data form
$no = $_POST['no_kk'];
$nama = $_POST['nama_kepala_keluarga'];
$alamat = $_POST['alamat'];


// ambil file dari session
$bukti_kk_lama = $_SESSION['kk_lama'] ?? '';
$bukti_akta_lahir = $_SESSION['akta_lahir'] ?? '';
$bukti_akta_perkawinan = $_SESSION['akta_perkawinan'] ?? '';


// simpan KK
mysqli_query($koneksi,"INSERT INTO kartu_keluarga
(user_id,no_kk,nama_kepala_keluarga,alamat,
bukti_kk_lama,bukti_akta_lahir,bukti_akta_perkawinan,status)

VALUES

('$user_id','$no','$nama','$alamat',
'$bukti_kk_lama','$bukti_akta_lahir',
'$bukti_akta_perkawinan','menunggu')
");

$id = mysqli_insert_id($koneksi);


// simpan anggota
$nik = $_POST['nik'];
$namaA = $_POST['nama'];
$jk = $_POST['jenis_kelamin'];
$hub = $_POST['hubungan'];

for($i=0; $i<count($nik); $i++){

    mysqli_query($koneksi,"INSERT INTO anggota_keluarga
    (id_kk,nik,nama,jenis_kelamin,hubungan)

    VALUES

    ('$id',
    '{$nik[$i]}',
    '{$namaA[$i]}',
    '{$jk[$i]}',
    '{$hub[$i]}')
    ");
}


// hapus session file setelah berhasil
unset($_SESSION['kk_lama']);
unset($_SESSION['akta_lahir']);
unset($_SESSION['akta_perkawinan']);


echo "<script>
alert('Data KK berhasil diajukan');
window.location='tampil_kk.php';
</script>";
exit;
?>