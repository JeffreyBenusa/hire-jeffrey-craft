document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.querySelector('[aria-controls="mobile-menu"]');
    const mobileMenu = document.getElementById('mobile-menu');

    // Toggle the mobile menu
    menuButton.addEventListener('click', function () {
        const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', !isExpanded); // Toggle the aria-expanded state
        mobileMenu.classList.toggle('hidden'); // Show/hide mobile menu
    });

    // Close the mobile menu when resizing above 40rem
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 640) { // 40rem in pixels is 640px
            menuButton.setAttribute('aria-expanded', 'false'); // Reset aria-expanded to false
            mobileMenu.classList.add('hidden'); // Ensure the menu is hidden
        }
    });
});