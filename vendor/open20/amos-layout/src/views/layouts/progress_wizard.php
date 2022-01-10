<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\core\views\layouts
 * @category   CategoryName
 */


//\bedezign\yii2\audit\web\JSLoggingAsset::register($this);
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var \open20\amos\core\components\PartQuestionarioAbstract $partsQuestionario */
/* @var $content string */

$urlCorrente = Url::current();
$arrayUrl = explode('/', $urlCorrente);
$countArrayUrl = count($arrayUrl);
$percorso = '';
$i = 0;
$moduloId = Yii::$app->controller->module->id;
$basePath = Yii::$app->getBasePath();
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
}

$script = <<< SCRIPT
$(document).ready(function (){

    setTimeout(function (){

        var errori = $('.error-regionale');
        if($(errori).length){
            $(".error-summary-fake").fadeIn();
        }else{
            $(".error-summary-fake").fadeOut();
        }

    }, 500 );

    $('body').on('afterValidate', 'form' , function (){

        setTimeout(function (){
            var errori = $('.error-regionale');
                if($(errori).length){
                    $(".error-summary-fake").fadeIn();
                }else{
                    $(".error-summary-fake").fadeOut();
                }
        },500);

    });

    $('body').on('change', 'input' , function (){

        setTimeout(function (){
            var errori = $('.error-regionale');
                if(!$(errori).length){
                    $(".error-summary-fake").fadeOut();
                }
        },500);


    });

});
SCRIPT;

$this->registerJs($script, \yii\web\View::POS_END, 'my-options');

?>


<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "head"); ?>
</head>

<body>

    <?php $this->beginBody() ?>

    <?php if (Yii::$app->get('menu', false)) { ?>
        <?php
        $mainMenu = (isset(\Yii::$app->params['menuCmsConfigurations']['mainCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['mainCmsMenu'] : 'default';
        $secondaryMenu = (isset(\Yii::$app->params['menuCmsConfigurations']['secondaryCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['secondaryCmsMenu'] : 'secondary';
        $footerMenu = (isset(\Yii::$app->params['menuCmsConfigurations']['footerCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['footerCmsMenu'] : 'footer';

        if (!\Yii::$app->params['layoutConfigurations']['hideCmsMenuPluginHeader']) {
            $pluginMenu = open20\amos\core\module\AmosModule::getModulesFrontEndMenus();
        }

        $iconSubmenu = '<span class="am am-chevron-right am-4"> </span>';
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
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-less-header", [
            //'currentAsset' => $currentAsset,
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
        ]); ?>
        <!--< ?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>-->
    <?php } else { ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "header"); ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>

    <?php } ?>

    <?php if (isset(Yii::$app->params['logo-bordo'])) : ?>
        <div class="container-bordo-logo"><img src="<?= Yii::$app->params['logo-bordo'] ?>" alt=""></div>
    <?php endif; ?>

    <section id="bk-page" class="fullsizeWizardLayout">
        <div class="container-messages">
            <div class="container">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "messages"); ?>
            </div>
        </div>

        <div class="container-help">
            <div class="container">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "help"); ?>
            </div>
        </div>

        <div class="container">
            <div class="page-content">
                <?php if (!isset($this->params['hideBreadcrumb']) || ($this->params['hideBreadcrumb'] === false)) : ?>
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "breadcrumb"); ?>
                <?php endif; ?>
                <div class="page-header">
                    <?php if (!isset($this->params['hideWizardTitle']) || ($this->params['hideWizardTitle'] === false)) : ?>
                        <h1 class="title"><?= Html::encode($this->title) ?></h1>
                    <?php endif; ?>
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "textHelp"); ?>
                </div>
                <div class="col-sm-12 progress-menu-container">
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "progress_wizard_menu", [
                        'model' => $this->params['model'],
                        'partsQuestionario' => $this->params['partsQuestionario'],
                        'hidePartsLabel' => (isset($this->params['hidePartsLabel']) ? $this->params['hidePartsLabel'] : false),
                        'hidePartsUrl' => (isset($this->params['hidePartsUrl']) ? $this->params['hidePartsUrl'] : false)
                    ]);
                    ?>
                </div>
                <div class="col-sm-12">
                    <div class="error-summary-fake" style="display: none;">
                        <?php
                        \yii\bootstrap\Alert::begin([
                            'closeButton' => false,
                            'options' => [
                                'class' => 'danger alert-danger error-summary',
                            ],
                        ]);
                        \yii\bootstrap\Alert::end();
                        ?>
                    </div>
                </div>

                <?= $content ?>

            </div>
        </div>
    </section>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "sponsors"); ?>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer_text"); ?>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "assistance"); ?>

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>