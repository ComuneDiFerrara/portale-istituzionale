<?php

/* 
 * To change this proscription header, choose Proscription Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 //i+1 per numero el
 //mettere numero massimo di 4?
use open20\design\utility\DateUtility;
use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$day = (isset($day)) ? $day : DateUtility::getDate($item ['info_date'], 'php:d');
$month = (isset($month)) ? $month : DateUtility::getDate($item ['info_date'], 'php:M');
$year = (isset($year)) ? $year : DateUtility::getDate($item ['info_date'], 'php:Y');

?>






<?php if($i%4==0 || $i%4==1 || ($i%4==2 && count($data['items'])==$i+1 )): ?><!--primo template card lunghe-->
   
    <div class="container-news d-flex h-100">
        <div class="card-wrapper shadow">
            <div class="card card-img d-flex flex-column ">
                <?php if($item['image']): ?>
                    <div class="image-wrapper position-relative w-100">
                        <div class="h-100 majory-news-card-image-wrapper">
                            <a href="<?= $item ['link'] ?>" target="_blank"  title="<?=  $item ['title'] ?>" class="el-link">
                                <img src="<?= $item['image']?>" class="el-image" alt="<?= $attrs_image['alt'] ?>">
                            </a>
                            <?php if($item ['info_date']): ?>
                                <div class="card-calendar position-absolute rounded-0">
                                    <div class="card-day font-weight-bold text-600 lead uk-margin">
                                        <?= $day ?>
                                    </div>
                                    <div class="card-month font-weight-bold text-600 small text-uppercase">
                                        <?= $month ?>
                                    </div>
                                    <div class="card-year font-weight-light text-600 small ">
                                        <?= $year ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="card-body flex-grow-1 d-flex flex-column">
                    <div class="h5 card-title mb-0 d-none d-xl-block link-list-title">
                        <a href="<?= $item ['link'] ?>" title="Vai alla pagina <?= $item ['link']  ?>">
                            <?= $item ['title'] ?>
                        </a>
                    </div>
                    <div class="py-3 flex-grow-1 uk-margin">
                        <?= $item ['content'] ?>
                    </div>
                    <div >
                        <a class="read-more flex-grow-1 align-items-end" target="_blank" title="Vai alla pagina <?=$item ['title']?>" href="<?=$item ['link']?>">
                        Leggi di più →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?><!--secondo template card su 2 righe-->
    
    <div class="box-card bg-white shadow-lg flex-grow-1 <?=  ($i%2==0 && count($data['items'])>$i+1)? 'mb-3' : '' ?>">
        <div class="py-3 h-100 d-flex flex-column">
            <div class="categoria-box-card px-4 pb-2 d-flex align-items-center">
                <!--icona bi-->
                <?php if( $item ['icon_type']==1): ?>
                <svg class="icon icon-padded rounded-circle icon-white bg-primary d-flex  mr-1" role="img">
                        <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#<?= $item ['icon_name'] ?> "></use>
                </svg>
                <?php else : ?>
                <!--icona material-->
                <svg class="icon icon-padded rounded-circle icon-white bg-primary d-flex  mr-1" role="img">
                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#<?= $item ['icon_name'] ?>"></use>
                </svg> 
                <?php endif; ?> 
                <p class="title-category font-weight-bold text-uppercase primary-color"><?=  $item ['info_type'] ?></p>
            </div>
            <div class="px-4 flex-grow-1">
                    <div class="h5 card-title mb-0 link-list-title uk-margin">
                        <a href="<?= $item ['link'] ?>" target="_blank"  title="Vai alla pagina <?=$item ['title']?>"><?= $item ['title'] ?></a>
                    </div>
                    <div class="text-serif">
                        <?= $item ['content'] ?>
                    </div>
            </div>
            <div class="cta-box-card  px-4 py-3">
                    <a href="<?= $item ['link'] ?>" target="_blank" title="<?=$item ['title']?>" class="read-more flex-grow-1 align-items-end"> Leggi di più →</a>
            </div>
        </div>
    </div>
<?php endif; ?>
