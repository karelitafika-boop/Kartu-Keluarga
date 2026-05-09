<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - KK Digital</title>
  
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

    .login-card {
      width: 620px;
      padding: 34px;
      border-radius: 28px;
      background: rgba(15,23,42,.78);
      backdrop-filter: blur(22px);
      border: 1px solid rgba(255,255,255,.16);
      box-shadow: 0 30px 80px rgba(0,0,0,.55);
    }

    h2 {
      text-align: center;
      font-size: 28px;
      font-weight: 800;
      margin-bottom: 8px;
      color: #f87171;
    }

    p {
      text-align: center;
      color: #cbd5e1;
      font-size: 14px;
      margin-bottom: 28px;
    }

    .form-row {
      display: flex;
      gap: 16px;
      margin-bottom: 18px;
    }

    .form-group {
      flex: 1;
    }

    label {
      display: block;
      font-size: 13px;
      margin-bottom: 8px;
      font-weight: 600;
    }

    .input-box {
      display: flex;
      align-items: center;
      border-radius: 15px;
      background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.14);
    }

    .input-box i {
      padding: 0 14px;
      color: #f87171;
    }

    input {
      width: 100%;
      padding: 13px 12px;
      border: none;
      outline: none;
      background: transparent;
      color: white;
    }

    input::placeholder {
      color: #94a3b8;
    }

    .btn-login {
      width: 100%;
      border: none;
      padding: 14px;
      border-radius: 16px;
      font-weight: 700;
      color: white;
      background: linear-gradient(135deg, #ef4444, #f97316);
      box-shadow: 0 14px 35px rgba(239,68,68,.4);
      cursor: pointer;
      transition: .3s;
    }

    .btn-login:hover {
      transform: translateY(-3px);
    }

    .alert {
      background: #ef4444;
      padding: 12px;
      border-radius: 14px;
      margin-bottom: 18px;
      text-align: center;
      font-size: 14px;
    }

    a {
      color: #f87171;
      text-decoration: none;
      font-weight: 700;
    }

    .features {
      display: flex;
      gap: 12px;
      margin-top: 24px;
    }

    .feature {
      flex: 1;
      text-align: center;
      padding: 12px;
      border-radius: 16px;
      background: rgba(255,255,255,.07);
      border: 1px solid rgba(255,255,255,.1);
      font-size: 12px;
      color: #cbd5e1;
    }

    .feature i {
      color: #f87171;
      font-size: 20px;
      display: block;
      margin-bottom: 5px;
    }
  </style>

</head>
<body>

<div class="login-card">
  <h2>Login Admin</h2>
  <p>Akses dashboard pengelolaan data Kartu Keluarga</p>

  <?php
  if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") {
      echo '<div class="alert">Login admin gagal!</div>';
  }
  ?>

  <form action="cek_login.php" method="POST">

    <div class="form-row">
      <div class="form-group">
        <label>Username</label>
        <div class="input-box">
          <i class="bi bi-person"></i>
          <input type="text" name="username" placeholder="Masukkan username" required>
        </div>
      </div>

      <div class="form-group">
        <label>Password</label>
        <div class="input-box">
          <i class="bi bi-lock"></i>
          <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
      </div>
    </div>

    <button type="submit" class="btn-login">
      <i class="bi bi-shield-lock"></i> Login Admin
    </button>

  </form>

  <p><a href="login_users.php">← Kembali ke Login User</a></p>
  
  <div class="features">
    <div class="feature">
      <i class="bi bi-shield-lock"></i>Secure
    </div>
    <div class="feature">
      <i class="bi bi-speedometer2"></i>Control
    </div>
    <div class="feature">
      <i class="bi bi-gear"></i>Manage
    </div>
  </div>
</div>

</body>
</html>