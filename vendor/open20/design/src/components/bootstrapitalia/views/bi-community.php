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


$image = (isset($image)) ? $image :  'https://picsum.photos/800/450?random=6';
$isSigned = (isset($isSigned)) ? $isSigned :  false;

$labelCtaSubscribe = (isset($customLabelCtaSubscribe)) ? $customLabelCtaSubscribe : 'Richiedi iscrizione';
$labelCtaWaiting = (isset($customLabelCtaWaiting)) ? $customLabelCtaWaiting : 'Richiesta iscrizione inviata';
$labelCtaWaitingTooltip = (isset($customLabelCtaWaitingTooltip)) ? $customLabelCtaWaitingTooltip : 'Sei in attesa che un community manager convalidi la richiesta per poter accedere alla community';
$labelCtaView = (isset($labelCtaView)) ? $labelCtaView : 'Accedi alla community';

if ($isReservedCommunity) {
    $tooltipTitle = "Community riservata";
    $tooltipClass = "bg-danger";
    $tooltipIcon = "domino-mask";
} else if ($isPrivateCommunity) {
    $tooltipTitle = "Community privata";
    $tooltipClass = "bg-warning";
    $tooltipIcon = "lock";
} else {
    //isOpenCommunity
    $tooltipTitle = "Community aperta";
    $tooltipClass = "bg-success";
    $tooltipIcon = "lock-open";
}

$js = <<<JS
$(document).ready(function () {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0|| !!navigator.userAgent.match(/Trident.*rv\:11\./)) //Seleziona solo IE
    {   
        var max = 55;
        var tot, str;
        $('.community-title').each(function() {
            str = String($(this).html());
            tot = str.length;
            str = (tot <= max) ? str : str.substring(0,(max + 1))+"...";
            $(this).html(str);
        });
    }
});
JS;
$this->registerJs($js);

?>

<div class="community-container p-3 <?= $widthColumn ?> d-flex flex-column justify-content-center align-items-center mb-5">
    <div class="position-relative">
        <div class="community-image">
            <?php if ($isReservedCommunity && !$isSigned) { ?>
                <img alt="immagine community" class="rounded h-100 w-100" src="<?= $image ?>">
            <?php } else { ?>
                <a href="<?= $url ?>" title="<?= $title ?>">
                    <img alt="immagine community" class="rounded h-100 w-100" src="<?= $image ?>">
                </a>
            <?php } ?>
        </div>
        <a href="javascript::void(0)" class="position-absolute" data-toggle="tooltip" title="<?= $tooltipTitle ?>">
            <svg class="icon icon-white icon-sm p-1 rounded-circle <?= $tooltipClass ?>" role="img">
                <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#<?= $tooltipIcon ?>"></use>
            </svg>
        </a>
    </div>
    <div class="community-title-container py-3 ">
        <?php if ($isReservedCommunity && !$isSigned) { ?>
            <h3 class="community-title h6 font-weight-bold pb-0 mb-0 text-center overflow-hidden"><?= $title ?></h3>
        <?php } else { ?>
            <a href="<?= $url ?>" class=" title-two-line link-list-title " title="Vai alla community <?= $title ?>">
                <h3 class="community-title h6 font-weight-bold pb-0 mb-0 text-center overflow-hidden"><?= $title ?></h3>
            </a>
        <?php } ?>
    </div>
    <div class="mt-auto">


        <?php if ($isSigned) : ?>
            <div class="button-container w-100 d-flex justify-content-center border-top">
                <a href="<?= $url ?>" class="btn btn-primary btn-xs mt-4"><?= $labelCtaView ?></a>
            </div>
        <?php else : ?>
            <?php if ($isOpenCommunity) : ?>
                <div class="button-container w-100 d-flex justify-content-center border-top">
                    <a href="<?= $url ?>" class="btn btn-secondary btn-xs my-3 mt-4"><?= $labelCtaView ?></a>
                </div>
            <?php elseif ($isReservedCommunity) : ?>
                <div class=" w-100 d-flex justify-content-center border-top">
                    <p class="d-flex align-items-end text-muted mt-4">
                        <?= $labelCtaWaiting ?>
                        <a href="javascript::void(0)" class="bi-form-field-tooltip-info" data-toggle="tooltip" data-html="true" data-original-title="Sei in attesa che un community manager convalidi la richiesta per poter accedere alla community">
                            <span class="icon ml-1">
                                <svg class="icon icon-xs design-theme-fill-text-muted">
                                    <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-info-circle"></use>
                                </svg>
                            </span>
                            <span class="sr-only">Sei in attesa di risposta da parte dei community manager</span>
                        </a>
                    </p>
                </div>
            <?php else : ?>
                <!-- $isPrivateCommunity -->
                <!-- I can see private community only isSigned -->
            <?php endif ?>
        <?php endif ?>
    </div>
</div>