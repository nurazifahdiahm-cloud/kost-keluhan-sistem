<?php
include "../includes/auth.php";
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="d-flex app-wrapper">

    <?php include "../includes/sidebar_user.php"; ?>

    <div class="container-fluid p-4 main-content">

        <h2 class="mb-4">Tambah Keluhan</h2>

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                Form Laporan Keluhan

            </div>

            <div class="card-body">

                <form action="../proses/tambah_keluhan_proses.php"
                      method="POST"
                      enctype="multipart/form-data">

                    <!-- Judul -->

                    <div class="mb-3">

                        <label class="form-label">

                            Judul Keluhan

                        </label>

                        <input
                        type="text"
                        name="judul"
                        class="form-control"
                        placeholder="Masukkan judul keluhan"
                        required>

                    </div>

                    <!-- Fasilitas -->

                    <div class="mb-3">

                        <label class="form-label">

                            Fasilitas

                        </label>

                        <select
                        name="fasilitas"
                        class="form-select"
                        required>

                            <option value="">-- Pilih Fasilitas --</option>

                            <option>Lampu</option>

                            <option>AC</option>

                            <option>Kipas Angin</option>

                            <option>Kamar Mandi</option>

                            <option>Pintu</option>

                            <option>Jendela</option>

                            <option>Listrik</option>

                            <option>Air</option>

                            <option>Wifi</option>

                            <option>Lainnya</option>

                        </select>

                    </div>

                    <!-- Deskripsi -->

                    <div class="mb-3">

                        <label class="form-label">

                            Deskripsi Kerusakan

                        </label>

                        <textarea
                        name="deskripsi"
                        rows="5"
                        class="form-control"
                        placeholder="Jelaskan kerusakan..."
                        required></textarea>

                    </div>

                    <!-- Prioritas -->

                    <div class="mb-3">

                        <label class="form-label">

                            Prioritas

                        </label>

                        <select
                        name="prioritas"
                        class="form-select">

                            <option value="Biasa">Biasa</option>

                            <option value="Penting">Penting</option>

                        </select>

                    </div>

                    <!-- Foto -->

                    <div class="mb-3">

                        <label class="form-label">

                            Upload Foto

                        </label>

                        <input
                        type="file"
                        name="foto"
                        class="form-control">

                    </div>

                    <button
                    class="btn btn-primary">

                        Simpan Keluhan

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include "../includes/footer.php"; ?>