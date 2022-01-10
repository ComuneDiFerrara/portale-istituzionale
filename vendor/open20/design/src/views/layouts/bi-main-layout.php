<?php

/** do not delete asset */

use open20\design\assets\BootstrapItaliaDesignAsset;

$currentAsset = BootstrapItaliaDesignAsset::register($this);

?>

<!-- usata per CMS Luya -->
<?php $customBehavior ?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">



<head>
<?php if ((isset(\Yii::$app->params['layoutConfigurations']['customPlatformHead']))) : ?>
        <?php
        $customPlatformHead = \Yii::$app->params['layoutConfigurations']['customPlatformHead'];
        echo $this->render($customPlatformHead, [
            'currentAsset' => $currentAsset,
        ]);
?>
<?php else: ?>
    
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-head", [
        'currentAsset' => $currentAsset
    ]); ?>
<?php endif ?>
</head>

<body class="bg-body position-relative">
    <?php $this->beginBody() ?>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-skiplink", [
        'currentAsset' => $currentAsset,
    ]); ?>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-header", [
        'currentAsset' => $currentAsset,
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
        'customUserMenuLogoutLink' => \Yii::$app->params['linkConfigurations']['logoutLinkCommon'],
        'customUserProfileLink' => \Yii::$app->params['linkConfigurations']['userProfileLinkCommon'],
        'showSocial' => \Yii::$app->params['layoutConfigurations']['showSocialHeader'],
        'showSecondaryMenu' => \Yii::$app->params['layoutConfigurations']['showSecondaryMenuHeader'],
        'disableThemeLight' => \Yii::$app->params['layoutConfigurations']['disableThemeLightHeader'],
        'disableSmallHeader' => \Yii::$app->params['layoutConfigurations']['disableSmallHeader'],
        'enableHeaderSticky' => \Yii::$app->params['layoutConfigurations']['enableHeaderStickyHeader'],
    ]); ?>

    <div id="mainContent" class="d-flex <?= \Yii::$app->view->params['customClassMainContent'] ?>">

        <main role="main" class="w-100 bg-white <?= (\Yii::$app->params['layoutConfigurations']['enableHeaderStickyHeader']) ? 'mt-0' : '' ?>">
            <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-messages", [
                'currentAsset' => $currentAsset
            ]); ?>

            <?php if ((!(\Yii::$app->params['layoutConfigurations']['hideBreadcrumbs']) || (!\Yii::$app->view->params['hideBreadcrumbs']))) : ?>
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-breadcrumbs", [
                    'currentAsset' => $currentAsset
                ]); ?>
            <?php endif ?>

            <?php if (\Yii::$app->view->params['enablePLuginHeader']) : ?>
                <?= $this->render(
                    "parts" . DIRECTORY_SEPARATOR . "bi-plugin-header",
                    [
                        'title' => $this->titlePlugin,
                        'helpText' => $this->textPluginHeader,
                    ]
                ); ?>
            <?php endif ?>

            <?php if ((\Yii::$app->view->params['enablePLuginToolbar'])) : ?>
                <?= $this->render(
                    "parts" . DIRECTORY_SEPARATOR . "bi-plugin-toolbar"); ?>
            <?php endif ?>

            <?php if ($this instanceof AmosView) : ?>
                <?php $this->beginViewContent() ?>
            <?php endif; ?>
            <?= $content ?>
            <?php if ($this instanceof AmosView) : ?>
                <?php $this->endViewContent() ?>
            <?php endif; ?>
        </main>

    </div>

    <?php if ((isset(\Yii::$app->params['layoutConfigurations']['customPlatformFooter']))) : ?>
        <?php
        $customPlatformFooter = \Yii::$app->params['layoutConfigurations']['customPlatformFooter'];
        echo $this->render($customPlatformFooter, [
            'currentAsset' => $currentAsset,
            'cmsFooterMenu' => $cmsFooterMenu
        ]);
        ?>
    <?php else : ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-footer", [
            'currentAsset' => $currentAsset,
            'cmsFooterMenu' => $cmsFooterMenu,
            'cmsDefaultMenu' => $cmsDefaultMenu
        ]); ?>
    <?php endif; ?>

    <?php if (!isset(\Yii::$app->params['layoutConfigurations']['hideCookieBar'])) : ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-cookiebar", [
            'currentAsset' => $currentAsset,
            'cookiePolicyLink' => \Yii::$app->params['linkConfigurations']['cookiePolicyLinkCommon']
        ]); ?>
    <?php endif ?>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-backtotop", [
        'currentAsset' => $currentAsset,
    ]); ?>


    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>