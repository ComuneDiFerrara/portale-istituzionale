
<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    [NAMESPACE_HERE]
 * @category   CategoryName
 */

use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$forceAlwaysOnlyGuestCta = (isset($forceAlwaysOnlyGuestCta) && $forceAlwaysOnlyGuestCta) ? true : false;
?>


<?php if ((!\Yii::$app->user->isGuest && \Yii::$app->user->id != Yii::$app->params['platformConfigurations']['guestUserId']) && !$forceAlwaysOnlyGuestCta ): ?>
    <div class="testata-cta-plugin d-flex mb-3">
        <div class="pr-2">
                <p class="h2 title-<?= $modelLabel ?> text-uppercase mb-0"><?= $titleSectionLogged ?></p>
        </div>
        <div class="cta-container d-flex flex-grow-1 justify-content-center">
            <a href="<?= $viewAllLink ?>" class="link-all-<?= $modelLabel ?> d-flex align-items-center" title="<?= $titleLinkAll ?>"><?= $labelLinkAll ?>
                <svg class="icon rounded-circle icon-xs d-flex ml-2" role="img">
                    <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#arrow-right"></use>
                </svg>
            </a>
            <div class="d-flex">
                <a href="<?= $createNewLink ?>" class="cta link-my-<?= $modelLabel ?> d-flex align-items-center <?= $btnClass ?>" title="<?= $titleCta ?>"><?= $labelCta ?>
                    <svg class="icon rounded-circle icon-xs d-flex ml-2" role="img">
                        <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#plus"></use>
                    </svg>
                </a>

                <a href="#" class="gestisci link-my-<?= $modelLabel ?> d-flex align-items-center <?= $btnClass ?>" title="<?= $titleManage ?>"><?= $labelManage ?>
                    <svg class="icon rounded-circle icon-xs d-flex ml-2 " role="img">
                        <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#cog"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="testata-cta-plugin d-flex mb-3">
        <div>
            <p class="h2 title-<?= $modelLabel ?> text-uppercase mb-0"><?= $titleSectionGuest ?></p>
        </div>
        <!--a differenza delle pagine del plugin qui ci va, perchè non siamo nelle pagine di lista completa-->
        <div class="cta-container d-flex flex-grow-1 justify-content-end ">
            <a href="<?= $viewAllLink ?>?reset-scope=true" class="link-all-<?= $modelLabel ?> d-flex align-items-center" title="<?= $titleLinkAll ?>"><?= $labelLinkAll ?>
                <svg class="icon rounded-circle icon-xs d-flex ml-2" role="img">
                    <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#arrow-right"></use>
                </svg>
            </a>
        </div>
    </div>
<?php endif ?>