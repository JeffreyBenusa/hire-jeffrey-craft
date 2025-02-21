document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.querySelector('[aria-controls="mobile-menu"]');
    const mobileMenu = document.getElementById('mobile-menu');

    /**
     * Toggles the mobile menu visibility and updates aria attributes.
     */
    function toggleMobileMenu() {
        const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', !isExpanded);
        menuButton.setAttribute('aria-label', !isExpanded ? 'Close menu' : 'Open menu');
        mobileMenu.classList.toggle('hidden');
    }

    /**
     * Handles focus trapping within the mobile menu for accessibility.
     * @param {Event} event - The keydown event.
     */
    function handleFocusTrap(event) {
        if (event.key === 'Tab') {
            const focusableElements = mobileMenu.querySelectorAll('a, button');
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            // Loop focus within the menu
            if (event.shiftKey && document.activeElement === firstElement) {
                lastElement.focus();
                event.preventDefault();
            } else if (!event.shiftKey && document.activeElement === lastElement) {
                firstElement.focus();
                event.preventDefault();
            }
        }
    }

    /**
     * Closes the mobile menu when the Escape key is pressed.
     * @param {Event} event - The keydown event.
     */
    function handleEscapeKey(event) {
        if (event.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
            closeMobileMenu();
        }
    }

    /**
     * Closes the mobile menu and resets aria attributes.
     */
    function closeMobileMenu() {
        menuButton.setAttribute('aria-expanded', 'false');
        mobileMenu.classList.add('hidden');
    }

    /**
     * Closes the mobile menu when resizing the viewport above 640px (40rem).
     */
    function handleResize() {
        if (window.innerWidth >= 640) {
            closeMobileMenu();
        }
    }

    // Event listeners
    menuButton.addEventListener('click', toggleMobileMenu);
    mobileMenu.addEventListener('keydown', handleFocusTrap);
    document.addEventListener('keydown', handleEscapeKey);
    window.addEventListener('resize', handleResize);
});
