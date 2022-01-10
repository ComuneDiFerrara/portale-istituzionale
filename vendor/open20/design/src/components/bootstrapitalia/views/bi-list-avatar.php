<?php

$singleElementsWidthFullsize = 12 / $elementsForRow;


?>


<div class="users-list-container d-flex justify-content-start flex-wrap ">
  <?=
    $this->render(
      '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
      [
        'nameSurname' => 'Mario Rossi',
        'avatarWrapperSize' => $avatarWrapperSize,
        'additionalClass' => 'border-bottom py-4',
        'singleElementsWidthFullsize' => 'col-md-' . $singleElementsWidthFullsize,

      ]
    );
  ?>

  <?=
    $this->render(
      '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
      [
        'nameSurname' => 'Mario Rossi',
        'avatarWrapperSize' => $avatarWrapperSize,
        'additionalClass' => 'border-bottom py-4',
        'singleElementsWidthFullsize' => 'col-md-' . $singleElementsWidthFullsize,
        'additionalInfo' => 'Consulente Marketing',

      ]
    );
  ?>


  <?=
    $this->render(
      '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
      [
        'nameSurname' => 'Mario Rossi',
        'avatarWrapperSize' => $avatarWrapperSize,
        'additionalClass' => 'border-bottom py-4',
        'singleElementsWidthFullsize' => 'col-md-' . $singleElementsWidthFullsize,
        'singleElementsWidthMobile' => 'col-xs-' . $singleElementsWidthMobile,
        'additionalInfo' => 'Consulente Marketing',
        'showCtaJoin' => 'true',
        'ctaJoinMsg' => 'Invia messaggio',
      ]
    );
  ?>
   <?=
    $this->render(
      '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
      [
        'nameSurname' => 'Massimiliano Giovannini',
        'avatarWrapperSize' => $avatarWrapperSize,
        'additionalClass' => 'border-bottom py-4',
        'singleElementsWidthFullsize' => 'col-md-' . $singleElementsWidthFullsize,
        'singleElementsWidthMobile' => 'col-xs-' . $singleElementsWidthMobile,
        'additionalInfo' => 'Consulente Marketing',
        'showCtaMsg' => 'true',
        'ctaMsg' => 'Collegati',
      ]
    );
  ?>

</div>