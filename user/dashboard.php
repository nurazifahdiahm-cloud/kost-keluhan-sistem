<?php
include "../includes/auth.php";
include "../config/database.php";

$id_user = $_SESSION['id_user'];

// Menghitung jumlah keluhan
$total = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM keluhan WHERE id_user='$id_user'"));

$pending = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM keluhan WHERE id_user='$id_user' AND status='Pending'"));

$diproses = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM keluhan WHERE id_user='$id_user' AND status='Diproses'"));

$selesai = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM keluhan WHERE id_user='$id_user' AND status='Selesai'"));

// Riwayat terbaru
$query = mysqli_query($conn,"
SELECT *
FROM keluhan
WHERE id_user='$id_user'
ORDER BY tanggal DESC
LIMIT 3
");
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="d-flex app-wrapper">

    <?php include "../includes/sidebar_user.php"; ?>

    <div class="container-fluid p-4 main-content">

        <h2 class="mb-3">Dashboard User</h2>

        <p class="text-muted">
            Halo,
            <strong><?= $_SESSION['nama']; ?></strong> 👋
            Selamat datang di Sistem Keluhan Fasilitas Kost.
        </p>

        <div class="row mt-4">

            <div class="col-md-3">
                <div class="card bg-dark text-white shadow">
                    <div class="card-body text-center">
                        <h5>Total Keluhan</h5>
                        <h1><?= $total['total']; ?></h1>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning shadow">
                    <div class="card-body text-center">
                        <h5>Pending</h5>
                        <h1><?= $pending['total']; ?></h1>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body text-center">
                        <h5>Diproses</h5>
                        <h1><?= $diproses['total']; ?></h1>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white shadow">
                    <div class="card-body text-center">
                        <h5>Selesai</h5>
                        <h1><?= $selesai['total']; ?></h1>
                    </div>
                </div>
            </div>

        </div>

        <div class="card mt-5 shadow">

            <div class="card-header bg-primary text-white">
                Riwayat Keluhan Terbaru
            </div>

            <div class="card-body">

                <?php
                if(mysqli_num_rows($query)>0){
                ?>

                <div class="table-responsive">

                <table class="table table-hover">

                    <thead>

                        <tr>
                            <th>Judul</th>
                            <th>Fasilitas</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php
                    while($data=mysqli_fetch_assoc($query)){
                    ?>

                    <tr>

                        <td><?= $data['judul']; ?></td>

                        <td><?= $data['fasilitas']; ?></td>

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

                    </tr>

                    <?php } ?>

                    </tbody>

                </table>

                </div>

                <?php
                }else{
                ?>

                <p class="text-center text-muted">
                    Belum ada data keluhan.
                </p>

                <?php } ?>

            </div>

        </div>

    </div>

</div>

<?php include "../includes/footer.php"; ?>