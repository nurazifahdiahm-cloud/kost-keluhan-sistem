<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Keluhan Fasilitas Kost</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-success text-white text-center">
                    <h3>Registrasi Penghuni Kost</h3>
                </div>

                <div class="card-body">

                    <form action="proses/register_proses.php" method="POST">

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                placeholder="Masukkan Nama Lengkap"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Nomor Kamar</label>
                            <input
                                type="text"
                                name="no_kamar"
                                class="form-control"
                                placeholder="Contoh : A01"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Masukkan Email"
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

                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input
                                type="password"
                                name="konfirmasi"
                                class="form-control"
                                placeholder="Ulangi Password"
                                required>
                        </div>

                        <button class="btn btn-success w-100">
                            Daftar
                        </button>

                    </form>

                    <hr>

                    <p class="text-center">
                        Sudah punya akun?
                        <a href="login.php">
                            Login
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>