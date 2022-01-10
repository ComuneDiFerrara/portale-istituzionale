<?php
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
  $nameSize = 'h5';
} else if ($avatarWrapperSize == 'lg') {
  $avatarClassSize = 'size-lg';
  $extraTextSize = (isset($extraTextSize)) ? $extraTextSize : '';
  $nameSize = 'h5';
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

$buttonCtaMsgClass=(isset($buttonCtaMsgClass)) ? $buttonCtaMsgClass : 'btn-primary';
$buttonCtaJoinClass=(isset($buttonCtaJoinClass)) ? $buttonCtaJoinClass : 'btn-secondary';

?>

<div class="avatar-wrapper avatar-extra-text mb-0  justify-content-start <?= $additionalClass ?> <?= $singleElementsWidthFullsize ?> <?= $singleElementsWidthMobile ?>">
  <?php if (!$removeLink) : ?>
    <a href="<?= $url ?>" class="avatar <?= $avatarClassSize ?>" <?= isset($showTooltip) ? 'data-toggle="tooltip" data-html="true" ' : '' ?> title="<?= isset($showTooltip) ? $tooltipText : $titlelink ?>">
      <?php if (!(isset($imageAvatar))) : ?>
        <p aria-hidden="true"><?= $initials ?></p>
        <span class="sr-only"><?= $nameSurname ?></span>
      <?php else : ?>
        <img src="<?= $imageAvatar ?>" alt="<?= $nameSurname ?>">
      <?php endif ?>
    </a>
  <?php else : ?>
   <div class="avatar <?= $avatarClassSize ?>">
    <?php if (!(isset($imageAvatar))) : ?>
      <p aria-hidden="true"><?= $initials ?></p>
      <span class="sr-only"><?= $nameSurname ?></span>
      
    <?php else : ?>
      <img src="<?= $imageAvatar ?>" alt="<?= $nameSurname ?>">
      
    <?php endif ?>
    </div>
  <?php endif; ?>
  <div class="ml-2 <?= $extraTextSize ?> ">
    <?php if (!(isset($hideNameSurname))) : ?>
      <?php if ($removeLink) : ?>
        <p class="font-weight-bold mb-0 avatar-name <?= $nameSize ?>"><?= $nameSurname ?></p>
      <?php else : ?>
        <p class="font-weight-bold mb-0 avatar-name <?= $nameSize ?>"><a href="<?= $url ?>" class="namesurname" title="<?= $titlelink ?>"><?= $nameSurname ?></a></p>
      <?php endif ?>
    <?php endif; ?>
    <p class="additional-info font-weight-normal mb-0 text-secondary small"><?= $additionalInfo ?></p>

    <?php if (isset($showCtaMsg)) : ?>
      <a href="<?= $urlCtaMsg ?>" class="btn <?= $buttonCtaMsgClass ?> btn-xs py-1" title="<?= $ctaTitleMsg ?> <?= ' ' . $nameSurname ?>"><?= $ctaMsg ?></a>
    <?php endif; ?>

    <?php if (isset($showCtaJoin)) : ?>
      <a href="<?= $urlCtaJoin ?>" class="btn <?= $buttonCtaJoinClass ?> btn-xs py-1" title="<?= $ctaJoinMsg ?> <?= ' ' . $nameSurname ?> "> <?= $ctaJoinMsg ?></a>
    <?php endif; ?>

  </div>
</div>