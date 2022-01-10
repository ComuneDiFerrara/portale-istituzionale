<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\core
 * @category   CategoryName
 */

use yii\helpers\Html;
use yii\helpers\Url;
use open20\amos\dashboard\models\AmosWidgets;
use open20\amos\core\widget\WidgetAbstract;

////\bedezign\yii2\audit\web\JSLoggingAsset::register($this);
/* @var $this \yii\web\View */
/* @var $content string */

$urlCorrente   = Url::current();
$arrayUrl      = explode('/', $urlCorrente);
$countArrayUrl = count($arrayUrl);
$percorso      = '';
$i             = 0;
$moduloId      = Yii::$app->controller->module->id;
$basePath      = Yii::$app->getBasePath();
if ($moduloId != 'app-backend' && $moduloId != 'app-frontend') {
    $basePath = \Yii::$app->getModule($moduloId)->getBasePath();
    $percorso .= '/modules/' . $moduloId . '/views/' . $arrayUrl[$countArrayUrl - 2];
} else {
    $percorso .= 'views';
    while ($i < ($countArrayUrl - 1)) {
        $percorso .= $arrayUrl[$i] . '/';
        $i++;
    }
}
if ($countArrayUrl) {
    $posizioneEsclusione = strpos($arrayUrl[$countArrayUrl - 1], '?');
    if ($posizioneEsclusione > 0) {
        $vista = substr($arrayUrl[$countArrayUrl - 1], 0, $posizioneEsclusione);
    } else {
        $vista = $arrayUrl[$countArrayUrl - 1];
    }
    if (file_exists($basePath . '/' . $percorso . '/help/' . $vista . '.php')) {
        $this->params['help'] = [
            'filename' => $vista
        ];
    }
    if (file_exists($basePath . '/' . $percorso . '/intro/' . $vista . '.php')) {
        $this->params['intro'] = [
            'filename' => $vista
        ];
    }
}
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>

    <?= $this->render(
        "parts" . DIRECTORY_SEPARATOR . "head",
        ['title' => ((Yii::$app->get('menu', false)) && !empty($this->params['titleSection'])) ? $this->title['titleSection'] : $this->title]
    );
    ?>
</head>

<body>

    <!-- add for fix error message Parametri mancanti -->
    <input type="hidden" id="saveDashboardUrl" value="<?= Yii::$app->urlManager->createUrl(['dashboard/manager/save-dashboard-order']); ?>" />

    <?php $this->beginBody() ?>

    <?php if (Yii::$app->get('menu', false)) { ?>
        <?php
        $mainMenu      = (isset(\Yii::$app->params['menuCmsConfigurations']['mainCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['mainCmsMenu']
            : 'default';
        $secondaryMenu = (isset(\Yii::$app->params['menuCmsConfigurations']['secondaryCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['secondaryCmsMenu']
            : 'secondary';
        $footerMenu    = (isset(\Yii::$app->params['menuCmsConfigurations']['footerCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['footerCmsMenu']
            : 'footer';


        if ((isset(\Yii::$app->params['layoutConfigurations']['customPlatformPluginMenu']))) {
            $pluginMenu = $this->render(
                \Yii::$app->params['layoutConfigurations']['customPlatformPluginMenu'],
                [
                    'currentAsset' => $currentAsset,
                ]
            );
        } else {
            if (!\Yii::$app->params['layoutConfigurations']['hideCmsMenuPluginHeader']) {
                $pluginMenu = open20\amos\core\module\AmosModule::getModulesFrontEndMenus();
            }
        }

        $iconSubmenu    = '<span class="am am-chevron-right am-4"> </span>';
        $cmsDefaultMenu = app\components\CmsHelper::BiHamburgerMenuRender(
            Yii::$app->menu->findAll([
                'depth' => 1,
                'container' => $mainMenu
            ]),
            $iconSubmenu,
            'cms-menu-container-default',
            false
        );
        $cmsDefaultMenu .= $pluginMenu;
        ?>
        <?=
            $this->render(
                "parts" . DIRECTORY_SEPARATOR . "bi-less-header",
                [
                    'cmsDefaultMenu' => $cmsDefaultMenu,
                    'cmsSecondaryMenu' => $cmsSecondaryMenu,
                    'privacyPolicyLink' => \Yii::$app->params['linkConfigurations']['privacyPolicyLinkCommon'],
                    'cookiePolicyLink' => \Yii::$app->params['linkConfigurations']['cookiePolicyLinkCommon'],
                    'hideHamburgerMenu' => \Yii::$app->params['layoutConfigurations']['hideHamburgerMenuHeader'],
                    'alwaysHamburgerMenu' => \Yii::$app->params['layoutConfigurations']['showAlwaysHamburgerMenuHeader'],
                    'hideLangSwitchMenu' => \Yii::$app->params['layoutConfigurations']['hideLangSwitchMenuHeader'],
                    'hideGlobalSearch' => \Yii::$app->params['layoutConfigurations']['hideGlobalSearchHeader'],
                    'hideUserMenu' => ((\Yii::$app->params['layoutConfigurations']['hideUserMenuHeader']) || (\Yii::$app->view->params['hideUserMenuHeader'])),
                    'fluidContainerHeader' => ((\Yii::$app->params['layoutConfigurations']['fluidContainerHeader']) || (\Yii::$app->view->params['fluidContainerHeader'])),
                    'customUserMenu' => \Yii::$app->params['layoutConfigurations']['customUserMenuHeader'],
                    'customUserNotLogged' => \Yii::$app->params['layoutConfigurations']['customUserNotLoggedHeader'],
                    'customUserMenuLoginLink' => \Yii::$app->params['linkConfigurations']['loginLinkCommon'],
                    'userProfileLinkCommon' => \Yii::$app->params['linkConfigurations']['userProfileLinkCommon'],
                    'customUserMenuLogoutLink' => \Yii::$app->params['linkConfigurations']['logoutLinkCommon'],
                    'showSocial' => \Yii::$app->params['layoutConfigurations']['showSocialHeader'],
                    'showSecondaryMenu' => \Yii::$app->params['layoutConfigurations']['showSecondaryMenuHeader'],
                    'disableThemeLight' => \Yii::$app->params['layoutConfigurations']['disableThemeLightHeader'],
                    'disableSmallHeader' => \Yii::$app->params['layoutConfigurations']['disableSmallHeader'],
                    'enableHeaderSticky' => \Yii::$app->params['layoutConfigurations']['enableHeaderStickyHeader'],
                    'frontendUrl' => \Yii::$app->params['platform']['frontendUrl'],
                ]
            );
        ?>
        <!--< ?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>-->
    <?php } else { ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "header"); ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>

    <?php } ?>

    <?php if (isset(Yii::$app->params['logo-bordo'])) : ?>
        <div class="container-bordo-logo"><img src="<?= Yii::$app->params['logo-bordo'] ?>" alt=""></div>
    <?php endif; ?>

    <section id="bk-page" class="fullsizeListLayout">

        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "messages"); ?>

        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "help"); ?>

        <div class="container <?= (!empty($this->params['containerFullWidth']) && $this->params['containerFullWidth']
                                    == true) ? 'container-full-width' : ''
                                ?>">

            <div class="page-content">

                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-breadcrumbs"); ?>

                <?php if (
                    !empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine']
                    == WidgetAbstract::ENGINE_ROWS
                ) : ?>

                    <?php
                    $isLayoutInScope = false;
                    $moduleCwh = \Yii::$app->getModule('cwh');
                    if (isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
                        $scope = $moduleCwh->getCwhScope();
                        $isLayoutInScope = (!empty($scope)) ? true : false;
                    }
                    ?>

                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "network_scope",['isLayoutInScope' => $isLayoutInScope]); ?>
                <?php endif; ?>

                <div class="page-header">
                    <?php if ((Yii::$app->get('menu', false)) && is_array($this->params)) { ?>
                        <?=
                            $this->render(
                                "parts" . DIRECTORY_SEPARATOR . "bi-plugin-header",
                                [
                                    'isGuest' => \Yii::$app->user->isGuest,
                                    'modelLabel' => (!empty($this->params['modelLabel']) ? $this->params['modelLabel'] : ''),
                                    'titleSection' => (!empty($this->params['titleSection']) ? $this->params['titleSection']
                                        : ''),
                                    'subTitleSection' => (!empty($this->params['subTitleSection']) ? $this->params['subTitleSection']
                                        : ''),
                                    'urlLinkAll' => (!empty($this->params['urlLinkAll']) ? $this->params['urlLinkAll'] : ''),
                                    'labelLinkAll' => (!empty($this->params['labelLinkAll']) ? $this->params['labelLinkAll']
                                        : ''),
                                    'titleLinkAll' => (!empty($this->params['titleLinkAll']) ? $this->params['titleLinkAll']
                                        : ''),
                                    'labelManage' => (!empty($this->params['labelManage']) ? $this->params['labelManage'] : ''),
                                    'titleManage' => (!empty($this->params['titleManage']) ? $this->params['titleManage'] : ''),
                                    'urlManage' => (!empty($this->params['urlManage']) ? $this->params['urlManage'] : ''),
                                    'urlCreate' => (!empty($this->params['urlCreate']) ? $this->params['urlCreate'] : ''),
                                    'labelCreate' => (!empty($this->params['labelCreate']) ? $this->params['labelCreate'] : ''),
                                    'titleCreate' => (!empty($this->params['titleCreate']) ? $this->params['titleCreate'] : ''),
                                    'manageLink' => (!empty($this->params['manageLink']) ? $this->params['manageLink'] : ''),
                                    'hideCreate' => (!empty($this->params['hideCreate']) ? $this->params['hideCreate'] : ''),
                                    
                                ]
                            );
                        ?>

                    <?php } else { ?>
                        <?php if (!is_null($this->title)) : ?>
                            <h1 class="title"><?= Html::encode($this->title) ?></h1>
                            <?= $this->render("parts" . DIRECTORY_SEPARATOR . "textHelp"); ?>
                        <?php endif; ?>
                    <?php } ?>

                </div>

                <?php if (array_key_exists('currentDashboard', $this->params)) : ?>
                    <div class="col-xs-12 nop">
                        <?php
                        $items                = [];
                        $widgetsIcons         = $thisDashboardWidgets = $this->params['currentDashboard']->getAmosWidgetsSelectedIcon(true);
                        if (\Yii::$app->controller->hasProperty('child_of')) {
                            $widgetsIcons->andFilterWhere([AmosWidgets::tableName() . '.child_of' => \Yii::$app->controller->child_of]);
                        }

                        foreach ($widgetsIcons->all() as $widgetIcon) {
                            if (Yii::$app->user->can($widgetIcon['classname'])) {
                                $widgetObj                       = Yii::createObject($widgetIcon['classname']);
                                $label                           = $widgetObj->bulletCount ? $widgetObj->label . '<span class="badge badge-default">' . $widgetObj->bulletCount . '</span>'
                                    : $widgetObj->label;
                                $items[$widgetIcon['classname']] = ['label' => $label, 'url' => $widgetObj->url];
                            }
                        }

                        echo \open20\amos\core\toolbar\Nav::widget([
                            'items' => $items,
                            'encodeLabels' => false,
                            'options' => ['class' => 'nav nav-tabs'],
                        ]);
                        ?>
                    </div>
                <?php endif; ?>

                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "change_view"); ?>

                <?= $content ?>
            </div>
        </div>

    </section>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "sponsors"); ?>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-backtotop-button"); ?>

    <?php if (Yii::$app->get('menu', false)) { ?>
        <?php
        $iconSubmenu   = '<span class="am am-chevron-right am-4"> </span>';
        $cmsFooterMenu = app\components\CmsHelper::BiHamburgerMenuRender(
            Yii::$app->menu->findAll([
                'depth' => 1,
                'container' => 'footer'
            ]),
            $iconSubmenu,
            'cms-menu-container-footer',
            true
        );
        if ((isset(\Yii::$app->params['layoutConfigurations']['customPlatformFooter']))) :

            $customPlatformFooter = \Yii::$app->params['layoutConfigurations']['customPlatformFooter'];
            echo $this->render(
                $customPlatformFooter,
                [
                    'currentAsset' => $currentAsset,
                    'cmsFooterMenu' => $cmsFooterMenu
                ]
            );

        endif;
        ?>
    <?php } else { ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer_text"); ?>
    <?php } ?>








    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "assistance"); ?>

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>