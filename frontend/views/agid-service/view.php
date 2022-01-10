<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
use yii\helpers\Html;
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
use open20\agid\organizationalunit\models\AgidOrganizationalUnit;
use open20\agid\organizationalunit\models\AgidOrganizationalUnitServiceMm;
use open20\agid\organizationalunit\models\AgidOrganizationalOrganizationalUnit;
use \open20\amos\news\models\NewsRelatedAgidServiceMm;
use yii\helpers\Url;


$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$this->title =  strip_tags($model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = strip_tags($model->name);





$newsCorrelate=NewsRelatedAgidServiceMm::find()->andWhere(['related_agid_service_id' =>$model->id ])->all();
$orgUnit=AgidOrganizationalUnitServiceMm::find()->andWhere(['agid_service_id' => $model->id])->all(); 
$documenti=$model->getAgidServiceDocumentiMms()->andWhere(['not', ['documenti_id' => null]])->all();
$module = Yii::$app->getModule('backendobjects');


$tags = $model->getTagsList();

if (!is_null($model->agidServiceImage)) {
    $url = $model->agidServiceImage->getUrl('original', false, true);
}
?>

<!--testata titolo: inseirti dati dinamici (tipologia doc, nome, sottotitolo, descr brevetranne condivisione, per ora commentato-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">     
            
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

<!--parte immagini-->
<?php if ($model->agidServiceImage){ ?>
    <div class="image-section my-4"> 
        <div class="row row-full-width my-3">
            <figure class="figure">
                <img src="<?= $url ?>" class="figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">
            </figure>
        </div>  
    </div>
<?php } ?>



<?php if( strcmp($model->agidServiceStatus->name, "Non attivo") == 0): ?>

    <div class="alert alert-warning mt16" role="alert">
        <div class="ml-5"> <?= $model->service_status_motivation ?></div>
    </div>

<?php endif; ?>

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
                                        <a class="nav-link active" title="Vai al paragrafo cos'è" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#descrizione"><span>Cos'è</span></a>
                                    </li>

                                   <!--A CHI SI RIVOLGE-->
                                    <!--geographical_apply, persons_apply , destinatari servizio -->
                                    <?php if($model->geographical_apply || $model->persons_apply || $model->recipients_description){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo a chi si rivolge" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#chi-rivolge"><span>A chi si rivolge</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--ACCEDERE AL SERVIZIO-->
                                    <!--procedure_apply, output, outcome_procedure_apply -->
                                    <?php if($model->procedure_apply ||$model->output || $model->outcome_procedure_apply
                                             ||$model->digital_channel_url ||$model->physical_channel || 
                                             $model->physical_channel_reservation || $model->authentication_way ){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo accedere al servizio" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#accedere"><span>Accedere al servizio</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--COSA SERVE-->
                                    <!--procedure_apply -->
                                    <?php if($model->instructions){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo cosa serve" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#cosa-serve"><span>Cosa serve</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--COSTI E VINCOLI-->
                                    <!--costs, constrains  -->
                                    <?php if($model->costs || $model->constrains){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo costi e vincoli" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#costi-vincoli"><span>Costi e vincoli</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--TEMPI E SCADENZE-->
                                    <!--phases_deadline-->
                                    <?php if($model->phases_deadline){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo tempi e scadenze" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#tempi-scadenze"><span>Tempi e scadenze</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--CASI PARTICOLARI-->
                                    <!--phases_deadline-->
                                    <?php if($model->special_case){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo casi particolari" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#casi-particolari"><span>Casi particolari</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--CONTATTI-->
                                    <!-- agid_service_organizational_unit_mm, agid_uo_area_id -->
                                    <?php if( (null != $agid_service_organizational_unit_mm = $model->agidServiceOrganizationalUnitMm) || $model->agid_uo_area_id){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo contatti" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#referenti"><span>Contatti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--SERVIZI CORRELATI-->
                                    <!--agidServiceRelatedServiceMm-->
                                    <?php if($model->agidServiceRelatedServiceMm){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo servizi" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#servizi"><span>Servizi</span></a>
                                        </li>
                                    <?php } ?>
                                    
                                    <!--DOC CORRELATI-->
                                    <!--documenti -->
                                    
                                    <?php if($documenti){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo documenti" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#documenti"><span>Documenti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--ORGANIZZAZIONI CORRELATE-->
                                    <?php if($orgUnit){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo organizzazioni" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#organizazzioni"><span>Organizzazioni</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--NEWS CORRELATE-->
                                    <?php if(!empty($newsCorrelate)){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo novità" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#news"><span>Novità</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--LINK EXT-->
                                    <!--external_links -->
                                    <?php if($model->external_links){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo link esterni" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#link-esterni"><span>Link esterni</span></a>
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
                        <div class="text-serif">
                            <!--<strong>Destinatari del servizio:</strong> --><?= $model->recipients_description ?>
                        </div>
                    <?php } ?>
                    <?php if($model->geographical_apply){ ?>
                        <div class="text-serif">
                            <strong>Copertura geografica del servizio:</strong><?= $model->geographical_apply ?>
                        </div>
                    <?php } ?>
                    <?php if($model->persons_apply ){ ?>
                        <div class="text-serif">
                            <strong>Chi può presentare:</strong><?= $model->persons_apply ?>
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
                        <div class="mb-3">
                            <p class="h6">Come si fa</p>
                            <div class="text-serif">
                                <?= $model->procedure_apply ?>
                            </div>
                        </div>
                        
                    <?php } ?>
                    <?php if($model->output){ ?>
                        <div class="mb-3">
                            <p class="h6">Cosa si ottiene</p>
                            <div class="text-serif">
                                <?= $model->output ?>
                            </div>
                        </div>
                        
                    <?php } ?>
                    <?php if($model->outcome_procedure_apply){ ?>
                        <div class="mb-3">
                        <p class="h6">Procedure collegate all'esito</p>
                        <div class="text-serif">
                            <?= $model->outcome_procedure_apply ?>
                        </div>
                        </div>

                    <?php } ?>
                    <?php if($model->digital_channel_url){ ?>
                        <div class="mb-3">

                        <p class="h6">Canale digitale</p>
                        <div class="text-serif">
                            <a href="<?= $model->digital_channel_url ?>" target="_blank" title="Vai al sito del canale digitale">
                                <?= $model->digital_channel_url ?>
                            </a>
                        </div>
                        </div>

                    <?php } ?>
                    <?php if($model->authentication_way){ ?>
                        <div class="mb-3">

                        <p class="h6">Modalità di autenticazione</p>
                        <div class="text-serif">
                            <?= $model->authentication_way ?>
                        </div>
                        </div>

                    <?php } ?>
                    <?php if($model->physical_channel){ ?>
                        <div class="mb-3">

                        <p class="h6">Canale fisico</p>
                        <div class="text-serif">
                            <?= $model->physical_channel ?>
                        </div>  
                        </div>  

                    <?php } ?>
                    <?php if($model->physical_channel_reservation){ ?>
                        <div class="mb-3">

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
                        <div>
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
                        <p class="h6">Costi</p>
                        <div class="text-serif">
                            <?= $model->costs ?>
                        </div>
                    <?php } ?>
                    <?php if($model->constrains){ ?>
                        <p class="h6">Vincoli</p>
                        <div class="text-serif">
                            <?= $model->constrains ?>
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
            <?php if($model->agid_uo_area_id ) : ?>
                <article class="it-page-section mt-5">
                    <h4 id="referenti" class="primary-color anchor-offset">Contatti</h4>
                        <?php if(null != $agid_service_organizational_unit_mm = $model->agidServiceOrganizationalUnitMm) : ?>
                            <p class="h6">Ufficio Responsabile</p>
                            <div class="row">
                                <?php foreach ($agid_service_organizational_unit_mm as $key => $agid_service_organizational_unit) : ?>
                                    <div class="col-md-6 col-xs-12 d-flex flex-column mb-3">
                                        
                                        <?php
                                            $ou= AgidOrganizationalUnit::find()->where(['id' => $agid_service_organizational_unit->agid_organizational_unit_id])->one(); 
                                            $orgModel= $ou;
                                            $cls = $orgModel->className();
                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($ou->id,$cls, $module->modelsDetailMapping[$cls]);
                                        ?>
                                        <?=
                                            $this->render(
                                                '@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                                [
                                                    'categoryIcon' => 'bank-outline',
                                                    'categoryName' => $ou->agidOrganizationalUnitContentType->name,
                                                    'cardTitle' => $ou->name,
                                                    'cardText'=>$ou->short_description,
                                                    'urlDetail' =>$route,
                                                    'additionalCssExternalClass' => 'box-card mb-4',
                                                    'columnWidth' => 'col-12',
                                                ]
                                            );
                                        ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    

                        <?php if($model->agid_uo_area_id){ ?>
                            <div class="row">
                                <div class="col-md-6 col-xs-12 d-flex flex-column">
                                    <p class="h6">Area</p>
                                    <?php
                                        $ou=$model->agidUoArea; 
                                        $orgModel= $ou;
                                        $cls = $orgModel->className();
                                        $route = Yii::$app->getModule('backendobjects')::getDetachUrl($ou->id,$cls, $module->modelsDetailMapping[$cls]);
                                    ?>
                                    <?=
                                        $this->render(
                                            '@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                            [
                                            'categoryIcon' => 'bank-outline',
                                            'categoryName' => $ou->agidOrganizationalUnitContentType->name,
                                            'cardTitle' => $ou->name,
                                            'cardText'=>$ou->short_description,
                                            'urlDetail' =>$route,
                                            'additionalCssExternalClass' => 'box-card mb-4',
                                            'columnWidth' => 'col-12',
                                            ]
                                        );
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    

                </article>
            <?php endif; ?>


            <!--SERVIZI CORRELATI-->
            <!--agid_service_related_service_mm-->
            <?php if($model->agidServiceRelatedServiceMm){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="servizi" class="primary-color anchor-offset">Servizi </h4>
                    <div class="row">
                    <?php 
                        $serviziCorrelati=$model->agidServiceRelatedServiceMm;
                        foreach ($serviziCorrelati as $service) { ?>
                            <?php
                                $serviceModel= $service->agidRelatedService;
                                $cls = $serviceModel->className();
                                $route = Yii::$app->getModule('backendobjects')::getDetachUrl($serviceModel->id,$cls, $module->modelsDetailMapping[$cls]);
                            ?>
                            <!--<a title="Vai alla pagina < ?= $service->agidRelatedService->name?>" href="< ?= $route ?>">
                                    < ?=  $service->agidRelatedService->name ?>
                            </a>-->
                            <?=
                            $this->render(
                                '@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                [
                                'categoryIcon' => 'card-account-details-outline',
                                'categoryName' => $service->agidRelatedService->agidServiceType->name,
                                'cardTitle' => $service->agidRelatedService->name,
                                'cardText'=>$service->agidRelatedService->description,
                                'urlDetail' => $route,
                                'additionalCssExternalClass' => 'box-card mb-4',
                                'columnWidth' => 'col-md-6 col-xs-12',
                                ]
                            );
                            ?>


                        <?php }
                    ?>
                    </div>
                    
                    
                </article>
            <?php } ?>


            <!--DOC CORRELATI-->
            <!--documenti -->
            <?php if($documenti ){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="documenti" class="primary-color anchor-offset">Documenti</h4>
                    <div class="row">

                    <!--DOCUMENTI-->
                    <?php foreach ( $documenti as $d) : ?>
                        <?php if(!empty($d->documenti)){
                            $docSize=((float)$d->documenti->getDocumentMainFile()->size)/1000;
                        ?>
                         <?php
                                $docModel= $d->documenti;
                                $cls = $docModel->className();
                                $routeDoc = Yii::$app->getModule('backendobjects')::getDetachUrl($docModel->id,$cls, $module->modelsDetailMapping[$cls]);
                            ?>

                        <div class="mb-3 card-wrapper card-teaser card-one-block col-md-6 col-sm-12">
                            <div class="card card-teaser card-one-block  shadow p-4">
                                <svg class="icon icon-primary">
                                    <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                </svg>
                                <div class="card-body overflow-hidden">
                                
                                    <a class="text-decoration-none" href="<?= $routeDoc ?>" title="Apri il documento  <?=$d->documenti->titolo?>">
                                            <?= $d->documenti->titolo ?>
                                    </a> 
                                </div>
                            </div>
                        </div>

                    <?php } ?>























                    <?php endforeach; ?>
                        
                    </div>
                    
                </article>
            <?php } ?>

            


            <!--NEWS CORRELATE-->
            <?php if(!empty($newsCorrelate)){ ?>
                <article class="it-page-section mt-5">
                        <h4 id="news" class="primary-color anchor-offset">Novità</h4>
                        <div class="row">
                        <?php foreach($newsCorrelate as $news){
                            $newsModel= $news->news;
                            $cls = $newsModel->className();
                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($newsModel->id,$cls, $module->modelsDetailMapping[$cls]);
                            if (!is_null($news->news->newsImage)) {
                                $url = $news->news->newsImage->getUrl('original', false, true);
                            }    
                            $tags = $news->news->getTagsList();                  
                            
                            ?>
                            
                            <?=
                            $this->render(
                                '@vendor/open20/design/src/components/agid/views/agid-card-novità',
                                [
                                'image' => $url,
                                'date' =>$news->news->date_news,
                                'title' => $news->news->titolo,
                                'showAvatar' => false,
                                'hideCategory' => true,
                                'descriptionSize' => 'text-serif pt-3 flex-grow-1',
                                'description' =>  $news->news->descrizione_breve,
                                'tags' => $tags,
                                'additionalCssExternalClass' => 'd-flex box-card mb-4',
                                'url'=> $route,
                                'widthColumn' => 'col-md-6 col-xs-12',
                                ]
                            );
                            ?>

                        <?php } ?>
                        </div>
                       
                </article>
            <?php } ?>

            <!--LINK EXT-->
            <!--external_links -->
            <?php if($model->external_links){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="link-esterni" class="primary-color anchor-offset">Link esterni</h4>
                    <?php if($model->external_links){ ?>
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
                    <?php } ?>
                </article>
            <?php } ?>


            
            <article class="it-page-section mt-5">
                            <h4 id="altre-informazioni" class="primary-color anchor-offset ">Altre informazioni</h4>
                                
                                
                                <?= \open20\amos\core\forms\LastUpdateModelWidget::widget(
                                ['model' => $model, 'cssClass' => 'small']);  ?>   
                                
                            
            </article>   

            
            

           





        </section>
    </div>
</div>