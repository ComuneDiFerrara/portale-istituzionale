<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
use app\modules\backendobjects\frontend\Module;
use yii\helpers\Url;
use open20\agid\organizationalunit\models\AgidOrganizationalUnit;
use open20\agid\organizationalunit\models\AgidOrganizationalUnitServiceMm;
use open20\agid\organizationalunit\models\AgidOrganizationalOrganizationalUnit;
use \open20\amos\news\models\NewsRelatedAgidServiceMm;

// TODO: REMOVE THIS ROW // $newsCorrelate=NewsRelatedAgidServiceMm::find()->andWhere(['related_agid_service_id' =>$model->id ])->all();
$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();
$orgUnit=AgidOrganizationalUnitServiceMm::find()->andWhere(['agid_service_id' => $model->id])->all(); 
$module = Module::getInstance();
$documenti=$model->getAgidServiceDocumentiMms()->andWhere(['not', ['documenti_id' => null]])->all();
?>

<!--impostazione icona a seconda categoria-->
<?php
    if($model->agid_service_type_id==15){//agricoltura
        $categoryIcon= 'flower-outline';
    }
    if($model->agid_service_type_id==12){//ambiente
        $categoryIcon= 'sprout-outline';
    }
    if($model->agid_service_type_id==1){//anagrafe
        $categoryIcon= 'card-account-details-outline';
    }
    if($model->agid_service_type_id==5){//appalti
        $categoryIcon= 'wrench-outline';
    }
    if($model->agid_service_type_id==4){//att prod commercio
        $categoryIcon= 'briefcase-outline';
    }
    if($model->agid_service_type_id==14){//autiruzzazioni
        $categoryIcon= 'lock-outline';
    }
    if($model->agid_service_type_id==6){//catasto
        $categoryIcon= 'domain';
    }
    if($model->agid_service_type_id==2){//cultura e tempo libero
        $categoryIcon= 'head-snowflake-outline';
    }
    if($model->agid_service_type_id==9){//cultura e tempo libero
        $categoryIcon= 'school-outline';
    }
    if($model->agid_service_type_id==10){//sicurezza
        $categoryIcon= 'shield-account-outline';
    }
    if($model->agid_service_type_id==10){//trasporti
        $categoryIcon= 'train-car';
    }
    if($model->agid_service_type_id==13){//salute
        $categoryIcon= 'bottle-tonic-plus-outline';
    }
    if($model->agid_service_type_id==11){//tributi
        $categoryIcon= 'finance';
    }
    if($model->agid_service_type_id==7){//turismo
        $categoryIcon= 'city-variant-outline';
    }
    if($model->agid_service_type_id==7){//turismo
        $categoryIcon= 'city-variant-outline';
    }
    if($model->agid_service_type_id==3){//vita lavorativa
        $categoryIcon= 'account-hard-hat';
    } 
    
     
?>

<?php
    if (!is_null($model->agidServiceImage)) {
      $url = $model->agidServiceImage->getWebUrl('dashboard_news', false, true);
    }
?>

<!--breadcrumb: inseriti dati dinamici:titolo categ-->
<div class="breadcrumb-container uk-container my-4">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="breadcrumb-container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a title="Vai alla home" href="/">Home</a><span class="separator">/</span>
                    </li>
                    <li class="breadcrumb-item">
                    <a title="Vai alla pagina servizi" href="/servizi">Servizi</a><span class="separator">/</span>
                    </li>
                    <!--if/else a seconda categ del servizio manda alla relativa pagina-->
                    <?php if($model->agid_service_type_id==15){?><!--agricoltura-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/agricultura"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==12){ ?><!--ambiente-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/ambiente"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==1){ ?><!--anagrafe-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/anagrafe-e-stato-civile"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==5){ ?><!--appalti-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/appalti-pubblici"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==4){ ?><!--att prod commercio-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/attività-produttive-e-commercio"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==14){ ?><!--autorizzazioni-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/autorizzazioni"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==6){ ?><!--urbanistica ed edilizia-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/urbanistica-e-edilizia"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==2){ ?><!--cultura-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/cultura,-sport-e-tempo-libero"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==9){ ?><!--educazione-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/educazione-e-formazione"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==10){ ?><!--giustizia-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/giustizia-e-sicurezza"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==8){ ?><!--trasporti-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/mobilità-e-trasporti"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==13){ ?><!--salute-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/salute,-benessere-e-assistenza"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==11){ ?><!--tributi-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/tributi-e-finanze"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==7){ ?><!--turismo-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/turismo"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <?php if($model->agid_service_type_id==3){ ?><!--vita lavorativa-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina servizi <?= $model->agidServiceType->name ?>" href="/servizi/vita-lavorativa"><?=$model->agidServiceType->name?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>

                    <li aria-current="page" class="breadcrumb-item active">
                        <?= $model->name ?> 
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!--testata titolo: inseirti dati dinamici (tipologia doc, nome, sottotitolo, descr brevetranne condivisione, per ora commentato-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">     
            <h1><?= $model->name ?> </h1>
            <p class="text-serif small"><?= $model->subtitle ?></p>
            <p><?= $model->description ?></p>
            
                        
            <?php if($model->agid_service_status_id==0 && isset($model->agid_service_status_id)){?>
                <div class="alert alert-danger mt16" role="alert">
                    <?= $model->service_status_motivation ?>
				</div>
                     
            <?php } ?>
                    
                  
            
        </div>
        
        <div class="offset-lg-1 col-lg-3 col-md-4">
            <aside id="argomenti-sezione">
                <div class="argomenti">
                    <div class="condividi">
                        <?= $share_and_see_actions ->getHtml(); ?>
                    </div>
                    <?= \yii\base\View::render('/parts/list_model_tags', ['tags' => $model->getTagsList()]) ?>
                </div>
            </aside>
        </div>
        
    </div>
</div>


<!--parte contenuto: sidebar+ contenuto-->
<div class="content-section my-4 uk-container">

    <?php if( strcmp($model->agidServiceStatus->name, "Non attivo") == 0): ?>
        <div class="alert alert-warning mt16" role="alert">
            <div class="ml-5"> <?= $model->service_status_motivation ?></div>
        </div>
    <?php endif; ?>

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
                                    <!--long_description -->
                                    <li class="nav-item active">
                                        <a class="nav-link active" title="Vai al paragrafo cos'è" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#descrizione"><span>Cos'è</span></a>
                                    </li>

                                   <!--A CHI SI RIVOLGE-->
                                    <!--geographical_apply, persons_apply , destinatari servizio -->
                                    <?php if($model->geographical_apply || $model->persons_apply || $model->recipients_description){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo a chi si rivolge" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#chi-rivolge"><span>A chi si rivolge</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--ACCEDERE AL SERVIZIO-->
                                    <!--procedure_apply, output, outcome_procedure_apply -->
                                    <?php if($model->procedure_apply ||$model->output || $model->outcome_procedure_apply
                                             ||$model->digital_channel_url ||$model->physical_channel || 
                                             $model->physical_channel_reservation || $model->authentication_way ){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo accedere al servizio" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#accedere"><span>Accedere al servizio</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--COSA SERVE-->
                                    <!--procedure_apply -->
                                    <?php if($model->instructions){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo cosa serve" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#cosa-serve"><span>Cosa serve</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--COSTI E VINCOLI-->
                                    <!--costs, constrains  -->
                                    <?php if($model->costs || $model->constrains){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo costi e vincoli" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#costi-vincoli"><span>Costi e vincoli</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--TEMPI E SCADENZE-->
                                    <!--phases_deadline-->
                                    <?php if($model->phases_deadline){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo tempi e scadenze" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#tempi-scadenze"><span>Tempi e scadenze</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--CASI PARTICOLARI-->
                                    <!--phases_deadline-->
                                    <?php if($model->special_case){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo casi particolari" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#casi-particolari"><span>Casi particolari</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--CONTATTI-->
                                    <!-- agid_service_organizational_unit_mm, agid_uo_area_id -->
                                    <?php if( (null != $agid_service_organizational_unit_mm = $model->agidServiceOrganizationalUnitMm) || $model->agid_uo_area_id){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo contatti" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#referenti"><span>Contatti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--SERVIZI CORRELATI-->
                                    <!--agidServiceRelatedServiceMm-->
                                    <?php if($model->agidServiceRelatedServiceMm){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo servizi" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#servizi"><span>Servizi</span></a>
                                        </li>
                                    <?php } ?>
                                    
                                    <!--DOC CORRELATI-->
                                    <!--documenti -->
                                    <?php if($documenti){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo documenti" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#documenti"><span>Documenti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--ORGANIZZAZIONI CORRELATE-->
                                    <?php if($orgUnit){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo organizzazioni" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#organizazzioni"><span>Organizzazioni</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--NEWS CORRELATE-->
                                    <?php if( null != $model->getNewsRelated() ) : ?> 
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo novità" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#news"><span>Novità</span></a>
                                        </li>
                                    <?php endif; ?>

                                    <!--LINK EXT-->
                                    <!--external_links -->
                                    <?php if($model->external_links){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo link esterni" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#link-esterni"><span>Link esterni</span></a>
                                        </li>
                                    <?php } ?>
                                   
                                    <!--ALTRE INFORMAZIONI-->                               
                                    <li class="nav-item">
                                        <a class="nav-link" title="Vai al paragrafo altre informazioni" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#altre-informazioni"><span>Altre informazioni </span></a>
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
            <?php if ($model->agidServiceImage) { ?>
                <article class="it-page-section mt-5">
                    
                            <img src="<?= $url ?>" class="figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">
                        
                  
                </article>
            <?php } ?>
            <!--COS'è-->
            <!--long_description -->
            <article class="it-page-section mt-5">
                <h4 id="descrizione"  class="primary-color anchor-offset">Cos'è</h4>
                <div class="text-serif">
                    <?= $model->long_description ?>
                </div>
            </article>     
            
            <!--A CHI SI RIVOLGE-->
            <!--geographical_apply, persons_apply , destinatari servizio -->
            <?php if($model->geographical_apply || $model->persons_apply || $model->recipients_description){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="chi-rivolge" class="primary-color anchor-offset">A chi si rivolge</h4>
                    <?php if($model->recipients_description){ ?>
                        <div class="mb-2">
                           
                            <div class="text-serif">
                                <?= $model->recipients_description ?>
                            </div>
                        </div>
                        
                    <?php } ?>
                    <?php if($model->geographical_apply){ ?>
                        <div class="mb-2">
                            <p class="h6">Copertura geografica del servizio</p>
                            <div class="text-serif">
                                <?= $model->geographical_apply ?>
                            </div>
                        </div>
                        
                    <?php } ?>
                    <?php if($model->persons_apply ){ ?>
                        <div class="mb-2">
                            <p class="h6">Chi può presentare</p>
                            <div class="text-serif">
                                <?= $model->persons_apply ?>
                            </div>
                        </div>
                    
                    <?php } ?>
                </article>
            <?php } ?>

            <!--ACCEDERE AL SERVIZIO-->
            <!--digital_channel_url, physical_channel, physical_channel_reservation, authentication_way $model->procedure_apply ||$model->output || $model->outcome_procedure_apply -->
            <?php if($model->digital_channel_url ||$model->physical_channel 
                     || $model->physical_channel_reservation || $model->authentication_way
                     || $model->procedure_apply ||$model->output || $model->outcome_procedure_apply){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="accedere" class="primary-color anchor-offset">Accedere al servizio</h4>
                    <?php if($model->procedure_apply){ ?>
                        <div class="mb-2">
                            <p class="h6">Come si fa</p>
                            <div class="text-serif">
                                <?= $model->procedure_apply ?>
                            </div>
                        </div>
                        
                    <?php } ?>
                    <?php if($model->output){ ?>
                        <div class="mb-2">
                            <p class="h6">Cosa si ottiene</p>
                            <div class="text-serif">
                                <?= $model->output ?>
                            </div>
                        </div>
                        
                    <?php } ?>
                    <?php if($model->outcome_procedure_apply){ ?>
                        <div class="mb-2">
                        <p class="h6">Procedure collegate all'esito</p>
                        <div class="text-serif">
                            <?= $model->outcome_procedure_apply ?>
                        </div>
                        </div>

                    <?php } ?>
                    <?php if($model->digital_channel_url){ ?>
                        <div class="mb-2">

                        <p class="h6">Canale digitale</p>
                        <div class="text-serif">
                            <a href="<?= $model->digital_channel_url ?>" target="_blank" title="Vai al sito del canale digitale">
                                <?= $model->digital_channel_url ?>
                            </a>
                        </div>
                        </div>

                    <?php } ?>
                    <?php if($model->authentication_way){ ?>
                        <div class="mb-2">

                        <p class="h6">Modalità di autenticazione</p>
                        <div class="text-serif">
                            <?= $model->authentication_way ?>
                        </div>
                        </div>

                    <?php } ?>
                    <?php if($model->physical_channel){ ?>
                        <div class="mb-2">

                        <p class="h6">Canale fisico</p>
                        <div class="text-serif">
                            <?= $model->physical_channel ?>
                        </div>  
                        </div>  

                    <?php } ?>
                    <?php if($model->physical_channel_reservation){ ?>
                        <div class="mb-2">

                        <p class="h6">Modalità di prenotazione al canale fisico</p>
                        <div class="text-serif">
                            <?= $model->physical_channel_reservation ?>
                        </div>
                        </div>

                    <?php } ?>
                </article>
            <?php } ?>

            <!--COSA SERVE-->
            <!--procedure_apply -->
            <?php if($model->instructions){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="cosa-serve" class="primary-color anchor-offset">Cosa serve</h4>
                    <div class="callout">
                        <div class="callout-title px-3 mr-3">
                            <svg class="icon icon-primary">
                                <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-info-circle"></use>
                            </svg>
                        </div>
                        <div class="text-serif small">
                                <?= $model->instructions ?>
                        </div>
                        
                    </div>
                </article>
            <?php } ?>

            <!--COSTI E VINCOLI-->
            <!--costs, constrains-->
            <?php if($model->costs || $model->constrains){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="costi-vincoli" class="primary-color anchor-offset">Costi e vincoli</h4>
                    <?php if($model->costs){ ?>
                        <div class="mb-3">
                            <div class="agid-card-costi-container card no-after border-left mt-3">
                                <div class="card-body">
                                    
                                    <p><?= strip_tags($model->costs) ?></p>
                                </div>
                            </div>
                           
                        </div>
                        
                    <?php } ?>
                    <?php if($model->constrains){ ?>   
                        <div class="mb-3">
                            <p class="h6">Vincoli</p>
                            <div class="text-serif">
                                <?= $model->constrains ?>
                            </div>
                        </div>
                        
                    <?php } ?>                    
                    
                </article>
            <?php } ?>

            <!--TEMPI E SCADENZE-->
            <!--phases_deadline-->
            <?php if($model->phases_deadline){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="tempi-scadenze" class="primary-color anchor-offset">Tempi e scadenze</h4>
                    <?php if($model->phases_deadline){ ?>
                        <!--<h6>Fasi e scadenze</h6>-->
                        <div class="text-serif">
                            <?= $model->phases_deadline ?>
                        </div>
                    <?php } ?>
                </article>
            <?php } ?>

            <!--CASI PARTICOLARI-->
            <!--special_case  -->
            <?php if($model->special_case){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="casi-particolari" class="primary-color anchor-offset">Casi particolari</h4>
                    <?php if($model->special_case){ ?>
                        
                        <div class="text-serif">
                            <?= $model->special_case ?>
                        </div>
                    <?php } ?>
                </article>
            <?php } ?>


            
            <!--CONtATTI-->
            <!--agid_uo_manager_id, agid_uo_area_id -->
            <?php if($model->agid_uo_area_id || null != $agid_service_organizational_unit_mm= $model->agidServiceOrganizationalUnitMm) : ?>
                <article class="it-page-section mt-5">
                    <h4 id="referenti" class="primary-color anchor-offset">Contatti</h4>
                        <?php if(null != $agid_service_organizational_unit_mm = $model->agidServiceOrganizationalUnitMm) : ?>
                            <p class="h6">Uffici</p>
                            <div class="row mt-3">
                                <?php foreach ($agid_service_organizational_unit_mm as $key => $agid_service_organizational_unit) : ?>
                                    <div class="col-md-6 col-xs-12 d-flex flex-column mb-3">
                                        
                                        <?php
                                            $ou= AgidOrganizationalUnit::find()->where(['id' => $agid_service_organizational_unit->agid_organizational_unit_id])->one(); 
                                            $orgModel= $ou;
                                            $cls = $orgModel->className();
                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($ou->id,$cls, $module->modelsDetailMapping[$cls]);
                                        ?>
                                        <div  class="agid-generic-card-container box-card h-100 mb-4">
                                            <div class="py-3 h-100 d-flex flex-column shadow">
                                                
                                                    <div class="categoria-box-card px-4 pb-2 d-flex align-items-center">                                   
                                                        <div>
                                                            <svg class="icon icon-padded rounded-circle icon-white bg-primary d-flex  mr-1" role="img" aria-label="Numero risposte">
                                                                <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#bank-outline"></use>
                                                            </svg>
                                                        </div>
                                                        <div class="text-uppercase font-weight-bold primary-color">
                                                            <?= $ou->agidOrganizationalUnitContentType->name ?>
                                                        </div> 
                                                        
                                                    </div>
                                            
                                                <div class="px-4 flex-grow-1">
                                                    <div class="h5  ">  
                                                        <a class="text-black" title="Esplora avviso" href="<?= $route ?>"><?= $ou->name ?></a>
                                                    </div>
                                                    <div class="text-serif pt-3">
                                                        <div>
                                                            <?= $ou->short_description ?>
                                                            <?php if($ou->address || $ou->cap){?>
                                                            <div><strong>Indirizzo:</strong> <?=$ou->address?> <?php if($ou->cap){?> - <?=$ou->cap?><?php } ?></div>
                                                            <?php } ?>
                                                            <?php if($ou->public_hours){?>
                                                                <div><strong>Orari:</strong> <?=$ou->public_hours?> </div>
                                                            <?php } ?>
                                                            <?php if($ou->telephone_reference){?>
                                                            <div><strong>Telefono:</strong> <?=$ou->telephone_reference?></div>
                                                            <?php } ?>
                                                            <?php if($ou->mail_reference){?>
                                                            <div style="overflow:hidden;text-overflow:ellipsis;"><strong>Email:</strong>
                                                            <a href="mailto:<?= $ou->mail_reference ?>" class="text-decoration-none" title="invia una mail a <?=$ou->mail_reference?>"> <?=$ou->mail_reference?></a>
                                                            </div>
                                                            <?php } ?>
                                                            <?php if($ou->pec_reference){?>
                                                                <div><strong>PEC:</strong>
                                                                <a href="mailto:<?=$ou->pec_reference?>" class="text-decoration-none" title="invia una mail a <?=$ou->pec_reference?>"> <?=$ou->pec_reference?></a>
                                                                </div>
                                                            <?php } ?>

                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="cta-box-card px-4 py-3 uk-section- uk-visible@xl uk-section">
                                                    <div class="uk-container">
                                                        <div class="read-more ">
                                                            <a class="text-uppercase font-weight-bold" title="Esplora <?= $ou->name ?>" href="<?= $route ?>">Leggi di più →</a> 
                                                        </div>   
                                                    </div> 
                                                </div>
                                                
                                            </div>                                   
                                        </div>







                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    
                        <?php if($model->agid_uo_area_id) : ?>
                            <?php if( $model->agidUoArea->status == AgidOrganizationalUnit::AGID_ORGANIZATIONAL_UNIT_WORKFLOW_STATUS_VALIDATED ) : ?>
                                <p class="h6">Area di riferimento</p>
                                <div class="row mt-3">
                                    <div class="col-md-6 col-xs-12 d-flex flex-column">
                                        
                                        <?php
                                            $ou=$model->agidUoArea; 
                                            $orgModel= $ou;
                                            $cls = $orgModel->className();
                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($ou->id,$cls, $module->modelsDetailMapping[$cls]);
                                        ?>
                                        <div  class="agid-generic-card-container h-100 box-card mb-4">
                                            <div class="py-3 h-100 d-flex flex-column shadow">
                                            
                                                <div class="categoria-box-card px-4 pb-2 d-flex align-items-center">                                   
                                                    <div>
                                                        <svg class="icon icon-padded rounded-circle icon-white bg-primary d-flex  mr-1" role="img" aria-label="Numero risposte">
                                                            <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#bank-outline"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="text-uppercase font-weight-bold primary-color">
                                                        <?= $ou->agidOrganizationalUnitContentType->name ?>
                                                    </div> 
                                                    
                                                </div>
                                            
                                                <div class="px-4 flex-grow-1">
                                                    <div class="h5  ">  
                                                        <a class="text-black" title="Esplora avviso" href="<?= $route ?>"><?= $ou->name ?></a>
                                                    </div>
                                                    <div class="text-serif pt-3">
                                                        <div>
                                                            <?= $ou->short_description ?>
                                                            <?php if($ou->address || $ou->cap){?>
                                                            <p><strong>Indirizzo:</strong> <?=$ou->address?> <?php if($ou->cap){?> - <?=$ou->cap?><?php } ?></p>
                                                            <?php } ?>
                                                            <?php if($ou->telephone_reference){?>
                                                            <p><strong>Telefono:</strong> <?=$ou->telephone_reference?></p>
                                                            <?php } ?>
                                                            <?php if($ou->mail_reference){?>
                                                            <p><strong>Email:</strong>
                                                            <a href="mailto:<?= $ou->mail_reference ?>" class="text-decoration-none" title="invia una mail a <?=$ou->mail_reference?>"> <?=$ou->mail_reference?></a>
                                                            </p>
                                                            <?php } ?>
                                                            <?php if($ou->pec_reference){?>
                                                                <p><strong>PEC:</strong>
                                                                <a href="mailto:<?=$ou->pec_reference?>" class="text-decoration-none" title="invia una mail a <?=$ou->pec_reference?>"> <?=$ou->pec_reference?></a>
                                                                </p>
                                                            <?php } ?>

                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="cta-box-card px-4 py-3 uk-section- uk-visible@xl uk-section">
                                                    <div class="uk-container">
                                                        <div class="read-more ">
                                                            <a class="text-uppercase font-weight-bold" title="Esplora <?= $ou->name ?>" href="<?= $route ?>">Leggi di più →</a> 
                                                        </div>   
                                                    </div> 
                                                </div>
                                                
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                            
                            <?php endif; ?>
                        <?php endif; ?>
                    

                </article>
            <?php endif; ?>

            <!--SERVIZI CORRELATI-->
            <!--agid_service_related_service_mm-->
            <?php if( null != $serviziCorrelati = $model->getAgidServiceRelatedService() ) : ?>

                <article class="it-page-section mt-5">
                    <h4 id="servizi" class="primary-color anchor-offset">Servizi </h4>
                    <div class="row">
                        <?php foreach ($serviziCorrelati as $service) : ?>
                            <?=
                                $this->render(
                                    '@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                    [
                                    'categoryIcon' => 'card-account-details-outline',
                                    'categoryName' => $service->agidServiceType->name,
                                    'cardTitle' => $service->name,
                                    'cardText'=>$service->description,
                                    'urlDetail' => \Yii::$app->getModule('backendobjects')::getDetachUrl($service->id, $service->className(), $module->modelsDetailMapping[$service->className()]),
                                    'additionalCssExternalClass' => 'box-card mb-4',
                                    'columnWidth' => 'col-md-6 col-xs-12',
                                    ]
                                );
                            ?>
                        <?php endforeach; ?>
                    </div>
                </article>

            <?php endif; ?>

            <!--DOC CORRELATI-->

            <!--documenti -->
            <?php if( null != $agid_service_documenti = $model->getAgidServiceDocumenti() ) : ?>

                <article class="it-page-section mt-5">
                    <h4 id="documenti" class="primary-color anchor-offset">Documenti</h4>
                    <div class="row">
                        <!--DOCUMENTI-->
                        <?php foreach($agid_service_documenti as $document) : ?>

                            <?php 
                                // ??
                                $document_size = (float) $document->getDocumentMainFile()->size / 1000;

                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($document->id, $document->className(), $module->modelsDetailMapping[$document->className()]);
                            ?>
                            <div class="mb-3 card-wrapper card-teaser card-one-block col-md-6 col-sm-12">
                                <div class="card card-teaser card-one-block  shadow p-4">
                                    <svg class="icon icon-primary">
                                        <use xlink:href="<?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                    </svg>
                                    <div class="card-body overflow-hidden">
                                        <a class="text-decoration-none" href="<?= $route ?>" title="Apri il documento  <?= $document->titolo ?>">
                                            <?= $document->titolo ?>
                                        </a> 
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </article>

            <?php endif; ?>

            <!--NEWS CORRELATE-->
            <?php if( null != $model->getNewsRelated() ) : ?>
                <article class="it-page-section mt-5">
                    <h4 id="news" class="primary-color anchor-offset">Novità</h4>

                    <div class="row">

                        <?php foreach($model->getNewsRelated() as $news) : ?>

                            <?php 
                                $cls = $news->className();
                                $route = Yii::$app->getModule('backendobjects')::getDetachUrl($news->id, $cls, $module->modelsDetailMapping[$cls]);
                                if (!is_null($news->newsImage)) {
                                    $url = $news->newsImage->getWebUrl('dashboard_news', false, true);
                                }    
                                $tags = $news->getTagsList();        
                            ?>
                            
                            <?=
                                $this->render( '@vendor/open20/design/src/components/agid/views/agid-card-novità', [
                                    'image' => $url,
                                    'date' =>$news->date_news,
                                    'title' => $news->titolo,
                                    'showAvatar' => false,
                                    'hideCategory' => true,
                                    'descriptionSize' => 'text-serif pt-3 flex-grow-1',
                                    'description' =>  $news->descrizione_breve,
                                    'tags' => $tags,
                                    'additionalCssExternalClass' => 'd-flex box-card mb-4',
                                    'url'=> $route,
                                    'widthColumn' => 'col-md-6 col-xs-12',
                                ]);
                            ?>

                        <?php endforeach; ?>
                        
                    </div>

                </article>
            <?php endif; ?>

            <!--LINK EXT-->
            <!--external_links -->
            <?php if($model->external_links){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="link-esterni" class="primary-color anchor-offset">Link esterni</h4>
                    <?php if($model->external_links){ ?>
                        <div class="row">
                            <div class="mb-3 card-wrapper card-teaser card-one-block col-md-6 col-sm-12">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary mr-2">
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#link-variant"></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                        <?= $model->external_links ?> 
                                        </div>
                                    </div>
                            </div>
                             <!--vecchia card siti ext -->
                            <?php /*
                            <div class="card card-teaser  p-0 rounded col-md-12 col-xs-12 ">
                                <div class="shadow  p-4 m-3 flex-grow-1 d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#link-variant"></use>
                                        </svg>
                                        <span class="h5 small card-title mb-0 ml-2"> Link: </span>
                                    </div>
                                    
                                    <div class="card-body mt-2 ml-0">
                                        <div class="card-text">
                                            <?= $model->external_links ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            */ ?>
                        </div>                       
                    <?php } ?>
                </article>
            <?php } ?>

            <?php if($model->further_information){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="altre-informazioni" class="primary-color anchor-offset ">Altre informazioni</h4>
                    <div class="callout">
                        <div class="callout-title px-3 mr-3">
                            <svg class="icon icon-primary">
                                <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-info-circle"></use>
                            </svg>
                        </div>
                        <div class="text-serif small">
                                <?= $model->further_information ?>
                        </div>
                    </div>
                </article>   
            <?php } ?>
            <?= \open20\amos\core\forms\LastUpdateModelWidget::widget(['model' => $model, 'cssClass' => 'small']);  ?>   
        </section>
    </div>
</div>