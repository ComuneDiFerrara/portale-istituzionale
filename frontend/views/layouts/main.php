<?php

use app\modules\seo\frontend\behaviors\LuyaSeoBehavior;
use app\components\CmsHelper;
use open20\design\assets\BootstrapItaliaDesignAsset;
use yii\helpers\Html;


/* @var $this luya\web\View */
/* @var $content string */

$this->attachBehavior('seo', LuyaSeoBehavior::className());

$currentAsset = BootstrapItaliaDesignAsset::register($this);
$iconSubmenu = '<svg class="icon icon-xs"><use xlink:href="' . $currentAsset->baseUrl . '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-expand"></use></svg>';

$cmsDefaultMenu = CmsHelper::BiHamburgerMenuRender(
    Yii::$app->menu->findAll([
        'depth' => 1,
        'container' => 'default'
    ]),
    $iconSubmenu,
    'cms-menu-container-default',
    false
);

if (!\Yii::$app->user->isGuest) {
    $cmsDefaultMenuPlugin .= Html::tag(
        'li',
        Html::a(
            Html::tag('span', 'Gestisci') . $iconSubmenu,
            null,
            [
                'class' => 'nav-link dropdown-toggle nav-link-plugin' . ' ',
                'target' => '_self',
                'title' => 'Gestisci',
                'href' => '#',
                'data' =>
                [
                    'toggle' => 'dropdown'
                ],
                'aria' =>
                [
                    'expanded' => 'false'
                ]
            ]
        ) .
            Html::tag(
                'div',
                Html::tag(
                    'div',
                    Html::tag(
                        'ul',
                        open20\amos\core\module\AmosModule::getModulesFrontEndMenus(2),
                        [
                            'class' => 'link-list'
                        ]
                    ),
                    [
                        'class' => 'link-list-wrapper'
                    ]
                ),
                [
                    //'id' => 'menuPlugin',
                    'class' => 'dropdown-menu'
                ]
            ),
        [
            'class' => 'nav-item dropdown' . ' '
        ]
    );
    $cmsDefaultMenu .= $cmsDefaultMenuPlugin;
}

$cmsSecondaryMenu = CmsHelper::BiHamburgerMenuRender(
    Yii::$app->menu->findAll([
        'depth' => 1,
        'container' => 'secondary-menu'
    ]),
    $iconSubmenu,
    'cms-menu-container-secondary-menu',
    false
);
$cmsFooterMenu  = CmsHelper::BiHamburgerMenuRender(
    Yii::$app->menu->findAll([
        'depth' => 1,
        'container' => 'footer'
    ]),
    $iconSubmenu,
    'cms-menu-container-footer',
    true
);



echo Yii::$app->get('layoutmanager')->renderMainLayout([
    'cmsFooterMenu' => $cmsFooterMenu,
    'cmsDefaultMenu' => $cmsDefaultMenu,
    'cmsSecondaryMenu' => $cmsSecondaryMenu,
    'customBeavior' => $customBehavior,
    'currentAsset' => $currentAsset,
    'content' => $content
]);
