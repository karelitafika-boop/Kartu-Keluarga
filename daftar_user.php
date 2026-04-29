<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar User - KK Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .register-card {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            border-radius: 22px;
            padding: 35px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .icon-box {
            width: 70px;
            height: 70px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 32px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-register {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="register-card">

    <div class="icon-box">
        <i class="bi bi-person-plus"></i>
    </div>

    <h3 class="text-center fw-bold mb-2">Daftar Akun</h3>
    <p class="text-center text-muted mb-4">
        Buat akun untuk mulai menggunakan KK Digital
    </p>

    <form action="simpan_user.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 btn-register">
            <i class="bi bi-person-check"></i> Daftar
        </button>
    </form>

    <p class="text-center mt-4 mb-0">
        Sudah punya akun?
        <a href="login_users.php" class="fw-bold">Login sekarang</a>
    </p>

    <div class="text-center mt-3">
        <a href="index.php" class="text-muted">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

</div>

</body>
</html>