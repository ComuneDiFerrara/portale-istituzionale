<?php

use open20\design\utility\DateUtility;
use open20\amos\core\forms\ItemAndCardHeaderWidget;

use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\admin\widgets\UserCardWidget;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$avatarWrapperSize = (isset($avatarWrapperSize)) ? $avatarWrapperSize : 'sm';
$date = DateUtility::getDate($date);
$updatedAt = DateUtility::getDate($updatedAt);
?>



<div class="discussion-container py-3 border-bottom border-light">
  <div class="row align-items-center variable-gutters">
    <div class="generic-info d-flex col-12">
      <h3 class="discussion-title h5 mb-2 font-weight-bold">
        <a class="title-one-line link-list-title" href="<?= $url ?>" title="partecipa alla discussione <?= $title ?>"><?= $title ?></a>

      </h3>
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
    <div class="col-md-5">
      <?php if (isset(($communityTitle))) : ?>
        <div class="mb-1 community-title small text-muted"><strong>Community:</strong> <?= $communityTitle ?></div>
      <?php endif ?>
      <div class="other-info d-flex small">
        <div class="d-flex flex-wrap">

          <div class="pr-3 mb-0 "><?= $date ?></div>
        </div>
        <a class="read-more d-inline ml-auto ml-md-0" href="<?= $url ?>" title="partecipa alla discussione <?= $title ?>">Partecipa</a>
      </div>
    </div>


    <div class="col-md-3 col-sm-6">

      <div class="user-list-container d-flex">
        <div class="admin-container">
          <?php
          if (!empty($model)) {
            echo ItemAndCardHeaderWidget::widget([
              'model' => $model,
              'publicationDateField' => 'created_at',
              'class' => 'no-margin nop',
              'enableLink' => false,
            ]);
          }
          ?>
        </div>

        <div class="partecipant-list">
          <?php

          foreach ($partecipants as $partecipant) {
            if ($partecipant) {
              echo UserCardWidget::widget(['model' => $partecipant, 'avatarXS' => true, 'enableLink' => false]);
            }
          }
          ?>
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar-group-stacked',
              [

                'numberExpose' => 4,
                'usersNumber' => 7
              ]

            );
          ?>
        </div>
      </div>


    </div>

    <div class="col-md-4 col-sm-6 small">

      <div class="justify-content-between d-flex">
        <div aria-label="Numero di risposte alla discussione:  <?= $numbersOfAnswer ?> " class="d-flex align-items-center" data-toggle="tooltip" title="Numero di risposte alla discussione: <?= $numbersOfAnswer ?>">
          <svg class="icon icon-xs d-flex  mr-1" role="img" aria-label="Numero risposte">
            <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#message-outline"></use>
          </svg>
          <?= $numbersOfAnswer ?>
        </div>
        <div aria-label="Numero di visite alla discussione: " class="d-flex align-items-center" data-toggle="tooltip" title="Numero visite">
          <svg class="icon icon-xs d-flex  mr-1" role="img" aria-label="Numero visite">
            <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#eye-outline"></use>
          </svg>
          <?= $numbersOfVisits ?>
        </div>
        <div aria-label="Ultima attività nella discussione: " class="d-flex align-items-center" data-toggle="tooltip" title="Ultima attività">
          <svg class="icon icon-xs d-flex mr-1" role="img" aria-label="Ultima attività">
            <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#clock-outline"></use>
          </svg>
          <?= $updatedAt ?>
        </div>
      </div>

    </div>
  </div>
</div>