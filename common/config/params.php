<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\basic\template
 * @category   CategoryName
 */



return [
    'google_places_api_key' => '',
    
    'supportEmail' => 'example@example.com',
    'widgetShareEmail' => 'site_here&body=',

    'favicon'=> '/img/favicon.png',
    'logoMail' => '/img/logo.png',
    'logoConfigurations' => [
        'firstLogo' => [
            'logoImg' => '/img/stemma-comune.svg',
            'logoAlt' => 'logo Comune di Ferrara',
            'logoUrl' => 'frontendUrl',
            'logoTitle' => 'Vai alla homepage',
            'logoStemmaText' => '/img/stemma-comune.svg',
            'logoText' => ' <span class="no_toc h2">Comune di Ferrara</span><span class="no_toc h3 d-none d-md-block">Città Patrimonio dell\'Umanità</span>',
        ],
        // 'secondLogo' => [
        //    'logoText' => 'Comune di Ferrara',
        // ],
        'topLogo' => [
            'logoText' => 'Regione Emilia Romagna',
            'logoClass' => 'mb-0',
            'logoUrl' => 'https://www.regione.emilia-romagna.it/',
            'logoTitle' => 'Vai al portale di Regione Emilia Romagna',
            'logoUrlTarget' => '_blank',
            'positionTop' => true,
        ]
    ],
    'layoutConfigurations' => [
        'customPlatformHead' => '@common/views/layouts/parts/bi-head',
        'customPlatformFooter' => '@common/views/layouts/parts/footer-custom',
        'customPlatformPluginMenu' => '@common/views/layouts/parts/plugin-menu-custom',
        'customUserNotLoggedHeader' => '@common/views/layouts/parts/header-user-notlogged-custom',
        'hideHamburgerMenuHeader' => false,
        'showAlwaysHamburgerMenuHeader' => false,
        'hideLangSwitchMenuHeader' => true,
        'hideGlobalSearchHeader' => false,
        'hideUserMenuHeader' => false,
        'hideSpidDescriptionLogin' => true,
        'showLiteModeLogin' => false,
        'showSocialHeader' => true,
        'showSecondaryMenuHeader' => true,
        'disableThemeLightHeader' => true,
        'enableHeaderStickyHeader' => true,
        'disableSmallHeader' => true
    ],
    'linkConfigurations' => [
        'privacyPolicyLinkCommon' => '/it/privacy-policy',
        'cookiePolicyLinkCommon' => '/it/privacy-policy',
        'loginLinkCommon' => '/site/login',
        'logoutLinkCommon' => '/site/logout',
    ],
    'socialConfigurations' => [
        'facebook' => 'https://www.facebook.com/comuneferrara',
        'instagram' => 'https://www.instagram.com/comunediferrara/',
        'twitter' => 'https://twitter.com/ComuneDiFerrara',
        'flickr' => 'https://www.flickr.com/photos/comuneferrara/',
        'youtube' => 'https://www.youtube.com/user/comuneferrara'
    ],
    'platformTextEditorClientOptions' => [
        'plugins' => [
            "paste link",
            "hr",
            "charactercount"
        ],
        'style_formats' => [
            array( 'title' => 'Headers', 'items' => [
			array( 'title'=> 'Heading 1', 'block'=> 'h1' ),
      		array( 'title'=> 'Heading 2', 'block'=> 'h2' ),
			array( 'title'=> 'Heading 3', 'block'=> 'h3' ),
			array( 'title'=> 'Heading 4', 'block'=> 'h4' ),
			array( 'title'=> 'Heading 5', 'block'=> 'h5' ),
			array( 'title'=> 'Heading 6', 'block'=> 'h6' ),
            ])
        ],
        'toolbar' => "fullscreen | undo redo | styleselect | bold italic strikethrough | alignleft aligncenter | bullist numlist | link | removeformat | hr ",
    ],
    // 'bsVersion' => '4.x', // this will load Bootstrap 4 for all Krajee extensions
    // 'bsDependencyEnabled' => false // this will not load Bootstrap CSS and JS for all Krajee extensions
];
