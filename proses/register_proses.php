<?php

session_start();
include "../config/database.php";

// Mengambil data dari form
$nama        = trim(htmlspecialchars($_POST['nama']));
$no_kamar    = trim(htmlspecialchars($_POST['no_kamar']));
$email       = trim(htmlspecialchars($_POST['email']));
$password    = $_POST['password'];
$konfirmasi  = $_POST['konfirmasi'];

// ================================
// VALIDASI BACKEND
// ================================

// Cek field kosong
if(empty($nama) || empty($no_kamar) || empty($email) || empty($password) || empty($konfirmasi)){
    echo "<script>
            alert('Semua field wajib diisi!');
            window.location='../register.php';
          </script>";
    exit;
}

// Cek format nama (hanya huruf & spasi, tidak boleh angka/simbol)
if(!preg_match("/^[a-zA-Z\s]+$/", $nama)){
    echo "<script>
            alert('Nama hanya boleh berisi huruf dan spasi, tidak boleh angka atau simbol!');
            window.location='../register.php';
          </script>";
    exit;
}

// Cek format email valid
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "<script>
            alert('Format email tidak valid!');
            window.location='../register.php';
          </script>";
    exit;
}

// Cek panjang password minimal 6 karakter
if(strlen($password) < 6){
    echo "<script>
            alert('Password minimal harus 6 karakter!');
            window.location='../register.php';
          </script>";
    exit;
}

// Cek apakah password sama
if($password != $konfirmasi){

    echo "<script>
            alert('Konfirmasi password tidak sama!');
            window.location='../register.php';
          </script>";
    exit;

}

// Cek email sudah ada atau belum
$cek = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($cek)>0){

    echo "<script>
            alert('Email sudah digunakan!');
            window.location='../register.php';
          </script>";
    exit;

}

// Enkripsi Password
$password_hash = password_hash($password,PASSWORD_DEFAULT);

// Simpan ke database
$query = mysqli_query($conn,"INSERT INTO users(nama,email,password,no_kamar)
VALUES('$nama','$email','$password_hash','$no_kamar')");

if($query){

    echo "<script>
            alert('Registrasi Berhasil');
            window.location='../login.php';
          </script>";

}else{

    echo "<script>
            alert('Registrasi Gagal');
            window.location='../register.php';
          </script>";

}

?>