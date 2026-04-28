<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard db</title>
</head>

<body>
    <h2>Selamat Datang, <?php echo $_SESSION['username'] . "!";?></h2>
    <h3>Menu:</h3>
    <ul>
        <li><a href="tampil_kk.php">Data Booking</a></li>
    </ul>    
    <form action="logout.php" method="POST">
        <input type="submit" value="Logout">
    </form>
</body>
</html>