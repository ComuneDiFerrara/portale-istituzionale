<?php

use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);


$arr = explode(' ', trim($nameSurname));
$name = $arr[0];
$surname = $arr[1];
$initials = substr($name, 0, 1) . substr($surname, 0, 1);
$titlelink = 'Visualizza il profilo di' . ' ' . $nameSurname;
$tooltipText = '<strong>' . $nameSurname . '</strong>' . (isset($role) ? '<br/><em>' . $role . '</em>' : '');  //se esiste un campo role apposta mettere quel campo al posto di addiotional info
$removeLink = (isset($removeLink)) ? $removeLink : false;

$avatarWrapperSize = (isset($avatarWrapperSize)) ? $avatarWrapperSize : 'md';
if ($avatarWrapperSize == 'xl') {
  $avatarClassSize = 'size-xl';
  $extraTextSize = (isset($extraTextSize)) ? $extraTextSize : 'lead';
} else if ($avatarWrapperSize == 'lg') {
  $avatarClassSize = 'size-lg';
  $extraTextSize = (isset($extraTextSize)) ? $extraTextSize : '';
} else if ($avatarWrapperSize == 'sm') {
  $avatarClassSize = 'size-sm';
  $extraTextSize = (isset($extraTextSize)) ? $extraTextSize : 'small';
  $initials = substr($name, 0, 1);
} else if ($avatarWrapperSize == 'xs') {
  $avatarClassSize = 'size-xs';
  $extraTextSize = (isset($extraTextSize)) ? $extraTextSize : 'small';
  $initials = substr($name, 0, 1);
} else {
  $avatarClassSize = 'size-md';
  $extraTextSize = (isset($extraTextSize)) ? $extraTextSize : 'small';
}

$statoProfilo = (isset($statoProfilo)) ? $statoProfilo : 'Da validare';
if ($statoProfilo == 'Validato') {
  $statoProfiloIcon = 'account-check';
  $statoProfiloClass = 'success';
} else if ($statoProfilo == 'Non validato') {
  $statoProfiloIcon = 'account-cancel';
  $statoProfiloClass = 'danger';
} else if ($statoProfilo == 'Modifica in corso') {
  $statoProfiloIcon = 'account-edit';
  $statoProfiloClass = 'warning';
} else {
  $statoProfiloIcon = 'account-question';
  $statoProfiloClass = 'secondary';
}


$buttonCtaMsgClass = (isset($buttonCtaMsgClass)) ? $buttonCtaMsgClass : 'btn-primary';
$buttonCtaJoinClass = (isset($buttonCtaJoinClass)) ? $buttonCtaJoinClass : 'btn-secondary';

?>
<div class="user-list-wrapper row border-bottom border-light py-3 variable-gutters">

  <div class="col-md-3 d-flex align-items-center mb-2 mb-md-0">
    <div class="avatar size-md mr-2">
      <?php if (!(isset($imageAvatar))) : ?>
        <p aria-hidden="true"><?= $initials ?></p>
        <span class="sr-only"><?= $nameSurname ?></span>
      <?php else : ?>
        <img src="<?= $imageAvatar ?>" alt="<?= $nameSurname ?>">
      <?php endif ?>
    </div>
    <div>
      <a href="<?= $url ?>" class="stretched-link">
        <p class="font-weight-bold mb-0 avatar-name"><?= $nameSurname ?></p>
      </a>
    </div>

  </div>
  <div class="col-md-4 col-sm-6 text-secondary small d-flex align-items-center">
    <div class="text-truncate d-flex align-items-center" data-toggle="tooltip" title="Collaborazione prevalente: <?= $collaborazionePrevalente ?>">
      <span>
        <svg class="icon icon-sm icon-secondary mr-1">
          <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#briefcase-account"></use>
        </svg>
      </span>

      <span class="sr-only">Collaborazione prevalente:</span><span class="text-truncate"><?= $collaborazionePrevalente ?></span>
    </div>

  </div>
  <div class="col-md-2 col-sm-6 text-secondary small d-flex align-items-center">
    <div class="text-truncate d-flex align-items-center" data-toggle="tooltip" title="Facilitatore: <?= $facilitatore ?>">
      <span>
        <svg class="icon icon-sm icon-secondary mr-1">
          <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#badge-account"></use>
        </svg>
      </span>
      <span class="sr-only">Facilitatore:</span><span class="text-truncate"><?= $facilitatore ?></span>
    </div>

  </div>
  <div class="col-md-3 small text-secondary d-flex align-items-center d-flex justify-content-end mt-2 mt-md-0">
    
    <div class="user-status">
      <div class="d-flex align-items-center" data-toggle="tooltip" title="Stato profilo utente: <?= $statoProfilo ?>">
      <div>
        <span class="avatar bg-white border border-<?= $statoProfiloClass ?>">
          <svg class="icon icon-<?= $statoProfiloClass ?>">
            <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#<?= $statoProfiloIcon ?>"></use>
          </svg>
          
        </span>
      </div>
        <span class="ml-2 d-flex d-md-none small"><?= $statoProfilo ?></span>
      </div>
    </div>
    <div class="user-actions ml-auto pl-2">
    <?php if (isset($showCtaMsg)) : ?>
      <a href="<?= $urlCtaMsg ?>" class="btn <?= $buttonCtaMsgClass ?> py-1 btn-xs title-one-line" title="<?= $ctaTitleMsg ?> <?= ' ' . $nameSurname ?>"><?= $ctaMsg ?></a>
    <?php endif; ?>

    <?php if (isset($showCtaJoin)) : ?>
      <a href="<?= $urlCtaJoin ?>" class="btn <?= $buttonCtaJoinClass ?> py-1 btn-xs title-one-line" title="<?= $ctaJoinMsg ?> <?= ' ' . $nameSurname ?> "> <?= $ctaJoinMsg ?></a>
    <?php endif; ?>
    </div>
    
  </div>

</div>