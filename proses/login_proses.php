<?php
session_start();
include "../config/database.php";

// Mengambil data dari form
$email = trim(htmlspecialchars($_POST['email']));
$password = $_POST['password'];

// Cek field kosong
if(empty($email) || empty($password)){
    echo "<script>
            alert('Email dan password wajib diisi!');
            window.location='../login.php';
          </script>";
    exit;
}

// Cek format email valid
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "<script>
            alert('Format email tidak valid!');
            window.location='../login.php';
          </script>";
    exit;
}

// Cek apakah email ada
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

// Jika email tidak ditemukan
if (mysqli_num_rows($query) == 0) {
    echo "<script>
            alert('Email tidak ditemukan!');
            window.location='../login.php';
          </script>";
    exit;
}

// Ambil data user
$user = mysqli_fetch_assoc($query);

// Verifikasi password
if (password_verify($password, $user['password'])) {

    // Simpan session
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    // ================================
    // COOKIE: Fitur "Ingat Saya"
    // ================================
    if (isset($_POST['ingat_saya'])) {
        // Simpan email di cookie selama 30 hari (30 x 24 x 60 x 60 detik)
        setcookie("remember_email", $email, time() + (30 * 24 * 60 * 60), "/");
    } else {
        // Jika tidak dicentang, hapus cookie (jika sebelumnya ada)
        setcookie("remember_email", "", time() - 3600, "/");
    }

    // Cek role
    if ($user['role'] == 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../user/dashboard.php");
    }

} else {

    echo "<script>
            alert('Password salah!');
            window.location='../login.php';
          </script>";

}
?>