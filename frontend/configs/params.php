<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\basic\template
 * @category   CategoryName
 */

$googleMapsApiKey = '';

return [
    'versione' => '1.0.0', // Version
    'user.passwordResetTokenExpire' => 86400*7,
    'google-maps' => [
        'key' => $googleMapsApiKey
    ],
    'googleMapsApiKey' => $googleMapsApiKey,
    'google_recaptcha_site_key' => '',
    'google_recaptcha_secret' => '',
    'noWizardNewLayout' => true,
    'menuModules' => [
        'organizationalunit',
        'person',
        'service',
        'dataset',
        'documenti',
        'news',
        'events',
        'amosadmin',
        'tag',
        'cmsbridge'
    ],
    'dashboardEngine' => 'rows',
    'hideTagWidgetHeader' => true,
    'template_argomento' => 196,
    'menu_argomento' => 2,

    'searchFieldsMatch' => [
        'status' => true
    ],
];
