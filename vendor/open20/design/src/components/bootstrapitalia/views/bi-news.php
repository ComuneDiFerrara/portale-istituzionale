<?php

use open20\design\utility\DateUtility;
use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$direction = (isset($itemDirection)) ? 'flex-xl-' . $itemDirection : '';
$categorySize  = (isset($categorySize)) ? $categorySize  : 'h6';
$titleSize = (isset($titleSize)) ? $titleSize : 'h5';
$descriptionSize = (isset($descriptionSize)) ? $descriptionSize : '';
$showSignature = (isset($showSignature)) ? $showSignature : 'false';
$showAvatar = (isset($showAvatar)) ? $showAvatar : 'true';
$avatarWrapperSize = (isset($avatarWrapperSize)) ? $avatarWrapperSize : 'md';

//https://www.php.net/manual/en/datetime.format.php
$day = DateUtility::getDate($date, 'php:d');
$month = DateUtility::getDate($date, 'php:M');
$year = DateUtility::getDate($date, 'php:Y');
$date = DateUtility::getDate($date);



$labelReadMore = (isset($labelReadMore)) ? $labelReadMore : 'Leggi tutto';
$titleReadMore = (isset($titleReadMore)) ? $titleReadMore : 'Leggi la notizia' . ' ' . $title;

?>

<div class="container-news <?= $widthColumn ?> <?= $carouselClass ?>">
    <div class="card-wrapper">
        <div class="card card-img <?= $direction ?>">
            <?php if ((isset($image))) : ?>
                <div class="img-responsive-wrapper position-relative">
                    <div class="image-wrapper position-relative h-100">
                        <a href="<?= $url ?>" title="Vai alla news <?= $title ?>">
                            <img src="<?= $image ?>" alt="immagine evento" class="community-image img-fluid w-100 mh-100" />
                        </a>
                        <div class="card-calendar d-flex flex-column justify-content-center position-absolute rounded-0 text-uppercase">
                            <span class="card-day font-weight-bold text-600 lead"><?= $day ?></span>
                            <span class="card-month font-weight-bold text-600"><?= $month ?></span>
                            <span class="card-year font-weight-light text-600 small"><?= $year ?></span>
                        </div>


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
            <?php endif; ?>
            <div class="card-body px-0 py-2">
                <?php if (!(isset($hideCategory)) && !(isset($image))) : ?>
                    <div class="category-top">
                        <a class="category" href="javascript:void(0)"><?= $category ?></a>
                        <span class="<?= ($category) ? "data" : "card-day" ?>"><?= $date ?></span>
                    </div>
                <?php endif; ?>
                <?php if ($showAvatar) : ?>
                    <?=
                        $this->render(
                            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
                            [
                                'nameSurname' => $nameSurname,
                                'imageAvatar' => $imageAvatar,
                                'url' => $urlAvatar,
                                'additionalInfo' => 'TODO',
                                'removeLink' => $removeLink,
                                'avatarWrapperSize' => $avatarWrapperSize,
                                'extraTextSize' => $extraTextSize

                            ]
                        );
                    ?>
                    <hr class="w-75 my-2 ml-0">
                <?php endif; ?>
                
                <?php if (!$hideCategory) : ?>
                    <p class="card-category text-secondary small font-weight-normal mb-0"><?= $category ?></p>
                <?php endif; ?>
                <a href="<?= $url ?>" class=" link-list-title " title="Vai alla news <?= $title ?>">
                    <h3 class="card-title mb-2 <?= $titleSize ?>"><?= $title ?></h3>
                </a>
                
                <?php if (!empty($subtitle)) : ?>
                <p class="h6"><?= $subtitle ?></p>
                <hr class="w-75 my-2 ml-0">
                <?php endif; ?>
                <p class=" <?= $descriptionSize ?> card-description font-weight-light"><?= $description ?></p>
                <?php if (!($showSignature)) : ?>
                    <span class="card-signature"><?= 'di' . ' ' . $nameSurname ?> </span>
                <?php endif; ?>
                <a class="read-more" href="<?= $url ?>" title="<?= $titleReadMore ?>">
                    <span class="text"><?= $labelReadMore ?></span>
                    <svg class="icon">
                        <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-arrow-right"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>