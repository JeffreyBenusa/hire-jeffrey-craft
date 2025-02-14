<?php

use craft\helpers\App;

return [
    'checkDevServer' => true,
    'devServerInternal' => 'http://localhost:3000',
    'devServerPublic' => App::env('PRIMARY_SITE_URL') . ':3000',
    'serverPublic' => App::env('PRIMARY_SITE_URL') . '/dist/',
    'useDevServer' => App::env('ENVIRONMENT') === 'dev' || App::env('CRAFT_ENVIRONMENT') === 'dev',

    // for Vite v4 and below
    // 'manifestPath' => '@webroot/dist/manifest.json',

    // for Vite >= v5
    'manifestPath' => '@webroot/dist/.vite/manifest.json'

    // other config settings...
];