<?php
include "../includes/auth.php";
include "../config/database.php";

$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
$user = mysqli_fetch_assoc($query);

if(isset($_POST['simpan'])){

    $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));

    // Validasi field tidak boleh kosong
    if(empty($nama) || empty($email)){
        echo "<script>
                alert('Semua field wajib diisi!');
                window.location='profil.php';
              </script>";
        exit;
    }

    // Validasi nama tidak boleh mengandung angka
    if(!preg_match("/^[a-zA-Z\s]+$/", $nama)){
        echo "<script>
                alert('Nama tidak boleh mengandung angka atau simbol!');
                window.location='profil.php';
              </script>";
        exit;
    }

    // Validasi format email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>
                alert('Format email tidak valid!');
                window.location='profil.php';
              </script>";
        exit;
    }
    $update = mysqli_query($conn,"
        UPDATE users
        SET
            nama='$nama',
            email='$email'
        WHERE id_user='$id_user'
    ");

    if($update){

        $_SESSION['nama']=$nama;

        echo "<script>
        alert('Profil berhasil diperbarui');
        window.location='profil.php';
        </script>";

    }else{

        echo "<script>
        alert('Gagal memperbarui profil');
        </script>";

    }

}
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="d-flex app-wrapper">

<?php include "../includes/sidebar_admin.php"; ?>

<div class="container-fluid p-4 main-content">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>Profil Admin</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Nama</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $user['nama']; ?>"
pattern="[A-Za-z\s]+"
title="Nama hanya boleh berisi huruf dan spasi, tidak boleh angka"
oninput="this.value = this.value.replace(/[0-9]/g, '')"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?= $user['email']; ?>"
required>

</div>

<div class="mb-3">

<label>Role</label>

<input
type="text"
class="form-control"
value="<?= ucfirst($user['role']); ?>"
readonly>

</div>

<button
type="submit"
name="simpan"
class="btn btn-success">

Simpan Perubahan

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

<?php include "../includes/footer.php"; ?>