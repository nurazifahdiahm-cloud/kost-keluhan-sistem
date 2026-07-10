<?php
include "../includes/auth.php";
include "../config/database.php";

$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn, "SELECT * FROM keluhan WHERE id_user='$id_user' ORDER BY tanggal DESC");
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="d-flex app-wrapper">

    <?php include "../includes/sidebar_user.php"; ?>

    <div class="container-fluid p-4 main-content">

        <h2 class="mb-4">Riwayat Keluhan</h2>

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                Data Keluhan Saya
            </div>

            <div class="card-body">

                <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Fasilitas</th>
                            <th>Foto</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Catatan Admin</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 1;

                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td><?= $data['judul']; ?></td>

                            <td><?= $data['fasilitas']; ?></td>

                            <!-- FOTO -->
                            <td>
                                <?php if (!empty($data['foto'])) { ?>
                                    <a href="../assets/upload/<?= $data['foto']; ?>" target="_blank" class="btn btn-sm btn-info text-white">
                                        Lihat Foto
                                    </a>
                                <?php } else { ?>
                                    <span class="text-muted">Tidak ada</span>
                                <?php } ?>
                            </td>

                            <!-- PRIORITAS -->
                            <td>
                                <?php
                                if ($data['prioritas'] == "Penting") {
                                ?>
                                    <span class="badge bg-danger">Penting</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Biasa</span>
                                <?php } ?>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <?php
                                if ($data['status'] == "Pending") {
                                ?>
                                    <span class="badge bg-warning text-dark">Pending</span>

                                <?php
                                } elseif ($data['status'] == "Diproses") {
                                ?>
                                    <span class="badge bg-primary">Diproses</span>

                                <?php
                                } elseif ($data['status'] == "Selesai") {
                                ?>
                                    <span class="badge bg-success">Selesai</span>

                                <?php
                                } else {
                                    echo $data['status'];
                                }
                                ?>
                            </td>

                            <!-- CATATAN ADMIN -->
                            <td>
                                <?php
                                if (!empty($data['catatan_admin'])) {
                                ?>
                                    <span class="text-success">
                                        <?= $data['catatan_admin']; ?>
                                    </span>
                                <?php } else { ?>
                                    <span class="text-muted">
                                        Belum ada catatan
                                    </span>
                                <?php } ?>
                            </td>

                            <!-- TANGGAL -->
                            <td><?= $data['tanggal']; ?></td>

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