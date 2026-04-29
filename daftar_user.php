<!DOCTYPE html>
<html>
<head>
    <title>Daftar User</title>
</head>
<body>

<h2>Daftar Akun User</h2>

<form action="simpan_user.php" method="POST">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Daftar</button>
</form>

<p>Sudah punya akun? <a href="login_users.php">Login di sini</a></p>

</body>
</html>