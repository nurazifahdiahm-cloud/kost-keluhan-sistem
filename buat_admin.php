<?php
include "config/database.php";

$nama = "Administrator";
$email = "admin@gmail.com";
$password = password_hash("123456", PASSWORD_DEFAULT);
$role = "admin";
$no_kamar = "-";

$query = mysqli_query($conn, "INSERT INTO users(nama,email,password,role,no_kamar)
VALUES('$nama','$email','$password','$role','$no_kamar')");

if($query){
    echo "Admin berhasil dibuat.<br>";
    echo "Email : admin@gmail.com<br>";
    echo "Password : 123456";
}else{
    echo "Gagal membuat admin.";
}
?>