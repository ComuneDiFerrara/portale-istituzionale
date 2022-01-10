<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\core\helpers\Html;
use \open20\amos\news\models\News;
use open20\amos\news\AmosNews;
use open20\amos\core\icons\AmosIcons;
use yii\helpers\Url;

use open20\amos\attachments\components\AttachmentsListBS4;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$this->title =$model->titolo;
$this->params['breadcrumbs'][] = ['label' => AmosNews::t('amosnews', Yii::$app->session->get('previousTitle')), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] =  $model->titolo;
$tags = $model->getTagsList();

$module = Yii::$app->getModule('backendobjects');

$url = '/img/img_default.jpg';
    if (!is_null($model->newsImage)) {
      $url = $model->newsImage->getUrl('original', false, true);
    }
    $siteManagementModule = \Yii::$app->getModule('sitemanagement');
    if($model->newsDocumento){
        $mainDoc=$model->newsDocumento->getDocumentMainFile();
    }

?>


<!--testata titolo: inseirti dati dinamici (tipologia doc, nome, sottotitolo, descr brevetranne condivisione, per ora commentato-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">     
            <?php if($model->edited_by_agid_organizational_unit_id || $model->newsAgidPersonMm){ ?>
                <?php if($model->editedByAgidOrganizationalUnit->name){ ?>
                    <p class="text-serif small"><strong>A cura di: </strong><?= $model->editedByAgidOrganizationalUnit->name ?></p>
                <?php } ?>
                <!--persone-->
                <?php if($model->newsAgidPersonMm){ ?>
                    <div class="text-serif small"><strong>Persone: </strong>
                        <?php 
                        foreach ($model->newsAgidPersonMm as $person) { ?>
                                <?=  $person->agidPerson->name ?>
                        <?php } ?>
                    </div> 
                <?php } ?>
            <?php } ?>
            <?php if($model->descrizione_breve){ ?>
                <p><?= $model->descrizione_breve ?></p>
            <?php } ?>
            
            <div class="row mt-3 mb-4">
                <div class="col-6">
                    <small>Data della news:</small>
                    <p class="font-weight-semibold text-monospace"><?= Yii::$app->formatter->asDate($model->date_news, 'dd').'/'.ucwords(Yii::$app->formatter->asDate($model->date_news, 'MM')).'/'.Yii::$app->formatter->asDate($model->date_news, 'YYYY'); ?></p>
                </div>
                <?php if ($model->news_expiration_date){ ?>
                    <div class="col-6">
                        <small>Data di scadenza:</small>
                        <p class="font-weight-semibold text-monospace"><?= Yii::$app->formatter->asDate($model->news_expiration_date, 'dd').'/'.ucwords(Yii::$app->formatter->asDate($model->news_expiration_date, 'MM')).'/'.Yii::$app->formatter->asDate($model->news_expiration_date, 'YYYY'); ?></p>
                    </div>
                <?php } ?>
                
            </div>
                        
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

<!--parte immagine-->
<div class="image-section my-4"> 
    <div class="row row-full-width my-3">
        <figure class="figure">
            <img src="<?= $url ?>" class="figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">
        </figure>
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
                                    <!--CORPO-->
                                    <!--testo, gallery, persone-->
                                    <li class="nav-item active">
                                        <a class="nav-link active" title="Vai al paragrafo corpo" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#corpo"><span>Contenuto della notizia</span></a>
                                    </li>



                                    <!--documento -->
                                    <?php if($mainDoc || $model->attachments){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo documento" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#documento"><span>Documenti</span></a>
                                        </li>
                                    <?php } ?>
                                    
                                    

                                    <!--Correlati-->
                                    <?php if($model->newsRelatedNewsMm || $model->newsRelatedDocumentiMm || $model->newsRelatedAgidServiceMm){ ?>
                                        <li class="nav-item">
                                            <a class="nav-link" title="Vai al paragrafo correlati" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#correlati"><span>Correlati</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--ALTRE INFORMAZIONI-->                               
                                    <li class="nav-item">
                                        <a class="nav-link" title="Vai al paragrafo altre informazioni" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#altre-informazioni"><span>Altre informazioni </span></a>
                                    </li>  
                                

                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>  
            </aside>
        </div>
        <section class="col-lg-9 col-md-8  border-top-0 it-page-sections-container index-right-container">
            <!--CORPO-->
            <!--testo della notizia:  $model->descrizione-->
            <!--galleria foto: siteManagementModule-->
            <!--video notizia: siteManagementModule-->
            <article class="it-page-section mt-5 ">
                <h4 id="corpo" class="primary-color anchor-offset">Contenuto della notizia</h4>
                <div class="text-serif">
                    <?= $model->descrizione ?>
                </div>
                <!--galleria foto-->
                <?php if (!is_null($siteManagementModule)): ?>
                    <?= \amos\sitemanagement\widgets\SMSliderWidgetBS4::widget(['sliderId' => $model->image_site_management_slider_id]); ?>
                <?php endif; ?>

                <!--video notizia-->
                <?php if (!is_null($siteManagementModule)): ?>                        
                    <?= \amos\sitemanagement\widgets\SMSliderWidgetBS4::widget(['sliderId' => $model->video_site_management_slider_id]); ?>
                <?php endif; ?>
            </article>

            <!--< ?= $model->id ?>
            < ?php $allegati_file = $model->attachmentsForItemView;
                            if (count($allegati_file) > 0) { ?>
                            <p> ciao</p>
                        < ?php } ?>-->

            <!--DOCUMENTI: doc principale, allegati-->
            <?php if($mainDoc || $model->attachmentsForItemView){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="documento" class="primary-color anchor-offset">Documenti</h4>
                    <!--doc principale-->
                    <?php if($mainDoc){ ?>
                        <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-2">
                            <div class="card card-teaser shadow p-4">
                                <svg class="icon icon-primary">
                                    <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-file "></use>
                                </svg>
                                <div class="card-body">
                                <a href="<?= $mainDoc->getWebUrl()  ?>" title="File <?= $mainDoc->type?> - <?= $docSize ?> KB">
                                    <?= $mainDoc->name?>   
                                </a> 
                                    
                                </div>
                            </div>
                        </div>  
                    <?php } ?>   
                    <!--allegati:-->
                    
                    <?php if(!empty($model->attachmentsForItemView)){ ?>
                        
                        <?= AttachmentsListBS4::widget([
                            'model' => $model,
                            'attribute' => 'attachments',
                            'viewDeleteBtn' => false,
                            'viewDownloadBtn' => false,
                            'viewFilesCounter' => false,
                            'hideExtensionFile' => true
                    ]) ?>
                        
                    <?php } ?>
                                   
                </article>
            <?php } ?>

            <!--CORRELATI-->
            <!--novità correlate-->
            <!--documenti correlati-->
            <!--servizi correlate-->
            <?php if($model->newsRelatedNewsMm || $model->newsRelatedDocumentiMm ||$model->newsRelatedAgidServiceMm){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="novità-correlate"  class="primary-color anchor-offset">Correlati</h4>
                    <?php if($model->newsRelatedNewsMm){ ?>
                        <div class="text-serif"><strong>News correlate:</strong>
                        <span class="comma-list">

                            <?php foreach ($model->newsRelatedNewsMm as $relatedNews) : ?>


                                <?php
                                $newsModel= $relatedNews->relatedNews;
                                $cls = $newsModel->className();
                                $module = Module::getInstance();

                                $route = Yii::$app->getModule('backendobjects')::getDetachUrl($newsModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                                ?>
                                <a class="text-decoration-none" title="Vai alla pagina <?= $relatedNews->relatedNews->titolo?>" href="<?= $route ?>">
                                    <?= $relatedNews->relatedNews->titolo ?>
                                </a>
                            <?php endforeach; ?>
                        </span>
                        
                        </div>
                    <?php } ?>

                
                    <?php if(!empty($model->newsRelatedDocumentiMm)){ ?>
                        <div class="text-serif"><strong>Documenti correlati:</strong>
                        <span class="comma-list">
                            <?php foreach ($model->newsRelatedDocumentiMm as $relatedDoc) : ?>
                                <?php
                                $docModel= $relatedDoc->relatedDocumenti;//->relatedNews;
                                $cls = $docModel->className();
                                $module = Module::getInstance();

                                $route = Yii::$app->getModule('backendobjects')::getDetachUrl($docModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                                ?>
                                <a class="text-decoration-none" title="Vai alla pagina <?= $relatedNews->relatedNews->titolo?>" href="<?= $route ?>">

                                    <?= $relatedDoc->relatedDocumenti->titolo?>
                                </a>
                            <?php endforeach; ?>  
                        </span>                     
                        </div>
                    <?php } ?>

                    <?php if($model->newsRelatedAgidServiceMm){ ?>
                        <div class="text-serif"><strong>Servizi correlati:</strong>
                            <span class="comma-list">
                                <?php foreach ($model->newsRelatedAgidServiceMm as $relatedService) : ?>
                                    <?php
                                    $newsModel= $relatedService->relatedAgidService;//->relatedNews;
                                    $cls = $newsModel->className();
                                    $module = Module::getInstance();

                                    $route = Yii::$app->getModule('backendobjects')::getDetachUrl($newsModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                            
                                    ?>
                                    <a class="text-decoration-none" title="Vai alla pagina <?= $relatedNews->relatedNews->titolo?>" href="<?= $route ?>">
                                        <?= $relatedService->relatedAgidService->name ?>
                                    </a>
                                <?php endforeach; ?>  
                            </span>
                                               
                        </div>
                    <?php } ?>   
                                        
                </article>
            <?php } ?>      
            
            <!--ALTRE INFO-->
            <!--data ultimo aggiornamento-->
            <article class="it-page-section mt-5">
                <h4 id="altre-informazioni" class="primary-color anchor-offset">Altre informazioni</h4>
                    
                    <div class="small mb-3">
                        <p class="last-update-label mb-2">Data pubblicazione</p>
              

                        <p class="font-weight-bold"> <?= Yii::$app->formatter->asDate($model->data_pubblicazione, 'dd').'/'.ucwords(Yii::$app->formatter->asDate($model->data_pubblicazione, 'MM')).'/'.Yii::$app->formatter->asDate($model->data_pubblicazione, 'YYYY'); ?></p>
                    </div>
                    <?= \open20\amos\core\forms\LastUpdateModelWidget::widget(
                    ['model' => $model, 'cssClass' => 'small']);  ?>   
                    

                    
                    
                  
            </article> 
        </section>
    </div>
</div>