// ===================================
// TOGGLE SIDEBAR (HAMBURGER MENU)
// ===================================
function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    var overlay = document.getElementById('sidebarOverlay');

    if (sidebar) {
        sidebar.classList.toggle('active');
    }
    if (overlay) {
        overlay.classList.toggle('active');
    }
}

// Tutup sidebar otomatis saat salah satu menu diklik (khusus mobile)
document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById('sidebar');
    if (!sidebar) return;

    var links = sidebar.querySelectorAll('a.nav-link');
    links.forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                toggleSidebar();
            }
        });
    });
});
