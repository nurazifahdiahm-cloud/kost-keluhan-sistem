<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Keluhan Fasilitas Kost</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Sendiri -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h3>Sistem Keluhan Fasilitas Kost</h3>
                </div>

                <div class="card-body">

                    <h4 class="text-center mb-4">Login</h4>

                    <form action="proses/login_proses.php" method="POST">

                        <div class="mb-3">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Masukkan Email"
                                value="<?= isset($_COOKIE['remember_email']) ? htmlspecialchars($_COOKIE['remember_email']) : ''; ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan Password"
                                required>
                        </div>

                        <div class="mb-3 form-check">
                            <input
                                type="checkbox"
                                name="ingat_saya"
                                class="form-check-input"
                                id="ingatSaya"
                                <?= isset($_COOKIE['remember_email']) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="ingatSaya">
                                Ingat email saya
                            </label>
                        </div>

                        <button class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                    <hr>

                    <p class="text-center">
                        Belum punya akun?
                        <a href="register.php">
                            Daftar Disini
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>