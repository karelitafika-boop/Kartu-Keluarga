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
    <title>Dashboard Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            overflow:hidden;

            background:
            radial-gradient(circle at top left, rgba(244,63,94,.35), transparent 30%),
            radial-gradient(circle at bottom right, rgba(249,115,22,.35), transparent 30%),
            linear-gradient(135deg,#020617,#0f172a,#111827);
        }

        .background-blur{
            position:absolute;
            width:500px;
            height:500px;
            background:linear-gradient(135deg,#ef4444,#f97316);
            border-radius:50%;
            filter:blur(140px);
            opacity:.15;
            z-index:0;
        }

        .background-blur.top{
            top:-150px;
            left:-150px;
        }

        .background-blur.bottom{
            bottom:-150px;
            right:-150px;
        }

        .container{
            position:relative;
            z-index:1;

            width:480px;
            padding:40px;

            border-radius:30px;

            background:rgba(15,23,42,.75);
            backdrop-filter:blur(20px);

            border:1px solid rgba(255,255,255,.12);

            box-shadow:
            0 25px 70px rgba(0,0,0,.45),
            inset 0 1px 1px rgba(255,255,255,.08);

            text-align:center;

            animation:fadeUp .8s ease;
        }

        @keyframes fadeUp{
            from{
                opacity:0;
                transform:translateY(30px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        .icon-box{
            width:90px;
            height:90px;

            margin:auto;
            margin-bottom:20px;

            border-radius:25px;

            display:flex;
            justify-content:center;
            align-items:center;

            background:linear-gradient(135deg,#ef4444,#f97316);

            box-shadow:0 15px 35px rgba(249,115,22,.4);
        }

        .icon-box i{
            font-size:40px;
            color:white;
        }

        h2{
            font-size:30px;
            font-weight:800;
            color:white;
            margin-bottom:8px;
        }

        h2 span{
            color:#fb7185;
        }

        .subtitle{
            color:#cbd5e1;
            font-size:15px;
            margin-bottom:35px;
        }

        .menu-title{
            text-align:left;
            margin-bottom:15px;
            font-size:16px;
            color:#f8fafc;
            font-weight:600;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:15px;
        }

        .menu a{
            text-decoration:none;
            color:white;

            padding:16px 20px;

            border-radius:18px;

            background:rgba(255,255,255,.06);

            display:flex;
            align-items:center;
            gap:15px;

            transition:.3s;

            border:1px solid rgba(255,255,255,.06);
        }

        .menu a:hover{
            transform:translateY(-3px) scale(1.01);

            background:linear-gradient(135deg,
            rgba(239,68,68,.25),
            rgba(249,115,22,.25));

            border:1px solid rgba(255,255,255,.15);

            box-shadow:0 10px 25px rgba(0,0,0,.25);
        }

        .menu i{
            font-size:22px;

            width:45px;
            height:45px;

            border-radius:14px;

            display:flex;
            justify-content:center;
            align-items:center;

            background:linear-gradient(135deg,#ef4444,#f97316);

            color:white;
        }

        .menu-text{
            text-align:left;
        }

        .menu-text h4{
            font-size:16px;
            font-weight:700;
            margin-bottom:2px;
        }

        .menu-text p{
            font-size:12px;
            color:#cbd5e1;
        }

        .logout-btn{
            margin-top:30px;
        }

        .logout-btn button{
            width:100%;
            padding:15px;

            border:none;
            border-radius:18px;

            background:linear-gradient(135deg,#dc2626,#f97316);

            color:white;
            font-size:15px;
            font-weight:700;

            cursor:pointer;

            transition:.3s;

            box-shadow:0 12px 25px rgba(220,38,38,.35);
        }

        .logout-btn button:hover{
            transform:translateY(-2px);
            box-shadow:0 18px 35px rgba(220,38,38,.45);
        }

        .footer{
            margin-top:25px;
            font-size:12px;
            color:#94a3b8;
        }
    </style>

</head>
<body>
    
<div class="background-blur top"></div>
<div class="background-blur bottom"></div>
<div class="container">
    <div class="icon-box"><i class="bi bi-shield-lock-fill"></i></div>
    <h2>Selamat Datang, <span><?php echo $_SESSION['username']; ?></span></h2>
    <div class="subtitle">Dashboard Admin Sistem Kartu Keluarga</div>

    <div class="menu-title">Menu Utama</div>
    <div class="menu">
        <a href="tampil_kk.php">
            <i class="bi bi-people-fill"></i>
            <div class="menu-text">
                <h4>Data Kartu Keluarga</h4>
                <p>Kelola data KK pengguna</p>
            </div>
        </a>
    </div>
    
    <form action="logout.php" method="POST" class="logout-btn">
        <button type="submit"><i class="bi bi-box-arrow-right"></i>Logout</button>
    </form>

    <div class="footer">&copy; 2026 KartuKeluarga Digital, All Rights Reserved.</div>

</div>

</body>
</html>