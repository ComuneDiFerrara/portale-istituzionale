<?php

use open20\design\utility\DateUtility;
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

//https://www.php.net/manual/en/datetime.format.php
$dateLastSyncDrive = DateUtility::getDate($dateSyncDrive, 'php:d/m/Y');
$hourLastSyncDrive = DateUtility::getDateHour($dateSyncDrive, 'php:H:i');


$type = strtoupper($type);
$date = DateUtility::getDate($date);
$customTooltipInfo = (isset($customTooltipInfo)) ? $customTooltipInfo . ' (' . $type . ' - ' . $size . ')' : '';
$lastSyncDrive = (isset($dateSyncDrive)) ? 'Documento Google Drive<br>aggiornato il: ' . $dateLastSyncDrive . ' alle ' . $hourLastSyncDrive  : false;
$infoDoc = '<strong>Pubblicato da</strong>' . ' ' . $nameSurname . ' ' . 'il' . ' ' . $date;
$infoDoc = (isset($category)) ? $infoDoc . '<strong> nella categoria:</strong>' . ' ' . $category : $infoDoc;
$infoDoc = (isset($community)) ? $infoDoc . ' ' . '<strong> in community:</strong>' . ' ' . $community : $infoDoc;
$widthColumn = (isset($widthColumn)) ? $widthColumn :  'col-md-4 col-sm-6';


?>
<div class="<?= $widthColumn ?>">
  <div class="card-wrapper card-space documenti-card-wrapper pb-4 <?= ($typeFolder) ? 'card-type-folder' :  ''; ?>">
    <div class="card card-bg">
      <div class="card-body">
        <div class="categoryicon-top">
          <svg class="icon icon-secondary">
            <?php if ((in_array(strtolower($type), ['jpg', 'png', 'jpeg', 'svg']))) : ?>
              <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#file-image"></use>
            <?php elseif ((in_array(strtolower($type), ['pdf']))) : ?>
              <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#file-pdf"></use>
            <?php elseif ((in_array(strtolower($type), ['doc', 'docx']))) : ?>
              <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#file-word"></use>
            <?php elseif ((in_array(strtolower($type), ['xls', 'xlsx']))) : ?>
              <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#file-excel"></use>
            <?php elseif ((in_array(strtolower($type), ['zip', 'rar']))) : ?>
              <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#folder-zip"></use>
            <?php elseif ((in_array(strtolower($typeFolder), ['folder']))) : ?>
              <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#folder"></use>
            <?php else : ?>
              <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#file-link"></use>
            <?php endif ?>
          </svg>
          <?php if ($dateSyncDrive) : ?>
            <svg class="icon icon-xs icon-overlay bg-google-drive icon-padded rounded-circle icon-white" data-toggle="tooltip" data-html="true" title="<?= $lastSyncDrive ?>">
              <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#google-drive"></use>
            </svg>
          <?php endif ?>

          <?php if (!isset($size) && (!isset($typeFolder))) : ?>
            <span class="text mr-1">LINK ESTERNO</span>
          <?php elseif (!isset($size) && (isset($typeFolder))) : ?>
            <span class="text mr-1">CARTELLA</span>
          <?php else : ?>
            <span class="text mr-1"><?= $type ?></span>
          <?php endif ?>

          <?php if (isset($size)) : ?>
            <span class="text text-capitalize">(<?= $size ?>Kb)</span>
          <?php endif ?>




          <div class="info-doc-top-right ml-auto d-flex align-items-center">
            <!-- < ?= ContextMenuWidget::widget([
              'model' => $model,
              'layout' => '@vendor/open20/design/src/components/bootstrapitalia/views/bi-context-menu-widget.php',

              // 'actionModify' => "/news/news/update?id=" . $model->id,
              // 'actionDelete' => "/news/news/delete?id=" . $model->id,
              // 'labelDeleteConfirm' => AmosNews::t('amosnews', 'Sei sicuro di voler cancellare questa notizia?'),
              // 'modelValidatePermission' => 'NewsValidate'
            ]) ?> -->
            <?php
            echo $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-context-menu-widget'
            );
            ?>

          </div>


        </div>
        
        <a href="<?= $url ?>" class="link-list-title" title="Dettaglio documento <?= $title ?>">
          <h6 class="card-title mb-2 title-three-line"><?= $title ?></h6>
        </a>
        

        
        <?php if (($newPubblication)) : ?>
          
            <?php
            echo $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-badge-new-pubblication'
            );
            ?>
          
        <?php endif; ?>
        
        <?php if (isset($versionFile)) : ?>
          <div class="blockquote-footer"><cite title="versione file">versione <?= $versionFile ?></cite></div>

        <?php endif ?>
        <!-- <div class="card-text text-sans-serif">< ?= $infoDoc ?></div> -->


        <?php if (isset($typeFolder)) : ?>
          <a class="read-more" href="<?= $url ?>">Apri cartella</a>
        <?php elseif (!isset($size) && (!isset($typeFolder))) : ?>
          <a class="read-more" href="<?= $url ?>">Apri file </a>
        <?php else : ?>
          <a href="<?= $fileUrl ?>" title="Scarica il documento principale: <?= $fileName ?>" data-toggle="tooltip" class="read-more" download>
            Scarica file
          </a>
        <?php endif ?>
        <a href="javascript:void(0)" data-toggle="tooltip" data-html="true" title="<?= $infoDoc ?>" class="info-doc">
          <svg class="icon icon-sm icon-info">
            <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#information-outline"></use>
          </svg>
        </a>
      </div>
    </div>
  </div>
</div>