<?php
include "../includes/auth.php";
include "../config/database.php";

$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn,"
SELECT *
FROM notifikasi
WHERE id_user='$id_user'
ORDER BY tanggal DESC
");

include "../includes/header.php";
include "../includes/navbar.php";
?>

<div class="d-flex app-wrapper">

<?php include "../includes/sidebar_user.php"; ?>

<div class="container-fluid p-4 main-content">

<h2 class="mb-4">Notifikasi</h2>

<div class="card shadow">

<div class="card-header bg-primary text-white">
Daftar Notifikasi
</div>

<div class="card-body">

<?php if(mysqli_num_rows($query)>0){ ?>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>
<th>No</th>
<th>Pesan</th>
<th>Status</th>
<th>Tanggal</th>
</tr>

</thead>

<tbody>

<?php
$no=1;
while($data=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $data['pesan']; ?></td>

<td>
<?php
if($data['status_baca']=="Belum"){
    echo '<span class="badge bg-danger">Belum Dibaca</span>';
}else{
    echo '<span class="badge bg-success">Sudah Dibaca</span>';
}
?>
</td>

<td><?= $data['tanggal']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php }else{ ?>

<div class="alert alert-info">

Belum ada notifikasi.

</div>

<?php } ?>

</div>

</div>

</div>

</div>

<?php
mysqli_query($conn,"
UPDATE notifikasi
SET status_baca='Sudah'
WHERE id_user='$id_user'
");

include "../includes/footer.php";
?>