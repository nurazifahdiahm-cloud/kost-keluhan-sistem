<?php

session_start();
include "../config/database.php";

// Ambil data dari form
$id_user = $_SESSION['id_user'];
$judul = trim(htmlspecialchars($_POST['judul']));
$fasilitas = trim(htmlspecialchars($_POST['fasilitas']));
$deskripsi = trim(htmlspecialchars($_POST['deskripsi']));
$prioritas = $_POST['prioritas'];

$status = "Pending";
$foto = "";

// ================================
// VALIDASI BACKEND
// ================================

// Cek field kosong
if(empty($judul) || empty($fasilitas) || empty($deskripsi) || empty($prioritas)){
    echo "<script>
            alert('Semua field wajib diisi!');
            history.back();
          </script>";
    exit;
}

// Upload Foto (jika ada file yang diupload)
if ($_FILES['foto']['name'] != "") {

    $tipe_diizinkan = ['image/jpeg', 'image/png', 'image/jpg'];
    $tipe_file = $_FILES['foto']['type'];
    $ukuran_file = $_FILES['foto']['size']; // dalam bytes
    $maks_ukuran = 2 * 1024 * 1024; // maksimal 2MB

    // Validasi tipe file (hanya gambar)
    if (!in_array($tipe_file, $tipe_diizinkan)) {
        echo "<script>
                alert('Foto harus berformat JPG, JPEG, atau PNG!');
                history.back();
              </script>";
        exit;
    }

    // Validasi ukuran file
    if ($ukuran_file > $maks_ukuran) {
        echo "<script>
                alert('Ukuran foto maksimal 2MB!');
                history.back();
              </script>";
        exit;
    }

    // Validasi tambahan: pastikan file benar-benar gambar (bukan file lain yang di-rename)
    if (getimagesize($_FILES['foto']['tmp_name']) === false) {
        echo "<script>
                alert('File yang diupload bukan gambar yang valid!');
                history.back();
              </script>";
        exit;
    }

    $namaFoto = time() . "_" . basename($_FILES['foto']['name']);

    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "../assets/upload/" . $namaFoto);

    $foto = $namaFoto;
}

// Simpan ke database
$query = mysqli_query($conn, "INSERT INTO keluhan
(id_user, judul, fasilitas, deskripsi, foto, prioritas, status)

VALUES

('$id_user',
'$judul',
'$fasilitas',
'$deskripsi',
'$foto',
'$prioritas',
'$status')");

// Cek berhasil atau tidak
if ($query) {

    echo "
    <script>
        alert('Keluhan berhasil dikirim!');
        window.location='../user/dashboard.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Keluhan gagal disimpan!');
        history.back();
    </script>
    ";

}

?>