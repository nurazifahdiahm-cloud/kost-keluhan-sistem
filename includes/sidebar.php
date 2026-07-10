<div class="sidebar bg-dark text-white p-3" id="sidebar">
    <button class="sidebar-close btn text-white" onclick="toggleSidebar()">&times;</button>
    <h5>Menu</h5>

    <hr>

    <ul class="nav flex-column">

    <?php if($_SESSION['role']=="admin"){ ?>

        <li class="nav-item">
            <a href="../admin/dashboard.php" class="nav-link text-white">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="../admin/dashboard.php" class="nav-link text-white">
                Kelola Keluhan
            </a>
        </li>

        <li class="nav-item">
            <a href="../admin/profil.php" class="nav-link text-white">
                Profil
            </a>
        </li>

        <li class="nav-item">
            <a href="../logout.php" class="nav-link text-danger">
                Logout
            </a>
        </li>

    <?php } else { ?>

        <li class="nav-item">
            <a href="../user/dashboard.php" class="nav-link text-white">
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="../user/tambah_keluhan.php" class="nav-link text-white">
                Tambah Keluhan
            </a>
        </li>

        <li class="nav-item">
            <a href="../user/riwayat_keluhan.php" class="nav-link text-white">
                Riwayat Keluhan
            </a>
        </li>

        <li class="nav-item">
            <a href="../user/profil.php" class="nav-link text-white">
                Profil
            </a>
        </li>

        <li class="nav-item">
            <a href="../logout.php" class="nav-link text-danger">
                Logout
            </a>
        </li>

    <?php } ?>

    </ul>

</div>