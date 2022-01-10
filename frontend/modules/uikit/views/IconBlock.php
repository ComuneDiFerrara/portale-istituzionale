<?php
use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
?>
<?php
    switch($data['icon_type'])
    {
        case 1:
?>
        <svg class="icon <?=$data['icon_class']?>" role="img">
            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#<?=$data['icon_name'] ?>"></use>
        </svg>
<?php
        break;
        case 2:
?>
        <svg class="icon <?=$data['icon_class']?>" role="img" >
             <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#<?=$data['icon_name'] ?>"></use>
        </svg>
<?php
        break;
    }
?>