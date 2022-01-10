<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\attachments\components\AttachmentsListBS4;
use open20\amos\core\helpers\Html;
use open20\amos\documenti\AmosDocumenti;
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
use yii\helpers\Url;



$docMainFile = $model->getDocumentMainFile();
$docSize=((float)$docMainFile->size)/1000;
$tags = $model->getTagsList();
$this->params['breadcrumbs'][] = ['label' => AmosDocumenti::t('amosdocumenti', Yii::$app->session->get('previousTitle')), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] =$model->titolo ;
$this->title = $model->titolo ;
?>



<!--testata titolo: inseirti dati dinamici (tipologia doc, nome, oggetto, descr brevetranne condivisione, per ora commentato-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">     
            <?php if($model->object){ ?>
                <p class="text-serif small"><?= $model->object ?></p>
            <?php } ?>
            
            <p><?= $model->descrizione_breve ?></p>
            
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
                                <a data-toggle="collapse" href="#lista-paragrafi" role="button" aria-expanded="true" aria-controls="lista-paragrafi" class="no_toc text-decoration-none">
                                    <h3 id="titolo-indice" class="position-relative no_toc px-4 text-left primary-color d-flex align-items-center justify-content-between" style="font-size:16px">
                                        Indice della pagina  
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#chevron-down"></use>
                                        </svg>                       
                                    </h3>  
                                </a>
                                <ul id="lista-paragrafi" class="link-list collapse show">
                                    <!--OGGETTO-->
                                    <?php if($model->object){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo oggetto" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#oggetto"><span>Oggetto</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--DESCRIZIONE-->
                                    <!--desrizione estesa: extended_description-->
                                    <?php if($model->extended_description){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo descrizione" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#descrizione"><span>Descrizione</span></a>
                                        </li>
                                    <?php } ?>


                                    <!--PUBBLICAZIONE-->
                                    <?php if($model->start_date || $model->end_date){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo pubblicazione" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#pubblicazione"><span>Pubblicazione</span></a>
                                        </li>
                                    <?php } ?>

                                    
                                    <!--DOCUMENTO PRINCIPALE-->
                                    <?php if($docMainFile || $model->link_document){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo documento" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#documento"><span>Documento principale</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--ALLEGATI-->
                                    <?php if($model->documentAttachments){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo allegati" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#allegati"><span>Allegati</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--TEMPI E SCADENZE-->
                                    <!--dates_and_intermediate_stages-->
                                    <?php if($model->dates_and_intermediate_stages ){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo tempi e scadenze" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#tempi-scadenze"><span>Data e fasi intermedie</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--UFFICIO E AREA-->
                                    <!--agidOrganizationalUnitContentTypeOffice->name-->
                                    <!--agidOrganizationalUnitContentTypeArea->name-->
                                    <?php if($model->agidOrganizationalUnitContentTypeOffice->name ||
                                             $model->agidOrganizationalUnitContentTypeArea->name ){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo ufficio e area resposnsabile" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#ufficio-area"><span>Ufficio e area responsabile</span></a>
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
            <!--OGGETTO-->
            <!--$model->object-->
            <?php if($model->object){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="oggetto" class="primary-color anchor-offset">Oggetto</h4>
                    <div class="text-serif">
                        <?= $model->object?>
                    </div>   
                </article>
            <?php } ?>

            <!--DESCRIZIONE-->
            <!--desrizione estesa: extended_description-->
            <?php if($model->extended_description){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="descrizione" class="primary-color anchor-offset">Descrizione</h4>
                    <!--descrizione estesa-->
                    <?php if($model->extended_description){ ?>
                        <div class="text-serif">
                            <?= $model->extended_description ?>
                        </div>
                    <?php } ?>   
                     <!--Autore:descr-->
                     <?php if($model->author){ ?> 
                        <div class="my-2 text-serif">
                            <strong>Autore: </strong><?= $model->author ?>
                        </div>
                    <?php } ?>
                    <!--Licenza distribuzione:descr-->
                    <?php if($model->distribution_proscription){ ?> 
                        <div class="my-2 text-serif">
                            <strong>Licenza di distribuzione: </strong><?= $model->distribution_proscription ?>
                        </div>
                    <?php } ?>              
                </article>
            <?php } ?>

            <!--formati disponibili, non indicizzati-->
            <?php if($docMainFile->type){ ?>
            <p class="d-flex align-items-center font-weight-bold">Formati disponibili:
                <span class="doc-format-chip chip chip-simple chip-primary mx-1">
                    <span class="chip-label my-0 text-uppercase"><?= $docMainFile->type?></span>
                </span>
            </p>
            <?php } ?>
            
            <!--PUBBLICAZIONE-->
            <!--$model->start_date-->
            <?php if($model->start_date || $model->end_date){ ?>
                <article class="it-page-section mt-5">
                    <h4  id="pubblicazione" class="primary-color  anchor-offset">Pubblicazione</h4>
                    <?php if($model->start_date){ ?>
                        <div class="point-list-wrapper mt-4">
                            <div class="point-list">
                                <div class="point-list-aside point-list-warning">
                                    <div class="point-date text-monospace"><?= Yii::$app->formatter->asDate($model->start_date, 'dd'); ?></div>
                                    <div class="point-month text-monospace"><?=  Yii::$app->formatter->asDate($model->start_date, 'MMMM')[0].Yii::$app->formatter->asDate($model->start_date, 'MMMM')[1].Yii::$app->formatter->asDate($model->start_date, 'MMMM')[2] ?> / <?= Yii::$app->formatter->asDate($model->start_date, 'yy'); ?></div>
                                    <div class="point-year text-monospace"></div>
                                </div>
                                <div class="point-list-content">
                                    <div class="card card-teaser shadow rounded">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                            Data di pubblicazione
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($model->end_date){ ?>
                            <div class="point-list-wrapper mb-4">
                                <div class="point-list">
                                    <div class="point-list-aside point-list-warning">
                                        <div class="point-date text-monospace"><?= Yii::$app->formatter->asDate($model->end_date, 'dd'); ?></div>
                                        <div class="point-month text-monospace"><?=  Yii::$app->formatter->asDate($model->end_date, 'MMMM')[0].Yii::$app->formatter->asDate($model->end_date, 'MMMM')[1].Yii::$app->formatter->asDate($model->end_date, 'MMMM')[2] ?> / <?= Yii::$app->formatter->asDate($model->end_date, 'yy'); ?></div>
                                        <div class="point-year text-monospace"></div>
                                    </div>
                                    <div class="point-list-content">
                                        <div class="card card-teaser shadow rounded">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                Data di scadenza
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php } ?> 
                </article>
            <?php } ?>

            <!--DOCUMENTO PRINCIPALE:doc link ext-->
            <?php if($docMainFile|| $model->link_document){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="documento" class="primary-color anchor-offset">Documento principale</h4>
                    <div class="row">
                        <?php if($docMainFile){ ?>
                            <div class="card-wrapper card-teaser card-one-block col-lg-4 col-md-6">
                                <div class="card card-teaser card-one-block  shadow p-4">
                                    <svg class="icon icon-primary">
                                        <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                    </svg>
                                    <div class="card-body overflow-hidden">
                                        <a class="text-decoration-none" href="<?= $docMainFile->getWebUrl()  ?>" title="File <?= $docMainFile->type?> - <?= $docSize ?> KB">
                                            <?= $docMainFile->name?>
                                        
                                        </a>  
                                        
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($model->link_document){ ?>
                            <div class="card-wrapper card-teaser  card-one-block col-lg-4 col-md-6">
                                <div class="card card-teaser card-one-block shadow p-4">
                                    <svg class="icon icon-primary">
                                        <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                    </svg>
                                    <div class="card-body overflow-hidden">
                                        <a class="text-decoration-none" href="<?= $model->link_document ?>" title="Vai al link del documento esterno">
                                            <?= $model->link_document ?>  
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </article>
            <?php } ?>

            <!--ALLEGATI-->
            <?php if($model->documentAttachments){ ?>
                
                <article class="it-page-section mt-5">
                    <h4 id="allegati" class="primary-color  anchor-offset">Allegati</h4>
                   
                    <?= AttachmentsListBS4::widget([
                            'model' => $model,
                            'attribute' => 'documentAttachments',
                            'viewDeleteBtn' => false,
                            'viewDownloadBtn' => false,
                            'viewFilesCounter' => false,
                            'hideExtensionFile' => true,
                            'enableSort' => true,
                            'viewSortBtns' => false,
                    ]) ?>
                             
                </article>
            <?php } ?> 
            
            <!--TEMPI E SCADENZE-->
            <!--fasi intermedie: dates_and_intermediate_stages-->
            <?php if($model->dates_and_intermediate_stages) { ?>
                <article class="it-page-section mt-5">
                    <h4 id="tempi-scadenze" class="primary-color anchor-offset">Data e fasi intermedie</h4>
                    <div class=" mt-3 mb-4">
                            <div class="text-serif">
                                <?=  $model->dates_and_intermediate_stages ?>
                            </div>                                         
                    </div>
            <?php } ?>

            <!--UFFICIO E AREA-->
            <!--agidOrganizationalUnitContentTypeOffice->name-->
            <!--agidOrganizationalUnitContentTypeArea->name-->
            <?php if($model->agidOrganizationalUnitContentTypeOffice->name ||
                     $model->agidOrganizationalUnitContentTypeArea->name) { ?>
                <article class="it-page-section mt-5">
                    <h4 id="ufficio-area" class="primary-color  anchor-offset">Ufficio e area responsabile</h4>
                    <!--Ufficio responsabile documento: agidOrganizationalUnitContentTypeOffice->name-->
                    <?php if( $model->agidOrganizationalUnitContentTypeOffice->name){ ?>
                        <?php
                            $officeModel= $model->agidOrganizationalUnitContentTypeOffice;
                            $cls = $officeModel->className();
                            $routeOffice = Yii::$app->getModule('backendobjects')::getDetachUrl($officeModel->id,$cls, $module->modelsDetailMapping[$cls]);                             
                        ?>
                        <div class="card card-teaser  p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                            <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                <svg class="icon icon-primary mr-2" role="img" >
                                    <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#bank"></use>
                                </svg>     
                                <div class="card-body">
                                    <div class="card-text ">
                                        <a href="<?= $routeOffice ?>" title="Vai alla scheda di <?= $model->agidOrganizationalUnitContentTypeOffice->name ?>  " class="text-decoration-none">
                                            <?= $model->agidOrganizationalUnitContentTypeOffice->name ?>  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!--area responsabile documento-->
                    <?php if($model->agidOrganizationalUnitContentTypeArea->name){ ?>
                        <?php
                            $areaModel= $model->agidOrganizationalUnitContentTypeArea;
                            $cls = $areaModel->className();
                            $routeArea = Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls, $module->modelsDetailMapping[$cls]);                             
                        ?>
                        <div class="card card-teaser  p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                            <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                <svg class="icon icon-primary mr-2" role="img" >
                                    <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#bank"></use>
                                </svg>     
                                <div class="card-body">
                                    <div class="card-text ">
                                        <a href="<?= $routeArea ?>" title="Vai alla scheda di <?= $model->agidOrganizationalUnitContentTypeArea->name ?>"  class="text-decoration-none" >
                                            <?= $model->agidOrganizationalUnitContentTypeArea->name ?>  
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </article>
            <?php } ?>         

            <!--ALTRE INFORMAZIONI-->
            <!--altre info: further_information-->
            <!--riferimenti normativi: regulatory_requirements-->
            <!--autore: author-->
            <!--licenza distribuzioone: distribution_proscription-->
            <!--protocollo: protocol-->
            <!--data protocollo: protocol_date-->
            <!--box aiuto: help_box-->
            <!--ultimo aggiornamento-->

            
            <article class="it-page-section mt-5">
                <h4 id="altre-informazioni" class="primary-color anchor-offset">Altre informazioni</h4>
                    
                    <!--< ?php if($model->further_information || $model->regulatory_requirements
                             || $model->protocol || $model->protocol_date || $model->help_box ){ ?>
                        <div class="callout">
                            <div class="callout-title px-3 mr-3">
                                <svg class="icon icon-primary">
                                    <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-info-circle"></use>
                                </svg>
                            </div>
                           
                            
                        
                        </div>
                    < ?php } ?>  -->

                     <!--Altre info-->
                    <?php if($model->further_information ){ ?>   
                        <div class="text-serif">
                            <?= $model->further_information ?>    
                        </div>    
                    <?php } ?>  
                    <!--Riferimenti normativi-->
                    <?php if($model->regulatory_requirements){ ?> 
                        <div class="text-serif d-flex">
                                <strong class="mr-2">Riferimenti normativi: </strong><?= $model->regulatory_requirements  ?>
                        </div>
                    <?php } ?>
                    <!--Protocollo-->
                    <?php if($model->protocol){ ?>                      
                        <div class="text-serif mb-2 d-flex">
                            <strong class="mr-2">Protocollo: </strong><?= $model->protocol ?>
                        </div>
                    <?php } ?>
                    <!--Data protocollo-->
                    <?php if($model->protocol_date){ ?>                      
                        <div class="text-serif mb-2 d-flex">
                            <strong class="mr-2">Data protocollo: </strong><?= $model->protocol_date ?>
                        </div> 
                    <?php } ?>
                    <!--Help box-->
                    <?php if($model->help_box){ ?>           
                        <div class="text-serif d-flex">
                            <strong class="mr-2">Box d'aiuto: </strong><?= $model->help_box ?>
                        </div>        
                    <?php } ?>  

                    <div class="mt-3">
                        <?= \open20\amos\core\forms\LastUpdateModelWidget::widget(
                        ['model' => $model, 'cssClass' => 'small']);  ?>   
                    </div>
                    
                    
                   
            </article>
            
            
            
        </section>
    </div>
</div>