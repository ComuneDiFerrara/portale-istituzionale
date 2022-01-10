<?php

use open20\design\utility\DateUtility;

use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);


$image = (isset($image)) ? $image :  'https://picsum.photos/1600/900?random=5';
$theme = (isset($theme)) ? $theme :  'light';

$labelCtaSubscribe = (isset($customLabelCtaSubscribe)) ? $customLabelCtaSubscribe : 'Iscriviti all\'evento';
$labelCtaView = (isset($customLabelCtaView)) ? $customLabelCtaView : 'Accedi';

if (strpos($urlCta, 'event-signup') !== false) {
    $titleLinkCta = (isset($titleLinkCta)) ?: 'Iscriviti all\'evento' . ' ' . $title;
    $labelCta = $labelCtaSubscribe;
    $classCta = 'btn-primary';
}
if (strpos($urlCta, 'view') !== false) {
    $urlCta = (isset($urlCta)) ? $urlCta : $url;
    $titleLinkCta = (isset($titleLinkCta)) ?: 'Maggiori informazioni sull\'evento' . ' ' . $title;
    $labelCta = $labelCtaView;
    $classCta = 'btn-secondary';
}
if (strpos($urlCta, 'open-join') !== false) {
    $urlCta = (isset($urlCta)) ? $urlCta : $url;
    $titleLinkCta = (isset($titleLinkCta)) ?: 'Maggiori informazioni sull\'evento' . ' ' . $title;
    $labelCta = $labelCtaView;
    $classCta = 'btn-secondary';
}

$classType = strtolower($type);

$paidLabel = ($isPaid) ? 'a pagamento' : '';
$availableSeatsLabel = (isset($availableSeats)) ? '(disponibili' . ' ' . $availableSeats . ' ' . 'posti)' : '';
$infos = ($isPaid) ? $type . ', ' . $paidLabel . ' ' . $availableSeatsLabel : $type;

//https://www.php.net/manual/en/datetime.format.php
$dayStart = DateUtility::getDate($dateHourStart, 'php:d');
$monthStart = DateUtility::getDate($dateHourStart, 'php:M');
$yearStart = DateUtility::getDate($dateHourStart, 'php:Y');
$hourStart = DateUtility::getDateHour($dateHourStart, 'php:H:i');

?>

<div class="event-container d-flex flex-column <?= $theme ?>-theme">
    <div class="d-flex flex-column-reverse flex-md-row h-100">
        <div class="time-event d-flex flex-row flex-md-column mb-3 mb-md-0 mr-md-3">
            <div class="date py-2 px-2 px-sm-3 d-flex flex-md-column justify-content-md-center align-items-center text-uppercase flex-md-grow-1">
                <p class="day-event pr-1 pr-md-0 font-weight-bold mb-0 h2"><?= $dayStart ?></p>
                <p class="month-event font-weight-bold pr-1 pr-md-0 mb-0 h4"><?= $monthStart ?></p>
                <p class="year-event font-weight-normal mb-0 h4"><?= $yearStart ?></p>
            </div>
            <div class="hour d-flex align-items-center justify-content-start py-3 px-2 px-sm-3 ml-auto bg-secondary text-white">
                <svg class="icon icon-sm d-flex icon-white smr-1" role="img" aria-label="Ora di inizio evento">
                    <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#clock-outline"></use>
                </svg>
                <p class="mb-0 ml-2"><?= $hourStart ?></p>
            </div>

        </div>
        <div class="external-image-container w-100 h-100">
            <div class="image-wrapper">
                <a href="<?= $url ?>" title="Dettagli evento <?= $title ?>">
                    <img class="community-image img-fluid w-100" src="<?= $image ?>" alt="immagine evento" />
                </a>
                <!--    < ?php if (!$inScope) : ?>
                    <span class="badge badge-< ?= $classType ?> mb-0 p-1">< ?= $type ?>
                </span>
                < ?php endif ?> -->
            </div>
            <div class="other-info-item d-flex align-items-center pl-3">
                <?php if (($newPubblication)) : ?>
                    <?php
                    echo $this->render(
                        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-badge-new-pubblication'
                    );
                    ?>
                <?php endif; ?>
                <div class="ml-2">
                    <?php
                    echo $this->render(
                        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-context-menu-widget'
                    );
                    ?>
                </div>

            </div>
        </div>

    </div>
    <?php if (!$inScope) : ?>
        <a href="<?= $url ?>" class="link-list-title mt-md-4 mb-0" title="Dettagli evento <?= $title ?>">
            <h3 class="h5 title-one-line font-weight-bold mb-0"><?= $title ?></h3>
        </a>
        <p class="event-summary mb-0"><?= $summary ?></p>
    <?php endif ?>
    <a href="<?= $urlCta ?>" class="btn <?= $classCta ?> my-3 align-self-start" title="<?= $titleLinkCta ?>">
        <?= $labelCta ?>
    </a>
</div>