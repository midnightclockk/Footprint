/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

console.log('scripts.js loaded');

function toggleSidebar(show) {
    const sidebarOverlay = document.body.querySelector('#sidebarOverlay');
    if (show === undefined) {
        document.body.classList.toggle('sb-sidenav-toggled');
    } else if (show) {
        document.body.classList.add('sb-sidenav-toggled');
    } else {
        document.body.classList.remove('sb-sidenav-toggled');
    }
    // Show/hide overlay for mobile
    if (sidebarOverlay) {
        if (document.body.classList.contains('sb-sidenav-toggled')) {
            sidebarOverlay.style.display = 'block';
        } else {
            sidebarOverlay.style.display = 'none';
        }
    }
}

document.addEventListener('click', function(event) {
    // Sidebar toggle button (handle clicks on button or its children)
    if (event.target.closest && event.target.closest('#sidebarToggle')) {
        console.log('Sidebar toggle button clicked');
        event.preventDefault();
        toggleSidebar();
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        return;
    }
    // Sidebar close button
    if (event.target.closest && event.target.closest('#sidebarCloseBtn')) {
        toggleSidebar(false);
        return;
    }
    // Sidebar overlay
    if (event.target.closest && event.target.closest('#sidebarOverlay')) {
        toggleSidebar(false);
        return;
    }
});

// Hide overlay on resize if sidebar is not toggled
window.addEventListener('resize', function() {
    const sidebarOverlay = document.body.querySelector('#sidebarOverlay');
    if (sidebarOverlay && !document.body.classList.contains('sb-sidenav-toggled')) {
        sidebarOverlay.style.display = 'none';
    }
});
