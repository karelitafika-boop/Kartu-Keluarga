<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KK Digital</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body{
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background:
            linear-gradient(rgba(174, 178, 190, 0.7), rgba(13, 33, 59, 0.8)),
            url('assets/bg.png');
        background-size: cover;
        background-position: center;
        color: white;
    }

    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
      background-size: 45px 45px;
    }

    .card-box {
      position: relative;
      z-index: 2;
      width: 520px;
      padding: 42px;
      border-radius: 30px;
      text-align: center;
      background: rgba(17, 12, 68, 0.78);
      backdrop-filter: blur(22px);
      border: 1px solid rgba(255,255,255,.16);
      box-shadow: 0 30px 80px rgba(0,0,0,.55);
    }

    .logo {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 14px;
      margin-bottom: 18px;
    }

    .logo i {
      font-size: 45px;
      color: #38bdf8;
    }

    .logo h1 {
      font-size: 40px;
      font-weight: 800;
    }

    .logo span {
      color: #38bdf8;
    }

    p {
      color: #cbd5e1;
      margin-bottom: 30px;
      line-height: 1.7;
    }

    .btn-menu {
      display: block;
      width: 100%;
      padding: 14px;
      border-radius: 16px;
      margin-bottom: 14px;
      text-decoration: none;
      font-weight: 700;
      color: white;
      background: linear-gradient(135deg, #6366f1, #0ea5e9);
      box-shadow: 0 14px 35px rgba(14,165,233,.4);
      transition: .3s;
    }

    .btn-menu:hover {
      transform: translateY(-3px);
    }

    .btn-outline {
      background: rgba(255,255,255,.06);
      border: 1px solid rgba(255,255,255,.18);
      box-shadow: none;
    }

    @media(max-width: 600px) {
      .card-box {
        width: 90%;
        padding: 32px 24px;
      }

      .logo h1 {
        font-size: 32px;
      }
    }
  </style>
</head>
<body>


  <div class="card-box">
    <div class="logo">
      <i class="bi bi-people-fill"></i>
      <h1>KK <span>Digital</span></h1>
    </div>

    <p>Sistem Pendataan Kartu Keluarga Digital untuk mempermudah pengelolaan data keluarga.</p>

    <a href="login_users.php" class="btn-menu">
      <i class="bi bi-box-arrow-in-right"></i> Login
    </a>

    <a href="daftar_user.php" class="btn-menu btn-outline">
      <i class="bi bi-person-plus"></i> Daftar Akun
    </a>
  </div>

</body>
</html>