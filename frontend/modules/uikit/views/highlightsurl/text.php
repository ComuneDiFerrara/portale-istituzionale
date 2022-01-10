<?php

/* 
 * To change this proscription header, choose Proscription Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

?>

<div class="col-md-4 col-sm-6 ">
    <div class="box-card bg-white shadow-lg h-100">
        <div class="uk-container">
            <div class="py-3 h-100 d-flex flex-column">
                <div class="categoria-box-card px-4 pb-2 d-flex align-items-center">
                    <div class="uk-container mt-3">
                        <!--icona bi-->
                        <?php if( $item ['icon_type']==1): ?>
                        <svg class="icon icon-sm icon-card-gray d-flex  mr-1" role="img">
                                <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#<?= $item ['icon_name'] ?> "></use>
                        </svg>
                        <?php else : ?>
                        <!--icona material-->
                        <svg class="icon icon-sm icon-card-gray  d-flex  mr-1" role="img">
                                <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#<?= $item ['icon_name'] ?>"></use>
                        </svg> 
                        <?php endif; ?> 
                        <p class="title-category font-weight-bold text-uppercase"><?=  $item ['info_type'] ?></p>

                    </div>
                </div>
                <div class="px-4 flex-grow-1">
                    <div class="h5 text-black uk-margin">
                        
                        <a href="<?= $item ['link'] ?>" target="_blank"  title="<?=$item ['title']?>" class="text-black "> <?=$item ['title']?> </a>
                    </div>
                    <div class="pt-3">
                        <?= $item ['content'] ?>
                    </div>
                </div>
                <div class="cta-box-card  px-4 py-3 uk-section- uk-visible@xl uk-section">
                    <div class="read-more uk-margin">
                        <a href="<?= $item ['link'] ?>" target="_blank"  title="<?=$item ['title']?>" target="_blank" class="read-more flex-grow-1 align-items-end"> Leggi di più →</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>