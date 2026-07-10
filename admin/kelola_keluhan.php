<?php
include "../includes/auth.php";
include "../config/database.php";

// Pencarian dan Filter
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : "";
$status_filter = isset($_GET['status']) ? $_GET['status'] : "";

$sql = "
SELECT keluhan.*, users.nama
FROM keluhan
JOIN users ON keluhan.id_user = users.id_user
WHERE 1=1
";

if($cari != ""){
    $sql .= " AND (users.nama LIKE '%$cari%' OR keluhan.judul LIKE '%$cari%')";
}

if($status_filter != ""){
    $sql .= " AND keluhan.status='$status_filter'";
}

$sql .= " ORDER BY tanggal DESC";

$query = mysqli_query($conn,$sql);
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="d-flex app-wrapper">

<?php include "../includes/sidebar_admin.php"; ?>

<div class="container-fluid p-4 main-content">

<h2 class="mb-4">Kelola Keluhan</h2>

<div class="card shadow mb-4">

<div class="card-body">

<form method="GET" class="row g-3">

<div class="col-md-5">

<input
type="text"
name="cari"
class="form-control"
placeholder="Cari nama penghuni atau judul..."
value="<?= $cari; ?>">

</div>

<div class="col-md-3">

<select
name="status"
class="form-select">

<option value="">Semua Status</option>

<option value="Pending"
<?= ($status_filter=="Pending")?"selected":"";?>>

Pending

</option>

<option value="Diproses"
<?= ($status_filter=="Diproses")?"selected":"";?>>

Diproses

</option>

<option value="Selesai"
<?= ($status_filter=="Selesai")?"selected":"";?>>

Selesai

</option>

</select>

</div>

<div class="col-md-2">

<button
type="submit"
class="btn btn-primary w-100">

Cari

</button>

</div>

<div class="col-md-2">

<a
href="kelola_keluhan.php"
class="btn btn-secondary w-100">

Reset

</a>

</div>

</form>

</div>

</div>

<div class="card shadow">

<div class="card-header bg-dark text-white">

Daftar Semua Keluhan

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>No</th>
<th>Nama Penghuni</th>
<th>Judul</th>
<th>Fasilitas</th>
<th>Foto</th>
<th>Prioritas</th>
<th>Status</th>
<th>Tanggal</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($data=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $data['nama']; ?></td>

<td><?= $data['judul']; ?></td>

<td><?= $data['fasilitas']; ?></td>

<td>

<?php

if(!empty($data['foto'])){

?>

<a
href="../assets/upload/<?= $data['foto']; ?>"
target="_blank"
class="btn btn-info btn-sm text-white">

Lihat

</a>

<?php

}else{

?>

<span class="text-muted">

Tidak Ada

</span>

<?php } ?>

</td>

<td>

<?php

if($data['prioritas']=="Penting"){

echo '<span class="badge bg-danger">Penting</span>';

}else{

echo '<span class="badge bg-secondary">Biasa</span>';

}

?>

</td>

<td>

<?php

if($data['status']=="Pending"){

echo '<span class="badge bg-warning text-dark">Pending</span>';

}elseif($data['status']=="Diproses"){

echo '<span class="badge bg-primary">Diproses</span>';

}else{

echo '<span class="badge bg-success">Selesai</span>';

}

?>

</td>

<td><?= $data['tanggal']; ?></td>

<td>

<a
href="update_status.php?id=<?= $data['id_keluhan']; ?>"
class="btn btn-warning btn-sm">

Update

</a>

<a
href="hapus_keluhan.php?id=<?= $data['id_keluhan']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus keluhan \'<?= addslashes($data['judul']); ?>\'? Data yang dihapus tidak bisa dikembalikan.');">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<?php include "../includes/footer.php"; ?>