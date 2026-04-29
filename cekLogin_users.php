<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users 
WHERE username='$username' 
AND password='$password' 
AND role='user'");

$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['user_id'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    header("Location: dashboard.php");
    exit;
} else {
    echo "Login gagal. <a href='login_users.php'>Coba lagi</a>";
}
?>