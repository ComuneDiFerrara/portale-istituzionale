<?php

use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\core\helpers\Html;
use open20\amos\events\AmosEvents;
use open20\amos\events\models\Event;
use open20\amos\core\icons\AmosIcons;
use open20\amos\attachments\components\AttachmentsListBS4;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
use open20\amos\core\forms\MapWidget;
use \open20\amos\events\models\AgidAdministrativePersonsMm;
use yii\helpers\Url;
use app\modules\backendobjects\frontend\Module;

$persone=AgidAdministrativePersonsMm::find()->andWhere(['event_id' =>$model->id ])->all(); 
$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$module = Yii::$app->getModule('backendobjects');
$tags = $model->getTagsList();

//$this->title = strip_tags($model->title);
$this->title = strip_tags($model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = strip_tags($model->title);


if (!is_null($model->eventLogo)) {
    $url = $model->eventLogo->getUrl('original', false, true);
  }
  $siteManagementModule = \Yii::$app->getModule('sitemanagement');

  $this->registerJs(<<<JS
    var breadcrumb=document.getElementsByClassName("breadcrumb-container")[0];
    breadcrumb.classList.add("container");
JS
    );

?>

<style>
   
    .network-scope-wrapper {
        display:none;
    }
    
</style>


<!--testata titolo: categ titolo sottotitolo, intro, data inizio evento data fine (opz):TODO categ-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">     
            <h1><?= $model->title ?></h1>

            <?php if($model->agidRelatedEventsMm){ ?>
                    <p class="text-serif small"><strong>Parte di: </strong><?= $model->agidRelatedEventsMm ?></p>
            <?php } ?>
            <!--intro-->
            <?php if($model->description){ ?>
                <p><?= $model->description ?></p>
            <?php } ?>
            
            <div class="row mt-3 mb-4">
                <div class="col-6">
                    <small>Data di inizio dell'evento:</small>
                    <p class="font-weight-semibold text-monospace"><?= $model->begin_date_hour ?></p>
                </div>
                <?php if ($model->end_date_hour){ ?>
                    <div class="col-6">
                        <small>Data di scadenza:</small>
                        <p class="font-weight-semibold text-monospace"><?= $model->end_date_hour ?></p>
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

<!--parte immagine: solo se esiste-->
<?php if($model->eventLogo){ ?>
    <div class="image-section my-4"> 
        <div class="row row-full-width my-3">
            <figure class="figure">
                <img src="<?= $url ?>" class="figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">
            </figure>
        </div>  
    </div>
<?php } ?>


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
                                <button type="button" class="px-0 btn w-100" data-toggle="collapse" data-target="#lista-paragrafi" aria-expanded="true" aria-controls="lista-paragrafi" style="box-shadow:none;">
                                    <h3 id="titolo-indice" class="position-relative no_toc px-4 text-left primary-color d-flex align-items-center justify-content-between" style="font-size:16px">
                                        Indice della pagina  
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#chevron-down"></use>
                                        </svg>                       
                                    </h3>  
                                </button>
                                <ul id="lista-paragrafi" class="link-list collapse show">
                                    <!--COS'E'-->
                                    <!--descrizione:agid_description-->
                                    <li class="nav-item active">
                                        <a class="nav-link active" title="Vai al paragrafo testo dell'evento" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#cosa"><span>Testo dell'evento</span></a>
                                    </li>

                                    <!--LUOGO-->
                                    <!--event_location, agid_geolocation-->
                                    <li class="nav-item">
                                        <a class="nav-link" title="Vai al paragrafo luogo" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#luogo"><span>Luogo</span></a>
                                    </li>

                                    <!--DATE E ORARI-->
                                    <!--agid_dates_and_hours-->
                                    <li class="nav-item">
                                        <a class="nav-link" title="Vai al paragrafo date e orari" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#date-orari"><span>Date e orari</span></a>
                                    </li>

                                    <!--PREZZO-->
                                    <!-- agid_price -->
                                    <?php if($model->agid_price){ ?>
                                        <li class="nav-item">
                                            <a class="nav-link" title="Vai al paragrafo prezzo" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#prezzo"><span>Costi</span></a>
                                        </li>
                                    <?php } ?>   


                                    <!--DOCUMENTI: documento, allegati -->
                                    <?php if($model->agidEventDocuments || $model->eventAttachments){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo documento" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#documento"><span>Documenti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--CONTATTI-->
                                    <!-- agid_organized_by, agid_contact, agid_website-->
                                    <?php if($model->agid_contact || $model->agid_website){ ?>
                                        <li class="nav-item">
                                            <a class="nav-link" title="Vai al paragrafo contatti" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#contatti"><span>Contatti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--ALTRE INFO-->
                                    <!-- agid_other_informations-->
                                    
                                    <li class="nav-item">
                                            <a class="nav-link" title="Vai al paragrafo altre informazioni" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#altre-informazioni"><span>Altre informazioni</span></a>
                                    </li>
                                    
                                

                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>  
            </aside>
        </div>
        <section class="col-lg-9 col-md-8  border-top-0 it-page-sections-container index-right-container">
            <!--COS'E':descrizione: agid_description-->
            <article class="it-page-section mt-5">
                <h4 id="cosa" class="primary-color anchor-offset">Cos'è</h4>
                <div class="text-serif">
                    <?php if($model->description){ ?>
                        <p><?= $model->description ?></p>

                    <?php } ?>
                    <?= $model->agid_description ?>
                </div>

               
                
                

                <!--galleria foto-->
                <?php if (!is_null($siteManagementModule)): ?>
                        <?= \amos\sitemanagement\widgets\SMSliderWidgetBS4::widget(['sliderId' => $model->agid_image_slider_id]); ?>  
                <?php endif; ?>

                <!--Galleria video-->
                <?php if (!is_null($siteManagementModule)): ?>
                    <?= \amos\sitemanagement\widgets\SMSliderWidgetBS4::widget(['sliderId' => $model->agid_video_slider_id]); ?>
                <?php endif; ?>


                 <!--PERSONE DELL'AMMINISTRAZIONE-->
                
                 <?php if($persone){ ?>
                    <div class="row mt-4">
                        <?php foreach ( $persone as $p) : ?>
                            <?php
                                $organizzazione=$p->person->getAgidOrganizationalUnit();
                        
                                $module = Module::getInstance();
                                $name= [];
                                $link= [];
                                
                                foreach ($organizzazione as $org) :
                                
                                array_push($name, $org->name);
                                
                                $areaModel= $org;
                                $cls = $areaModel->className();
                                array_push($link, Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls, $module->modelsDetailMapping[$cls]));
                    
                                endforeach; 
                                
                                $refArea = array_fill_keys($name, $link);
            
                                $personModel= $p->person;
                                $cls = $personModel->className();
                                $route = Yii::$app->getModule('backendobjects')::getDetachUrl($personModel->id,$cls, $module->modelsDetailMapping[$cls]);
                            ?>
                            
                            <?=
                                $this->render(
                                    '@vendor/open20/design/src/components/agid/views/agid-card-person',
                                    [
                                    'categoryIcon' => 'card-account-details-outline',
                                    'categoryName' => 'amministrativa',
                                    'cardTitle' => $p->person->name .' '. $p->person->surname,
                                    'email'=> ' '.$p->person->email,
                                    'telefono'=> ' '.$p->person->telephone,
                                    'refArea'=> $refArea,
                                    'urlDetail' =>$route,
                                    'additionalCssExternalClass' => 'box-card mb-4',
                                    'columnWidth' => 'col-md-6 col-xs-12',
                                    ]
                                );
                            ?>
        
        
                        <?php endforeach; ?>
                    </div>
                <?php } ?>

                
            </article>

            <!--LUOGO-->
            <!--event_location, agid_geolocation-->
            <article class="it-page-section mt-5">
                <h4 id="luogo" class="primary-color anchor-offset">Luogo dell'evento</h4>
                
                <div class="col-lg-4 col-md-6 col-sm-12 agid-card-place-container card card-teaser shadow mt-3 rounded">
                    <svg class="icon">
                        <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#pin"></use>    
                    </svg>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?=$model->event_location?>
                        </h5>
                    </div>  
                </div>
                
                <?php if ($model->agid_geolocation) { ?>
                    <?php
                    $module = Yii::$app->getModule(AmosEvents::getModuleName());
                    if ($module->enableGoogleMap) { ?>
                    
                        <div class="geolocation-widget col-xs-12 mt-3">
                            <?= MapWidget::widget(['placeId' => $model->agid_geolocation, 'markerTitle' => $model->agid_geolocation, 'zoom' => 10]) ?>
                        </div>
                    <?php } ?>
                    <!--< ?= $model->agid_geolocation ?>-->
                <?php } ?>
            </article>

            <!--DATE E ORARI-->
            <!--agid_dates_and_hours-->
            <article class="it-page-section mt-5">
                <h4 id="date-orari" class="primary-color  anchor-offset">Date e orari</h4>
                <div class="text-serif">
                    <?=$model->agid_dates_and_hours?>
                </div>
            </article>

            <!--PREZZO-->
            <!-- agid_price -->
            <?php if($model->agid_price){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="prezzo" class="primary-color anchor-offset">Costi</h4>
                    <div class="agid-card-costi-container card no-after border-left mt-3">
                        <div class="card-body">
                            <div class="category-top">Costi dell'evento</div>
                            <h5 class="card-title big-heading"><?=$model->agid_price?></h5>
                        </div>
                    </div>
                    
                </article>
            <?php } ?>


            <!--DOCUMENTI:doc principale, allegati-->
            <?php if($model->agidEventDocuments || $model->eventAttachments){ ?>
                <article class="it-page-section mt-5 mt-5">
                    <h4 id="documento" class="primary-color anchor-offset">Documento principale</h4>
                    <?php if($model->agidEventDocuments){ ?>
                        <div class="row">
                            <?php foreach ($model->agidEventDocuments as $document) : ?>
                                
                                <div class="card card-teaser card-one-block p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                                    <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-file "></use>
                                        </svg>
                                        <div class="card-body">
                                        <!--<a href="< ?= $document->getDocumentMainFile()->getWebUrl()  ?>" title="File < ?= $document->type?> - <?= $docSize ?> KB">-->
                                            <?= $document->getDocumentMainFile()->name?>
                                        <!--</a> -->
                                                    
                                        </div>
                                    </div>
                                </div>
                                
                                
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>
                    <?php if($model->eventAttachments){ ?>           
                        <?= AttachmentsListBS4::widget([
                            'model' => $model,
                            'attribute' => 'documentAttachments',
                            'viewDeleteBtn' => false,
                            'viewDownloadBtn' => false,
                            'viewFilesCounter' => false,
                            'hideExtensionFile' => true
                        ]) ?>     
                    <?php } ?>
                </article>
            <?php } ?>

            <!--CONTATTI-->
            <!-- agid_contact, agid_website, agid_organized_by-->
            <?php if($model->agid_organized_by ||$model->agid_contact || $model->agid_website){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="contatti" class="primary-color anchor-offset">Contatti</h4>
                    <?php if($model->agid_organized_by){ ?>
                        
                        <div class="card card-teaser  p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                            <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                <svg class="icon icon-primary" role="img" >
                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#account"></use>
                                </svg>
                                    
                                <div class="card-body">
                                        <h5 class="card-title">
                                            Organizzato da
                                        </h5>
                                        <div class="card-text text-serif">
                                            <?= $model->agid_organized_by ?> 
                                        </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    <?php if($model->agid_contact){ ?>
                        <div class="card card-teaser  p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                            <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                <svg class="icon icon-primary" role="img" >
                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#card-account-mail"></use>
                                </svg>
                                    
                                <div class="card-body pl-2">
                                        <h5 class="card-title">
                                            Contatto:
                                        </h5>
                                        <div class="card-text text-serif">
                                        <?= $model->agid_contact ?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($model->agid_website){ ?>
                        <div class="card card-teaser  p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                            <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                <svg class="icon icon-primary" role="img" >
                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#web"></use>
                                </svg>
                                    
                                <div class="card-body pl-2">
                                        <h5 class="card-title">
                                            Sito:
                                        </h5>
                                        <div class="card-text text-serif">
                                        <?= $model->agid_website ?>
                                        </div>
                                </div>
                            </div>
                        </div>                        
                    <?php } ?>
                </article>
            <?php } ?>



           


           
            


            <!--ALTRE INFO-->
            <!-- agid_other_informations-->    
            <article class="it-page-section mt-5">
                    <h4 id="contatti" class="primary-color anchor-offset">Ulteriori informazioni</h4>
                    <?php if($model->agid_other_informations){ ?>
                        <div class="callout">
                            <div class="callout-title px-3 mr-3">
                                <svg class="icon icon-primary">
                                    <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-info-circle"></use>
                                </svg>                            
                            </div>
                            <div class="text-serif">
                                <ul>
                                    <?php if($model->agid_other_informations){ ?>
                                        <li><?= $model->agid_other_informations ?></li>
                                    <?php } ?>
                                    
                                </ul>
                            </div>
                        
                        </div>
                    <?php } ?>
                    <?= \open20\amos\core\forms\LastUpdateModelWidget::widget(
                    ['model' => $model, 'cssClass' => 'small']);  ?>   
      

            </article>
        
        </section>
    </div>
</div>


