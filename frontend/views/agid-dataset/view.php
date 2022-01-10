<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\core\helpers\Html;
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);


$this->title =$model->title;
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/app']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('amoscore', 'Agid Dataset'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>


<!--testata titolo: inseirti dati dinamici (tipologia doc, nome, sottotitolo, descr brevetranne condivisione, per ora commentato-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">     
            <h1><?= $model->title ?> </h1>                        
        </div>
        <div class="offset-lg-1 col-lg-3 col-md-4">
            <aside id="argomenti-sezione">
                <div class="argomenti">
                    
                    <div class="condividi">
                        <?= $share_and_see_actions ->getHtml(); ?>
                    </div>
                    <?php if(!empty($tags )) { ?>
                        <h4 class="mt-3 mt-lg-0"><small>Argomenti</small></h4>
                        <div class="argomenti-sezione-elenco">
                        <?php foreach($tags as $tag){ ?>
                            <span class="chip chip-simple chip-primary"><span class="chip-label"><?= $tag->nome ?></span></span>
                            
                        <?php } ?>
                    
                    
                        </div>
                    <?php }?>
                </div>
            </aside>
        </div>
        
    </div>
</div>


<!--parte contenuto: sidebar+ contenuto-->
<div class="content-section my-4 uk-container">
    <div class="row border-top row-column-border row-column-menu-left">
        <!--sidebar di sx-->
        <div class="col-lg-3 col-md-4 index-left-container">
            <aside id="menu-sinistro" >
                <nav class="navbar it-navscroll-wrapper navbar-expand-lg w-100">
                    <div id="navbarNav" class="w-100">  
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper menu-link-list">
                                <button type="button" class="px-0 btn w-100" data-toggle="collapse" data-target="#lista-paragrafi" aria-expanded="true" aria-controls="lista-paragrafi" style="box-shadow:none;border:0;">
                                    <h3 id="titolo-indice" class="position-relative no_toc px-4 text-left primary-color d-flex align-items-center justify-content-between" style="font-size:16px">
                                        Indice della pagina  
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#chevron-down"></use>
                                        </svg>                       
                                    </h3>  
                                </button>
                                <ul id="lista-paragrafi" class="link-list collapse show">
                                    <!--descrizione-->
                                        <!--description-->
                                        <?php if($model->description){ ?>
                                            <li class="nav-item active">
                                                <a class="nav-link active" title="Vai al paragrafo descrizione" href="#descrizione"><span>Descrizione</span></a>
                                            </li>
                                        <?php } ?>
                                        <!--ALTRE INFORMAZIONI-->                               
                                        <li class="nav-item">
                                            <a class="nav-link" title="Vai al paragrafo altre informazioni" href="#altre-informazioni"><span>Altre informazioni </span></a>
                                        </li> 
                                


                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>  
            </aside>
        </div>
        <section class="col-lg-9 col-md-8  border-top-0 it-page-sections-container index-right-container">
            <!--descrizione-->
            <!--description-->
            <?php if($model->description){ ?>
                <article id="descrizione" class="it-page-section mt-5 mt-5 anchor-offset">
                    <h4 class="primary-color ">Descrizione</h4>
                    <div class="text-serif">
                        <?= $model->description ?>
                    </div>
                </article>
            <?php } ?>

            
            <article id="altre-informazioni" class="it-page-section mt-5 anchor-offset ">
                <h4 class="primary-color">Altre informazioni</h4>          
                    <?= \open20\amos\core\forms\LastUpdateModelWidget::widget(
                    ['model' => $model, 'cssClass' => 'small']);  ?>         
            </article>   

            
        </section>
    </div>
</div>