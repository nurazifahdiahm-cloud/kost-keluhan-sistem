<?php
include "../includes/auth.php";
include "../config/database.php";

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM keluhan WHERE id_keluhan='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
            alert('Data keluhan tidak ditemukan!');
            window.location='dashboard.php';
          </script>";
    exit;
}

if (isset($_POST['update'])) {

    $status = $_POST['status'];
    $catatan = $_POST['catatan_admin'];

    mysqli_query($conn, "
        UPDATE keluhan
        SET
            status='$status',
            catatan_admin='$catatan'
        WHERE id_keluhan='$id'
    ");

    // Ambil id user dari keluhan
$id_user = $data['id_user'];

// Membuat pesan notifikasi
$id_user = $data['id_user'];

$pesan = "Status keluhan '".$data['judul']."' telah diperbarui menjadi ".$status.".";

$pesan = mysqli_real_escape_string($conn, $pesan);

mysqli_query($conn,"
INSERT INTO notifikasi(id_user,pesan)
VALUES('$id_user','$pesan')
");

    echo "<script>
            alert('Status berhasil diperbarui.');
            window.location='dashboard.php';
          </script>";
}
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            Update Status Keluhan
        </div>

        <div class="card-body">

            <form method="POST">

                <!-- Judul -->
                <div class="mb-3">
                    <label class="form-label">Judul Keluhan</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?= $data['judul']; ?>"
                        readonly>
                </div>

                <!-- Fasilitas -->
                <div class="mb-3">
                    <label class="form-label">Fasilitas</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?= $data['fasilitas']; ?>"
                        readonly>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea
                        class="form-control"
                        rows="4"
                        readonly><?= $data['deskripsi']; ?></textarea>
                </div>

                <!-- Foto -->
                <div class="mb-3">
                    <label class="form-label">Foto Keluhan</label>
                    <br>

                    <?php if (!empty($data['foto'])) { ?>

                        <img
                            src="../assets/upload/<?= $data['foto']; ?>"
                            width="350"
                            class="img-thumbnail mb-2">

                        <br>

                        <a
                            href="../assets/upload/<?= $data['foto']; ?>"
                            target="_blank"
                            class="btn btn-info btn-sm">

                            Lihat Ukuran Asli

                        </a>

                    <?php } else { ?>

                        <div class="alert alert-secondary mb-0">
                            Tidak ada foto yang diupload.
                        </div>

                    <?php } ?>

                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select
                        name="status"
                        class="form-select"
                        required>

                        <option value="Pending"
                            <?= ($data['status']=="Pending") ? "selected" : ""; ?>>
                            Pending
                        </option>

                        <option value="Diproses"
                            <?= ($data['status']=="Diproses") ? "selected" : ""; ?>>
                            Diproses
                        </option>

                        <option value="Selesai"
                            <?= ($data['status']=="Selesai") ? "selected" : ""; ?>>
                            Selesai
                        </option>

                    </select>
                </div>

                <!-- Catatan Admin -->
                <div class="mb-3">
                    <label class="form-label">
                        Catatan Perbaikan
                    </label>

                    <textarea
                        name="catatan_admin"
                        class="form-control"
                        rows="4"
                        placeholder="Contoh: Lampu LED diganti dengan yang baru..."><?= $data['catatan_admin']; ?></textarea>
                </div>

                <button
                    type="submit"
                    name="update"
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

<?php include "../includes/footer.php"; ?>