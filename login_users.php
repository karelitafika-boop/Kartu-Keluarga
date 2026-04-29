<!DOCTYPE html>
<html>
<head>
    <title>Login User</title>
</head>
<body>

<h2>Login User</h2>

<form action="cekLogin_users.php" method="POST">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="daftar_user.php">Daftar dulu</a></p>

</body>
</html>