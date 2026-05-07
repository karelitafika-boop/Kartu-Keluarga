<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background:
        radial-gradient(circle at top left, #f43f5e55, transparent 35%),
        radial-gradient(circle at bottom right, #f59e0b55, transparent 35%),
        linear-gradient(135deg, #020617, #0f172a, #111827);
        color: white;
    }

    .container {
        width: 500px;
        padding: 30px;
        border-radius: 25px;
        background: rgba(15,23,42,.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,.15);
        box-shadow: 0 25px 70px rgba(0,0,0,.5);
        text-align: center;
    }

    h2 {
        margin-bottom: 10px;
        font-weight: 800;
        color: #f87171;
    }

    h3 {
        margin: 20px 0 10px;
    }

    ul {
        list-style: none;
        margin-top: 10px;
    }

    ul li {
        margin: 10px 0;
    }

    ul li a {
        display: block;
        padding: 12px;
        border-radius: 12px;
        text-decoration: none;
        color: white;
        background: rgba(255,255,255,.08);
        transition: .3s;
    }

    ul li a:hover {
        background: rgba(248,113,113,.3);
    }

    input[type="submit"] {
        margin-top: 20px;
        padding: 12px;
        width: 100%;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, #ef4444, #f97316);
        color: white;
        font-weight: 700;
        cursor: pointer;
        transition: .3s;
    }

    input[type="submit"]:hover {
        transform: translateY(-2px);
    }
    
    </style>
    
</head>
<body>
    
<div class="container">
    <h2>Selamat Datang, <?php echo $_SESSION['username'] . "!";?></h2>
    <h3>Menu:</h3>
    <ul>
        <li>
            <a href="tampil_kk.php"><i class="bi bi-people"></i>Data Kartu Keluarga</a>
        </li>    
    </ul>
    <form action="logout.php" method="POST"><input type="submit" value="Logout"></form>

</div>

</body>
</html>
