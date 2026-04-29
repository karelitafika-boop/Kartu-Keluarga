<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$role = "user";

$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

if (mysqli_num_rows($cek) > 0) {
    echo "Username sudah digunakan. <a href='daftar_user.php'>Kembali</a>";
} else {
    $simpan = mysqli_query($koneksi, "INSERT INTO users 
    (username, password, role) 
    VALUES 
    ('$username', '$password', '$role')");

    if ($simpan) {
        header("Location: login_users.php");
        exit;
    } else {
        echo "Gagal daftar: " . mysqli_error($koneksi);
    }
}
?>