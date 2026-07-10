<?php
include "../includes/auth.php";
include "../config/database.php";

// Pastikan hanya admin yang bisa mengakses
if ($_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit;
}

// Pastikan ada id yang dikirim
if (!isset($_GET['id'])) {
    header("Location: kelola_keluhan.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Ambil data keluhan dulu (untuk hapus foto & pesan konfirmasi)
$query = mysqli_query($conn, "SELECT * FROM keluhan WHERE id_keluhan='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
            alert('Data keluhan tidak ditemukan!');
            window.location='kelola_keluhan.php';
          </script>";
    exit;
}

// Hapus file foto dari server jika ada
if (!empty($data['foto'])) {
    $path_foto = "../assets/upload/" . $data['foto'];
    if (file_exists($path_foto)) {
        unlink($path_foto);
    }
}

// Hapus data dari database
$hapus = mysqli_query($conn, "DELETE FROM keluhan WHERE id_keluhan='$id'");

if ($hapus) {
    echo "<script>
            alert('Data keluhan berhasil dihapus!');
            window.location='kelola_keluhan.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data keluhan!');
            window.location='kelola_keluhan.php';
          </script>";
}
?>
