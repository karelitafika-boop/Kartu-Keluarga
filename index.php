<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users 
              WHERE username='$username' AND password='$password'");

    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['login'] = true;
        $_SESSION['nama_admin'] = $data['nama_admin'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Pendataan KK</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">

<div class="login-box">
    <h2>Login Admin</h2>
    <p>Sistem Pendataan Kartu Keluarga</p>

    <?php if (isset($error)) { ?>
        <div class="alert-error"><?= $error; ?></div>
    <?php } ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Masukkan username" required>
        <input type="password" name="password" placeholder="Masukkan password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>