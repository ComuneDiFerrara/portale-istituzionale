<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\design\layout
 * @category   CategoryName
 */

namespace open20\design\assets;

use yii\web\AssetBundle;

/**
 * Class BootstrapItaliaDesignAsset
 * @package open20\design\assets
 */

class BootstrapItaliaDesignAsset extends AssetBundle
{
    public $sourcePath = '@vendor/open20/design/src/assets/resources/bootstrapitaliacustom';

    // public $biSpriteUrl = '@vendor/open20/design/src/assets/resources/bootstrapitaliacustom/node_modules/bootstrap-italia/dist/svg';
    // public $materialSpriteUrl = '@vendor/open20/design/src/assets/resources/bootstrapitaliacustom/sprite';
    // public $jiraSpriteUrl = '@vendor/open20/design/src/assets/resources/bootstrapitaliacustom/sprite';

    public $js = [
        'node_modules/bootstrap-italia/dist/js/bootstrap-italia.bundle.min.js', //mantenere come prima riga
        'js/bootstrap-italia-custom.js',
        'js/carousel-preference.js',
        'js/header-height.js',
        'js/footer-height.js', 
        'js/main-height.js',
        'node_modules/svgxuse/svgxuse.min.js', //per far vedere le icone in IE
    ];

    public $css = [
      'MaterialDesign-Webfont-master/css/materialdesignicons.min.css',
      'https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css',
      'scss/main-design.scss'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
