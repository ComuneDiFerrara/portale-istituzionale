<?php 

use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset  = BootstrapItaliaDesignAsset::register($this);


?>

<div class="row">
    <?php if( isset($rss_content_list) ) : ?>

        <?php foreach ($rss_content_list as $key => $item) : ?>
          
            <div class="col-md-4 my-2">
            
                <div class="box-card bg-white shadow-lg mb-3 h-100 d-flex">
                    <div class="py-3 flex-grow-1 d-flex flex-column">

                        <div class="categoria-box-card px-4 pb-2 d-flex align-items-center ">
                            <div class="d-flex align-items-center">                                       
                                <svg class="icon icon-padded rounded-circle icon-white bg-primary d-flex  mr-1">
                                    <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#newspaper-variant-outline"></use>
                                </svg>  
                                <div class="title-category font-weight-bold text-uppercase uk-margin uk-margin">
                                    <p class="primary-color">COMUNICATI STAMPA</p>
                                </div>
                            </div>
                        </div>

                        <!-- title -->  
                        <div class="h5 card-title px-4 link-list-title uk-margin mb-2">
                            <a class="text-black" target="_blank" href="<?= $item['link'] ?>"><?= $item['title'] ?></a>
                        </div>

                        <!-- description -->
                        <div class="px-4 text-serif flex-grow-1">
                           <?= is_string($item['description']) ? $item['description'] : '' ?>
                        </div>
                       
                       <div class="px-4 blockquote-footer">
                            <?php $result=str_replace("www.", "",parse_url($item['link'], PHP_URL_HOST)) ?>
                            <cite>da <?= $result?></cite>
                       </div>

                        <!--read more-->
                        <div class="cta-box-card  px-4 py-3">
                            <a class="read-more flex-grow-1 d-flex" title="Continua la lettura su <?= $result ?>" href="<?= $item['link'] ?>" target="_blank">Continua la lettura
                                <svg class="icon icon-primary d-flex  ml-1">
                                    <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#open-in-new"></use>
                                </svg>  
                            </a>
                        </div>  

                    </div>                    
                </div>

            </div>

        <?php endforeach; ?>
    
    <?php else: ?>
        <p>Non ci sono presenti nuovi comunicati stampa da visualizzare</p>
    <?php endif; ?>

</div>


