<?php
include "koneksi.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$role = "user";

$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Username sudah digunakan!');
        window.location='daftar_user.php';
    </script>";
} else {

    $simpan = mysqli_query($koneksi, "INSERT INTO users (username, password, role)
    VALUES ('$username', '$password', '$role')");

    if ($simpan) {
        echo "<script>
            alert('Akun berhasil dibuat, silakan login!');
            window.location='login_users.php';
        </script>";
    } else {
        echo "Gagal daftar: " . mysqli_error($koneksi);
    }
}
?>