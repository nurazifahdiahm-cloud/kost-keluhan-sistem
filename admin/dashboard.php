
<?php
include "../includes/auth.php";
include "../config/database.php";

// Menghitung jumlah keluhan
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM keluhan"));

$totalPending = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM keluhan WHERE status='Pending'"));
$totalDiproses = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM keluhan WHERE status='Diproses'"));
$totalSelesai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM keluhan WHERE status='Selesai'"));

// Pencarian dan Filter
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : "";
$status_filter = isset($_GET['status']) ? $_GET['status'] : "";

$sql = "
SELECT keluhan.*, users.nama
FROM keluhan
JOIN users ON keluhan.id_user = users.id_user
WHERE 1=1
";

if ($cari != "") {
    $sql .= " AND (users.nama LIKE '%$cari%' OR keluhan.judul LIKE '%$cari%')";
}

if ($status_filter != "") {
    $sql .= " AND keluhan.status='$status_filter'";
}

$sql .= " ORDER BY tanggal DESC";

$query = mysqli_query($conn, $sql);
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="d-flex app-wrapper">

    <?php include "../includes/sidebar_admin.php"; ?>

    <div class="container-fluid p-4 main-content">

        <h2 class="mb-4">Dashboard Admin</h2>

        <div class="alert alert-success">
            Selamat datang,
            <strong><?= $_SESSION['nama']; ?></strong>
        </div>

        <!-- CARD STATISTIK -->

        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body text-center">
                        <h5>Total Keluhan</h5>
                        <h2><?= $total ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning shadow">
                    <div class="card-body text-center">
                        <h5>Pending</h5>
                        <h2><?= $totalPending ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-info text-white shadow">
                    <div class="card-body text-center">
                        <h5>Diproses</h5>
                        <h2><?= $totalDiproses ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white shadow">
                    <div class="card-body text-center">
                        <h5>Selesai</h5>
                        <h2><?= $totalSelesai ?></h2>
                    </div>
                </div>
            </div>

        </div>

<!-- GRAFIK -->

<div class="card shadow mb-4">

    <div class="card-header bg-success text-white">
        Statistik Keluhan
    </div>

    <div class="card-body">
        <canvas id="chartKeluhan"></canvas>
    </div>

</div>

    </div>

</div>

<?php include "../includes/footer.php"; ?>

<script>

const ctx = document.getElementById('chartKeluhan');

new Chart(ctx, {

    type: 'bar',

    data: {
        labels: ['Pending','Diproses','Selesai'],
        datasets: [{
            label: 'Jumlah Keluhan',
            data: [
                <?= $totalPending ?>,
                <?= $totalDiproses ?>,
                <?= $totalSelesai ?>
            ],
            backgroundColor: [
                '#ffc107',
                '#0d6efd',
                '#198754'
            ]
        }]
    },

    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }

});

</script>