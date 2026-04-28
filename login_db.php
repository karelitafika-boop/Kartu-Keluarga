<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login db</title>
</head>

<body>
    <?php
    if(isset($_GET['ket'])){
        if($_GET['ket']=='gagal'){
            echo "Login gagal! password dan username tidak sesuai.";
        }
    }
    ?>
    <h2>LOGIN</h2>
    <!-- form login -->
    <form action="cek_login.php" method="POST">

    <label for="username">Username</label>
    <input type="text" name="username"><br>

    <label for="password">Password</label>
    <input type="password" name="password"><br>

    <input type="submit" value="Submit">
    
    </form>
</body>
</html>