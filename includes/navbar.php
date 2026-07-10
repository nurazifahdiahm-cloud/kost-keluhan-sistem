<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container-fluid">

<button class="btn-hamburger d-lg-none" id="hamburgerBtn" type="button" onclick="toggleSidebar()" aria-label="Buka menu">
&#9776;
</button>

<a class="navbar-brand fw-bold" href="#">
🏠 Sistem Keluhan Kost
</a>

<div class="ms-auto text-white">

Selamat Datang,

<strong>

<?php
echo $_SESSION['nama'];
?>

</strong>

</div>

</div>

</nav>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>