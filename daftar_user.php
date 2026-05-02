<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar User</title>
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

  .register-card {
    width: 720px;
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

  .btn-register {
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

  .btn-register:hover {
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

  @media(max-width: 760px) {
    .register-card {
      width: 90%;
    }
    .form-row {
      flex-direction: column;
    }
  }
  
  </style>

</head>
<body>
  
<div class="register-card">
  <h2>Daftar Akun</h2>
  <p>Buat akun baru untuk menggunakan layanan KK Digital</p>
  
  <form action="simpan_user.php" method="POST">
    
  <div class="form-row">
    <div class="form-group">
      <label>Nama Lengkap</label>
      <div class="input-box">
        <i class="bi bi-person-badge"></i>
        <input type="text" name="nama" placeholder="Nama lengkap" required>
      </div>
    </div>
    <div class="form-group">
      <label>Username</label>
      <div class="input-box">
        <i class="bi bi-person"></i>
        <input type="text" name="username" placeholder="Username" required>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label>Password</label>
      <div class="input-box">
        <i class="bi bi-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>
    </div>
    <div class="form-group">
      <label>Konfirmasi Password</label>
      <div class="input-box">
        <i class="bi bi-shield-lock"></i>
        <input type="password" name="konfirmasi_password" placeholder="Ulangi password" required>
      </div>
    </div>
  </div>
  
  <button type="submit" class="btn-register"><i class="bi bi-person-plus"></i>Daftar Akun</button>

</form>

<p class="bottom-text">Sudah punya akun?<a href="login_users.php">Login sekarang</a></p>
<p><a href="index.php">Kembali ke Beranda</a></p>

</div>

</body>
</html>