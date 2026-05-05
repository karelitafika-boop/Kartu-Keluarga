<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND role='admin'");
$data = mysqli_fetch_assoc($query);

if ($data && password_verify($password, $data['password'])) {

    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    header("Location: dashboard_db.php");
    exit;

} else {
    echo "<script>
        alert('Login admin gagal!');
        window.location='login_db.php';
    </script>";
}
?>