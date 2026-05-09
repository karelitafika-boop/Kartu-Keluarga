<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User - KK Digital</title>
  
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
        radial-gradient(circle at top left, #22d3ee55, transparent 35%),
        radial-gradient(circle at bottom right, #6366f155, transparent 35%),
        linear-gradient(135deg, #020617, #0f172a, #111827);
      color: white;
      overflow: hidden;
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
      color: #e5e7eb;
      font-weight: 600;
    }

    .input-box {
      display: flex;
      align-items: center;
      border-radius: 15px;
      background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.14);
      overflow: hidden;
    }

    .input-box i {
      padding: 0 14px;
      color: #38bdf8;
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
      background: linear-gradient(135deg, #6366f1, #0ea5e9);
      box-shadow: 0 14px 35px rgba(14,165,233,.42);
      cursor: pointer;
      transition: .3s;
    }

    .btn-login:hover {
      transform: translateY(-3px);
    }

    a {
      color: #38bdf8;
      text-decoration: none;
      font-weight: 700;
    }

    .bottom-text {
      margin-top: 22px;
      margin-bottom: 8px;
    }

    .alert {
      background: #ef4444;
      padding: 12px;
      border-radius: 14px;
      margin-bottom: 18px;
      text-align: center;
      font-size: 14px;
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
      color: #38bdf8;
      font-size: 20px;
      display: block;
      margin-bottom: 5px;
    }

    @media(max-width: 700px) {
      .login-card {
        width: 90%;
      }

      .form-row {
        flex-direction: column;
      }
    }

    .admin-login {
      position: fixed;
      bottom: 24px;
      right: 24px;
      background: linear-gradient(90deg, #0f172a, #1d4ed8);
      color: white;
      padding: 12px 22px;
      border-radius: 14px;
      font-size: 14px;
      font-weight: 800;
      text-decoration: none;
      box-shadow: 0 12px 25px rgba(15, 23, 42, 0.35);
      z-index: 999;
      transition: 0.3s;
    }

    .admin-login:hover {
      color: white;
      background: linear-gradient(90deg, #1e293b, #2563eb);
      transform: translateY(-3px);
    }
  </style>

</head>
<body>

<div class="login-card">
  <h2>Login User</h2>
  <p>Masuk untuk mengajukan data Kartu Keluarga Digital</p>

  <?php
  if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") {
      echo '<div class="alert">Username atau password salah!</div>';
  }
  ?>

  <form action="cekLogin_users.php" method="POST">

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
      <i class="bi bi-box-arrow-in-right"></i>Login
    </button>

  </form>

  <p class="bottom-text">
    Belum punya akun? <a href="daftar_user.php">Daftar sekarang</a>
  </p>
  <p>
    <a href="index.php">← Kembali ke Beranda</a>
  </p>

  <div class="features">
    <div class="feature">
      <i class="bi bi-shield-check"></i>Aman
    </div>
    <div class="feature">
      <i class="bi bi-lightning-charge"></i>Cepat
    </div>
    <div class="feature">
      <i class="bi bi-check-circle"></i>Digital
    </div>
  </div>
</div>

<a href="login_db.php" class="admin-login">Admin</a>

</body>
</html>