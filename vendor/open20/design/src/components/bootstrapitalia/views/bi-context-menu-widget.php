<?php

use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

?>
<div class="dropdown dropdown-manage dropleft">
  <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownManageMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <svg class="icon icon-xs icon-info">
      <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#cog"></use>
    </svg>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownManageMenu">
    <div class="link-list-wrapper">
      <ul class="link-list">
        <li><a class="list-item" href="#"><span>Modifica</span></a></li>
        <li><a class="list-item" href="#"><span>Cancella</span></a></li>
      </ul>
    </div>
  </div>
</div>