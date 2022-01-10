<?php

use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\attachments\components\AttachmentsListBS4;
use open20\amos\events\AmosEvents;
use open20\amos\core\forms\MapWidget;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
use yii\helpers\Url;
use \open20\amos\events\models\AgidAdministrativePersonsMm;
use app\modules\backendobjects\frontend\Module;

$persone = AgidAdministrativePersonsMm::find()->andWhere(['event_id' => $model->id])
    ->innerJoin('agid_person', "agid_person.id = agid_event_administrative_persons_mm.person_id AND agid_person.status = 'AgidPersonWorkflow/VALIDATED'")
    ->all();

$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();
$bootstrapItaliaAsset  = BootstrapItaliaDesignAsset::register($this);
?>

<?php
if (!is_null($model->eventLogo)) {
    $url = $model->eventLogo->getWebUrl('dashboard_news', false, true);
}
$siteManagementModule = \Yii::$app->getModule('sitemanagement');
$docSize              = ((float) $document->size) / 1000;

$module = Module::getInstance();

?>

<!--breadcrumb: inseriti dati dinamici:titolo categ:TODO:nome categ-->
<div class="breadcrumb-container uk-container my-4">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="breadcrumb-container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a title="Vai alla home" href="/">Home</a><span class="separator">/</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a title="Vai alla pagina eventi" href="novità/eventi">Eventi</a><span class="separator">/</span>
                    </li>
                    <!--categoria evento-->
                    <?php if ($model->agid_event_typology_id == 1) { ?>
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina eventi culturali" href="novità/eventi/novità-tutti-eventi-culturali">Eventi culturali</a><span class="separator">/</span>
                        </li>
                    <?php } ?>
                    <?php if ($model->agid_event_typology_id == 2) { ?>
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina eventi sociali" href="novità/eventi/novità-tutti-eventi-sociali">Eventi sociali</a><span class="separator">/</span>
                        </li>
                    <?php } ?>
                    <?php if ($model->agid_event_typology_id == 3) { ?>
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina eventi politici" href="novità/eventi/novità-tutti-eventi-politici">Eventi politici</a><span class="separator">/</span>
                        </li>
                    <?php } ?>
                    <?php if ($model->agid_event_typology_id == 4) { ?>
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina eventi di affari o commerciali" href="novità/eventi/novità-tutti-eventi-affari">Eventi di affari o commerciali</a><span class="separator">/</span>
                        </li>
                    <?php } ?>
                    <?php if ($model->agid_event_typology_id == 5) { ?>
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina eventi di sportivi" href="novità/eventi/novità-tutti-eventi-sportivi">Eventi sportivi</a><span class="separator">/</span>
                        </li>
                    <?php } ?>
                    <li aria-current="page" class="breadcrumb-item active">
                        <?= $model->title ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!--testata titolo: categ titolo sottotitolo, intro, data inizio evento data fine (opz):TODO categ-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">     
            <h1><?= $model->title ?></h1>

            <!--PER STEFAN: DOVE INSERIRE FOREACH PER 'PARTE DI'-->
            <?php
            $i                     = 1;
            $related_events        = $model->getAllAgidRelatedEvents();
            $related_events_lenght = count($model->getAllAgidRelatedEvents());
            ?>
            <?php if(!empty($related_events) && count($related_events) > 0){ ?>
                <p class="text-serif small"><strong>Parte di: </strong>
                    <?php foreach ($related_events as $key => $related_event) : ?>
                    <?php
                        $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($related_event->id, $related_event->className(), 
                                $module->modelsDetailMapping[$related_event->className()]);
                    ?>
                        <a href="<?= $route ?>" title="Event">

                            <?= $related_event->title ?>
                        </a>
                        <?php if ($related_events_lenght > 1 && $i < $related_events_lenght) { ?>
                            ,
                            <?php
                            $i++;
                        }
                        ?>
                    <?php endforeach; ?>
                </p>
 

            <?php } ?>

                           
                <!-- APPUNTAMENTI -->
                
                <?php if( null != $main_events = $model->getAllMainEvents() ): ?>

                    <p class="text-serif small"><strong>Appuntamenti: </strong>
                        <?php 
                            $i = 1;

                        ?>
                        <?php foreach ($main_events as $key => $main_event) : ?>
                            <?php
                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($main_event->id, $main_event->className(), 
                                        $module->modelsDetailMapping[$main_event->className()]);
                            ?>
                            <a href="<?= $route ?>" title="Event">
                                <?= $main_event->title ?>
                            </a>

                            <?php 
                                if( count($main_events) >= 1 && $i < count($main_events) ){
                                    echo ",";
                                    $i++;
                                }
                            ?>
                        <?php endforeach; ?>
                    </p>

                <?php endif; ?>

            <!--sottotitolo-->
            <?php if ($model->summary) { ?>
                <p class="text-serif small"><?= $model->summary ?></p>
            <?php } ?>
<?= $model->agid_description ?>

            <div class="row mt-3 mb-4">
                <div class="col-6">
                    <small>Data di inizio:</small>
                    <p class="font-weight-semibold ">
                        <?= \Yii::$app->formatter->asDatetime($model->begin_date_hour,  'php:d-m-Y H:i:s') ?>
                    </p>
                </div>
<?php if ($model->end_date_hour) { ?>
                    <div class="col-6">
                        <small>Data di scadenza:</small>
                        <p class="font-weight-semibold "><?= \Yii::$app->formatter->asDatetime($model->end_date_hour, 'php:d-m-Y H:i:s') ?></p>
                    </div>
<?php } ?>

            </div>

        </div>

        <div class="offset-lg-1 col-lg-3 col-md-4">
            <aside id="argomenti-sezione">
                <div class="argomenti">
                    <div class="condividi">
                    <?= $share_and_see_actions->getHtml(); ?>
                </div>
                    <?= \yii\base\View::render('/parts/list_model_tags', ['tags' => $model->getTagsList()]) ?>
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
                                <a data-toggle="collapse" href="#lista-paragrafi" role="button" aria-expanded="true" aria-controls="lista-paragrafi" class="no_toc text-decoration-none">
                                    <h3 id="titolo-indice" class="position-relative no_toc px-4 text-left primary-color d-flex align-items-center justify-content-between" style="font-size:16px">
                                        Indice della pagina  
                                        <svg class="icon icon-primary">
                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#chevron-down"></use>
                                        </svg>                       
                                    </h3>  
                                </a>
                                <ul id="lista-paragrafi" class="link-list collapse show">
                                    <!--COS'E'-->
                                    <!--descrizione:agid_description-->
                                    <li class="nav-item active">
                                        <a class="nav-link active" title="Vai al paragrafo testo dell'evento" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#cosa"><span>Cos'è</span></a>
                                    </li>

                                    <!--LUOGO-->
                                    <!--event_location, agid_geolocation-->
                                    <li class="nav-item">
                                        <a class="nav-link" title="Vai al paragrafo luogo" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#luogo"><span>Luogo</span></a>
                                    </li>

                                    <!--DATE E ORARI-->
                                    <!--agid_dates_and_hours-->
                                    <li class="nav-item">
                                        <a class="nav-link" title="Vai al paragrafo date e orari" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#date-orari"><span>Date e orari</span></a>
                                    </li>

                                    <!--PREZZO-->
                                    <!-- agid_price -->
                                    <?php if ($model->agid_price) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" title="Vai al paragrafo prezzo" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#prezzo"><span>Costi</span></a>
                                        </li>
                                    <?php } ?>


                                    <!--DOCUMENTI: documento, allegati -->
                                    <?php if ($model->agidEventDocuments || $model->eventAttachments) { ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo documento" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#documento"><span>Documenti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--CONTATTI-->
                                    <!-- agid_organized_by, agid_contact, agid_website-->
                                    <?php if ($model->agid_contact || $model->agid_website) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" title="Vai al paragrafo contatti" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#contatti"><span>Contatti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--ALTRE INFO-->
                                    <!-- agid_other_informations-->

                                    <li class="nav-item">
                                        <a class="nav-link" title="Vai al paragrafo altre informazioni" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#altre-info"><span>Altre informazioni</span></a>
                                    </li>




                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>  
            </aside>
        </div>
        <section class="col-lg-9 col-md-8  border-top-0 it-page-sections-container index-right-container">
            <!--parte immagine: solo se esiste-->
            <?php if ($model->eventLogo) { ?>
                <article class="it-page-section mt-5">
                    
                            <img src="<?= $url ?>" class="figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">
                        
                  
                </article>
            <?php } ?>
            <!--COS'E':descrizione: agid_description-->
            <?php if ($model->description || !is_null($siteManagementModule) || !is_null($siteManagementModule) || $persone) { ?>
                <article class="it-page-section ">
                    <h4 id="cosa" class="primary-color anchor-offset">Cos'è</h4>


                    <?php if ($model->description) { ?>
                        <div class="text-serif">
                        <?= $model->description ?>
                        </div>
            <?php } ?>




                    <!--galleria foto-->
    <?php if (!is_null($siteManagementModule)): ?>
                        <?= \amos\sitemanagement\widgets\SMSliderWidgetBS4::widget(['sliderId' => $model->agid_image_slider_id]); ?>
                    <?php endif; ?>

                    <!--Galleria video-->
    <?php if (!is_null($siteManagementModule)): ?>
        <div class="mt-4 videos-gallery">
            <?= \amos\sitemanagement\widgets\SMSliderWidgetBS4::widget(['sliderId' => $model->agid_video_slider_id]); ?>
        </div>
    <?php endif; ?>


                    <!--PERSONE DELL'AMMINISTRAZIONE-->

                        <?php if ($persone) { ?>
                        <div class="row mt-4">
                            <?php foreach ($persone as $p) : ?>
                                <?php
                                $organizzazione = $p->person->getAgidOrganizationalUnit();

                                $module = Module::getInstance();
                                $name   = [];
                                $link   = [];

                                foreach ($organizzazione as $org) :

                                    array_push($name, $org->name);

                                    $areaModel = $org;
                                    $cls       = $areaModel->className();
                                    array_push($link,
                                        Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id, $cls,
                                            $module->modelsDetailMapping[$cls]));

                                endforeach;

                                $refArea = array_fill_keys($name, $link);

                                $personModel = $p->person;
                                $cls         = $personModel->className();
                                $route       = Yii::$app->getModule('backendobjects')::getDetachUrl($personModel->id,
                                        $cls, $module->modelsDetailMapping[$cls]);
                                ?>

                                <?=
                                $this->render(
                                    '@vendor/open20/design/src/components/agid/views/agid-card-person',
                                    [
                                    'categoryIcon' => 'card-account-details-outline',
                                    'categoryName' => 'persone',
                                    'cardTitle' => $p->person->name.' '.$p->person->surname,
                                    'email' => ' '.$p->person->email,
                                    'telefono' => ' '.$p->person->telephone,
                                    'refArea' => $refArea,
                                    'urlDetail' => $route,
                                    'additionalCssExternalClass' => 'box-card mb-4',
                                    'columnWidth' => 'col-md-6 col-xs-12',
                                    ]
                                );
                                ?>


                    <?php endforeach; ?>
                        </div>
    <?php } ?>


                </article>
<?php } ?>


            <!--LUOGO-->
            <!--event_location, agid_geolocation-->
            <article class="it-page-section mt-5">
                <h4 id="luogo" class="primary-color anchor-offset">Luogo</h4>
                    <div class="row">
                        <div class="card card-teaser  px-2 rounded col-lg-6 col-md-6 col-xs-12 ">
                                <div class="shadow  p-4 flex-grow-1 h-100 d-flex">
                                    <svg class="icon icon-primary" role="img" >
                                        <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#pin"></use>
                                    </svg>

                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?= $model->event_location ?>
                                        </h5>
                                        
                                    </div>
                                </div>
                        </div>
                        <!--vecchio card luogo -->
                        <?php if ($model->agid_geolocation): ?>
                        <?php
                            $module = Yii::$app->getModule(AmosEvents::getModuleName());
                            if ($module->enableGoogleMap):
                        ?>

                                <div class="geolocation-widget col-sm-12 col-xs-12 mt-3">
                                    <?= MapWidget::widget(['placeId' => $model->agid_geolocation, 'markerTitle' => $model->agid_geolocation,'zoom' => 10]) ?>
                                </div>
                        <?php endif; ?>
                    <!--< ?= $model->agid_geolocation ?>-->
                    <?php endif; ?>
                    </div>
                    

                

                    
            </article>

            <!--DATE E ORARI-->
            <!--agid_dates_and_hours-->
            <article class="it-page-section mt-5">
                <h4 id="date-orari" class="primary-color  anchor-offset">Date e orari</h4>
                <div class="text-serif">
<?= $model->agid_dates_and_hours ?>
                </div>
            </article>

            <!--PREZZO-->
            <!-- agid_price -->
<?php if ($model->agid_price) { ?>
                <article class="it-page-section mt-5">
                    <h4 id="prezzo" class="primary-color anchor-offset">Costi</h4>
                    <div class="agid-card-costi-container card no-after border-left mt-3">
                        <div class="card-body">
                            
                            <p><?= $model->agid_price ?></p>
                        </div>
                    </div>

                </article>
                    <?php } ?>


            <!--DOCUMENTI:doc principale, allegati-->
<?php if ($model->agidEventDocuments || $model->eventAttachments) { ?>
                <article class="it-page-section mt-5 mt-5">
                    <h4 id="documento" class="primary-color anchor-offset">Documenti</h4>
    <?php if ($model->agidEventDocuments) { ?>
                        <div class="row">
                                        <?php foreach ($model->agidEventDocuments as $document) : ?>

                                            <?php 
                                                $module = Module::getInstance();
                                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($document->id, $document->className(), 
                                                                    $module->modelsDetailMapping[$document->className()]);
                                            ?>
                                            <div class="my-3 card-wrapper card-teaser card-one-block col-lg-4 col-md-6 col-xs-12">
                                                <div class="card card-teaser card-one-block  shadow p-4">
                                                    <svg class="icon icon-primary">
                                                        <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                                    </svg>
                                                    <div class="card-body overflow-hidden">
                                                        <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $document->titolo ?>" >
                                                            <?= $document->titolo ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--vecchio doc con download-->
                                            <?php /*
                                                <div class="card card-teaser card-one-block p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                                                    <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                                        <svg class="icon icon-primary">
                                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-file "></use>
                                                        </svg>
                                                        <div class="card-body">
                                                        <!--<a href="< ?= $document->getDocumentMainFile()->getWebUrl()  ?>" title="File < ?= $document->type?> - <?= $docSize ?> KB">-->
                                                <?= $document->getDocumentMainFile()->name ?>
                                                            <!--</a> -->

                                                        </div>
                                                    </div>
                                                </div>

                                            */ ?>
                        <?php endforeach; ?>
                        </div>
                    <?php } ?>
                    
                    <?php if ($model->eventAttachments) { ?>
                        <?=
                        AttachmentsListBS4::widget([
                            'model' => $model,
                            'attribute' => 'eventAttachments',
                            'viewDeleteBtn' => false,
                            'viewDownloadBtn' => false,
                            'viewFilesCounter' => false,
                            'hideExtensionFile' => true
                        ])
                        ?>
    <?php } ?>
                </article>
<?php } ?>

            <!--CONTATTI-->
            <!-- agid_contact, agid_website, agid_organized_by-->
            <?php if ($model->agid_organized_by || $model->agid_contact || $model->agid_website) { ?>
                <article class="it-page-section mt-5">
                    <h4 id="contatti" class="primary-color anchor-offset">Contatti</h4>
                    <div class="row">
                        <?php if ($model->agid_organized_by) { ?>
                            <div class="card card-teaser  px-2 rounded col-lg-6 col-md-6 col-xs-12 mr-0">
                                <div class="shadow  p-4 flex-grow-1 h-100 d-flex">
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
                        <?php if ($model->agid_contact) { ?>
                            <div class="card card-teaser  px-2 rounded col-lg-6 col-md-6 col-xs-12 mr-0">
                                <div class="shadow  p-4 h-100 flex-grow-1 d-flex">
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
                        <?php if ($model->agid_website) { ?>
                            <div class="card card-teaser  px-2 rounded col-lg-12 col-md-12 col-xs-12 overflow-hidden">
                                <div class="shadow h-100 p-4 flex-grow-1 d-flex overflow-hidden">
                                    <svg class="icon icon-primary" role="img" >
                                    <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#web"></use>
                                    </svg>

                                    <div class="card-body pl-2 overflow-hidden">
                                        <h5 class="card-title">
                                            Sito:
                                        </h5>
                                        <div class="card-text text-serif overflow-hidden" style="white-space: nowrap;text-overflow: ellipsis;">
                                            <a href=" <?= $model->agid_website ?>" target="_blank" title="Visita il sito web associato all'evento">
                                            <?= $model->agid_website ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </article>
            <?php } ?>

            <!--ALTRE INFO-->
            <!-- agid_other_informations-->    
            <article class="it-page-section mt-5">
                <h4 id="altre-info" class="primary-color anchor-offset">Altre informazioni</h4>
                            <?php if ($model->agid_other_informations) { ?>
                    <div class="callout">
                        <div class="callout-title px-3 mr-3">
                            <svg class="icon icon-primary">
                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-info-circle"></use>
                            </svg>
                        </div>
                        <div class="text-serif">
                           
                    <?php if ($model->agid_other_informations) { ?>
                                    <?= $model->agid_other_informations ?>
                    <?php } ?>

                           
                        </div>

                    </div>
<?php } ?>
<?= \open20\amos\core\forms\LastUpdateModelWidget::widget(
    ['model' => $model, 'cssClass' => 'small']);
?>   


            </article>

        </section>
    </div>
</div>
