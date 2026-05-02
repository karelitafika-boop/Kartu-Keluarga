<?php
session_start();
include "koneksi.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' LIMIT 1");

if (mysqli_num_rows($query) == 1) {
    $data = mysqli_fetch_assoc($query);

    if ($password == $data['password']) {
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: login_users.php?pesan=gagal");
        exit;
    }

} else {
    header("Location: login_users.php?pesan=gagal");
    exit;
}
?>