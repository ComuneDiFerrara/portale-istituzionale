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


$infoDoc = '<strong>Pubblicata da</strong>' . ' ' . $nameSurname . ' ' . '<strong>il</strong>' . ' ' . $date;
$infoDoc .= (isset($category)) ? $infoDoc . ' ' . '<strong>in</strong>' . ' ' . $category : $infoDoc;
$infoDoc .= (isset($community)) ? $infoDoc . ' ' . '<strong>per</strong>' . ' ' . $community : $infoDoc;

?>

<div class="document-item-container border-bottom py-4">
    <div>
        <div class="d-flex align-items-start mb-2">


            <a class="link-list-title " href="<?= $url ?>" title="Vai al documento <?= $title ?>">
                <h5 class="mb-0"><?= $title ?></h5>
            </a>
            <div class="other-info-item d-flex align-items-center justify-content-end ml-auto">

                <?php if (($newPubblication)) : ?>
                    <div class="ml-2">
                        <?php
                        echo $this->render(
                            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-badge-new-pubblication'
                        );
                        ?>
                    </div>
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
        <?php if (isset($description)) : ?>
            <p class="text-secondary mb-2"><?= $description ?></p>
        <?php endif ?>
        <div class="small mb-2">
            <?= $infoDoc ?>
        </div>
        <div>
            <a href="<?= $fileUrl ?>" title="Scarica il documento <?= $fileName ?>" class="read-more d-inline mr-2" download>Scarica</a>
            <span class="text-muted small">
                <?= '(' . $type . ' - ' . $size . ')' ?>
            </span>
        </div>
    </div>

</div>
<!-- <div class="ml-auto">
        <a href="<?= $url ?>" title="Vedi dettaglio <?= $title ?>">
            <svg class="icon icon-white p-2 rounded-circle bg-primary" role="img">
                <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#file-find"></use>
            </svg>
        </a>
    </div> -->