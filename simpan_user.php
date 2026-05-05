<?php
include "koneksi.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$role = "user";

// hash password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// cek username sudah ada atau belum
$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Username sudah digunakan!');
        window.location='daftar_user.php';
    </script>";
    exit;
}

// simpan user
$simpan = mysqli_query($koneksi, "INSERT INTO users (username, password, role)
VALUES ('$username', '$password_hash', '$role')");

if ($simpan) {
    echo "<script>
        alert('Akun berhasil dibuat, silakan login!');
        window.location='login_users.php';
    </script>";
} else {
    echo "Gagal daftar: " . mysqli_error($koneksi);
}
?>