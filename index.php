<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KK Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #68789a, #05234b);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-custom {
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .btn-custom {
            width: 100%;
            margin-top: 10px;
            border-radius: 10px;
        }

        h1 {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card card-custom text-center">

                <!-- JUDUL -->
                <h1 class="mb-3">
                    <i class="bi bi-people-fill"></i> KK Digital
                </h1>

                <p class="text-muted mb-4">
                    Sistem Pendataan Kartu Keluarga Digital untuk mempermudah pengelolaan data keluarga.
                </p>

                <!-- LOGIN -->
                <a href="login_users.php" class="btn btn-primary btn-custom">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>

                <!-- DAFTAR -->
                <a href="daftar_user.php" class="btn btn-outline-primary btn-custom">
                    <i class="bi bi-person-plus"></i> Daftar Akun
                </a>

            </div>

        </div>
    </div>
</div>

</body>
</html>