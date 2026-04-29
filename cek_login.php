<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users 
WHERE username='$username' 
AND password='$password' 
AND role='admin'");

$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['user_id'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    header("Location: dashboard_db.php");
    exit;
} else {
    header("Location: login_db.php?pesan=gagal");
    exit;
}
?>