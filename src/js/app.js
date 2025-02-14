// Styles
import './../css/main.css'

// Images
import './../img/hirejeffrey/HireJeffrey-Long.svg'

import './header';
import './consent';

// Accept HMR as per: https://vitejs.dev/guide/api-hmr.html
if (import.meta.hot) {
    import.meta.hot.accept(() => {
        console.log("HMR")
    });
}