// Define the cookie name and expiration
const COOKIE_NAME = "gtm_cookie_consent";
const COOKIE_EXPIRATION_DAYS = 365; // 1 year

// Function to set a cookie with encoding
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    const encodedValue = encodeURIComponent(JSON.stringify(value));
    document.cookie = `${name}=${encodedValue}; path=/; SameSite=Lax; Secure${expires}`;
}

// Function to get and decode a cookie
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
        return decodeURIComponent(parts.pop().split(";").shift());
    }
    return null;
}

// Define default consent settings (all granted)
const consentSettings = {};

// Check if cookie exists, otherwise set it
let storedConsent = getCookie(COOKIE_NAME);
if (!storedConsent) {
    setCookie(COOKIE_NAME, consentSettings, COOKIE_EXPIRATION_DAYS);
    storedConsent = consentSettings;
}