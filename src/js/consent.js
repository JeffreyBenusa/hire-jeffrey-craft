document.addEventListener("DOMContentLoaded", function () {
    const cookieName = "GTM_COOKIE_CONSENT";
    const cookieBanner = document.getElementById("cookieBanner");
    const acceptCookiesBtn = document.getElementById("acceptCookies");

    const DEFAULT_CONSENT = {
        accepted: false,
    };

    // Utility to handle cookies
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        document.cookie = `${name}=${encodeURIComponent(JSON.stringify(value))}; path=/; max-age=${days * 24 * 60 * 60}`;
    }

    function getCookie(name) {
        const cookieStr = document.cookie.split("; ").find(row => row.startsWith(`${name}=`));
        if (!cookieStr) {
            setCookie(name, DEFAULT_CONSENT, 365);
            return DEFAULT_CONSENT;
        }

        try {
            return JSON.parse(decodeURIComponent(cookieStr.split("=")[1]));
        } catch (err) {
            console.error(`Error parsing cookie ${name}:`, err);
            return DEFAULT_CONSENT;
        }
    }

    // Load and initialize consent data
    let consentData = getCookie(cookieName);

    // Show or hide the banner
    function toggleBanner(show) {
        show
            ? cookieBanner.classList.remove("hidden")
            : cookieBanner.classList.add("hidden");
    }

    // Set initial display based on consent
    toggleBanner(!consentData.accepted);

    // Event listener: Accept all cookies
    acceptCookiesBtn.addEventListener("click", function () {
        const newConsent = {
            accepted: true
        };
        setCookie(cookieName, newConsent, 365);
        toggleBanner(false);
    });
});