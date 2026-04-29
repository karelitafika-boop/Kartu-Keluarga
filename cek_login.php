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
    $_SESSION['username'] = $data['username'];

    header("Location: dashboard_db.php");
} else {
    header("Location: login_db.php?pesan=gagal");
}
?>