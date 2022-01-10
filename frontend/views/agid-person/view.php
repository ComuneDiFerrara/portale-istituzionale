<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\core\helpers\Html;
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
use \open20\amos\news\models\NewsAgidPersonMm;
use open20\amos\events\models\AgidAdministrativePersonsMm;
use yii\helpers\Url;
$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$tags = $model->getTagsList();

$responsabile= $model->agidPersonOrganizationalUnitMmsManager;
   
$organizzazione=$model->getAgidOrganizationalUnit();

$module = Yii::$app->getModule('backendobjects');
$newsmm=  newsAgidPersonMm::find()
    ->joinWith(['news'])
    ->andWhere(['agid_person_id'=>$model->id])
    ->andWhere(['or',
            ['>=', 'news.news_expiration_date', $now],
            ['news.news_expiration_date' => null]]
    )
    ->all();
//$eventimm=  AgidAdministrativePersonsMm::find()->andWhere(['person_id'=>$model->id])->all();
$eventimm=  AgidAdministrativePersonsMm::find()
    ->joinWith(['event'])
    ->andWhere(['person_id'=>$model->id])
    ->andWhere(['or',
            ['>=', 'event.publication_date_end', $now],
            ['event.publication_date_end' => null]]
    )
    ->all();

//$this->title = strip_tags($model);
$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] =strip_tags($model);

if (!is_null($model->photo)) {
    $url = $model->photo->getUrl('original', false, true);
  }
?>


<!--testata titolo: inseirti dati dinamici (tipologia doc, nome, sottotitolo, descr brevetranne condivisione, per ora commentato-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">     
            <h1><?= $model->name ?> <?= $model->surname ?></h1>
            <h4 class="text-secondary"><?= $model->role ?></h4>
            
            
            <?php if($model->date_start_settlement || $model->date_end_assignment){ ?>
                <div class="row mt-3 mb-4">
                    <?php if($model->date_start_settlement){ ?>
                        <div class="col-6">
                            <small>Data insediamento:</small>
                            <p class="font-weight-semibold text-monospace"><?= $model->date_start_settlement ?></p>
                        </div>
                    <?php } ?>
                    <?php if($model->date_end_assignment){ ?>
                        <div class="col-6">
                            <small>Data conclusione incarico:</small>
                            <p class="font-weight-semibold text-monospace"><?= $model->date_end_assignment ?></p>
                        </div>
                    <?php } ?>               
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
<?php if ($model->photo){ ?>
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
                            <a data-toggle="collapse" href="#lista-paragrafi" role="button" aria-expanded="true" aria-controls="lista-paragrafi" class="no_toc text-decoration-none">
                                    <h3 id="titolo-indice" class="h3 position-relative no_toc px-4 text-left primary-color d-flex align-items-center justify-content-between" style="font-size:16px">
                                        Indice della pagina  
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#chevron-down"></use>
                                        </svg>                       
                                    </h3>  
                                </a>
                                <ul id="lista-paragrafi" class="link-list collapse show">
                                    <!--RUOLO-->
                                    <?php if($model->role_description || $model->bio || /*$model->reference_org ||*/
                                                    $model->manager_org || $model->person_function || $model->skills || $model->delegation || $organizzazione || $responsabile ){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link text-decoration-none" title="Vai al paragrafo ruolo" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#ruolo"><span>Ruolo</span></a>
                                        </li>
                                    <?php } ?>      
                                
                                    <!--contatti: telefono email-->
                                    <!--telephone, email-->
                                    <?php if($model->telephone || $model->email){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link text-decoration-none" title="Vai al paragrafo contatti" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#contatti"><span>Contatti</span></a>
                                        </li>
                                    <?php } ?>     

                                    <!--documenti-->
                                    <!--agid_document_cv_id, agid_document_nomination_id,-->
                                    <?php if($model->agid_document_cv_id || $model->agid_document_nomination_id ){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link text-decoration-none" title="Vai al paragrafo documenti"  href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#documenti"><span>Documenti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--correlati-->
                                    <?php if(!empty($eventimm) || !empty($newsmm)){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link text-decoration-none" title="Vai al paragrafo correlati"  href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#correlati"><span>Novità correlate</span></a>
                                        </li>
                                    <?php } ?>
                                            
                                    <!--altre info-->
                                    <!--other_info -->
                                    <li class="nav-item">
                                        <a class="nav-link text-decoration-none" title="Vai al paragrafo altre informazioni" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#altre-informazioni"><span>Altre informazioni </span></a>
                                    </li>           
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>  
            </aside>
        </div>
        <!--contenuto di dx-->
        <section class="col-lg-9 col-md-8  border-top-0 it-page-sections-container index-right-container">
             
            
            <!--IMMAGINE-->
            <?php if ($model->photo && $model->agid_person_type_id==1){ ?>
                <article class="it-page-section mt-5">  
                    <figure class="figure">
                        <img src="<?= $url ?>" class="figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">
                    </figure>
                </article>
            <?php } ?> 
            
            <!--RUOLO-->
            <!--role_description-->
            <?php if($model->role_description || $model->bio || /*$model->reference_org ||*/
                        $model->manager_org || $model->person_function || $model->skills || $model->delegation || $organizzazione || $responsabile){ ?>
                    <article  class="it-page-section mt-5 ">
                        <h4 id="ruolo" class="primary-color anchor-offset">Ruolo</h4>
                        <?php if($model->role_description ){ ?>
                            <div class="text-serif">
                                <?= $model->role_description ?>
                            </div>
                        <?php } ?>
                        
                        <?php if($organizzazione || $responsabile){ ?>
                            
                                <!--organizzazione riferimento-->
                                <!--reference_org-->
                                
                                <?php if(!is_null($organizzazione)){ ?>
                                    
                                    <div class="text-serif">
                                        <p  class="mt-3 font-weight-bold">Fa parte di:</p>
                                        <div class="row">
                                            <?php foreach ($organizzazione as $org) : ?>
                                                        <?php
                                                            $officeModel= $org;
                                                            $cls = $officeModel->className();
                                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($officeModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                                                        ?>

                                                            <?=
                                                                $this->render(
                                                                    '@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                                                    [
                                                                    'categoryIcon' => 'bank-outline',
                                                                    'categoryName' => $org->agidOrganizationalUnitContentType->name,
                                                                    'cardTitle' => $org->name,
                                                                    'cardText'=>$org->short_description,
                                                                    'urlDetail' =>$route,
                                                                    'additionalCssExternalClass' => 'box-card mb-4',
                                                                    'columnWidth' => 'col-md-6 col-xs-12',
                                                                    ]
                                                                );
                                                            ?>
                                                 
                                            <?php endforeach; ?> 
                                        </div> 
                                    </div>
                                <?php } ?>
                                <!--responsabile-->
                                <!--manager_org -->
                                <?php if($responsabile){ ?>
                                        <div class="text-serif">
                                            <p class="mt-3 font-weight-bold">Responsabile di:</p>
                                            <div class="row">
                                            <?php foreach ($responsabile as $uo) : ?>
                                                
                                                            
                                                <?php
                                                    $officeModel= $uo->agidOrganizationalUnit;
                                                    if(!empty($officeModel)){
                                                      $cls = $officeModel->className();
                                                      $route = Yii::$app->getModule('backendobjects')::getDetachUrl($officeModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                
                                                ?>

                                                    <?=
                                                        $this->render(
                                                            '@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                                            [
                                                            'categoryIcon' => 'bank-outline',
                                                            'categoryName' => $officeModel->agidOrganizationalUnitContentType->name,
                                                            'cardTitle' => $officeModel->name,
                                                            'cardText'=>$officeModel->short_description,
                                                            'urlDetail' =>$route,
                                                            'additionalCssExternalClass' => 'box-card mb-4',
                                                            'columnWidth' => 'col-md-6 col-xs-12',
                                                            ]
                                                        );
                                                    ?>

                                                    <?php } ?>
                                        
                                    <?php endforeach; ?>
                                            </div>
                                            
                                            
                                        </div>
                                    
                                <?php } ?>
                            
                        <?php } ?>                   
                        <?php if($model->date_start_settlement && $model->agid_person_type_id==1){ ?>
                            <div class="mt-3 ">
                                <p class="h6 d-flex font-weight-bold my-0">Data inizio insediamento:</p>
                                <p class="my-0"><?= Yii::$app->formatter->asDate($model->date_start_settlement, 'dd').' '.ucwords(Yii::$app->formatter->asDate($model->date_start_settlement, 'MMMM')).' '.Yii::$app->formatter->asDate($model->date_start_settlement, 'YYYY'); ?></p>
                            </div>
                                    
                        <?php } ?>
                        <?php if($model->date_end_assignment){ ?>
                            <div class="mt-3 ">
                                <p class="h6 d-flex font-weight-bold my-0">Data conclusione incarico:</p>
                                <p class="my-0">
                                    <?= Yii::$app->formatter->asDate($model->date_end_assignment, 'dd').' '.ucwords(Yii::$app->formatter->asDate($model->date_end_assignment, 'MMMM')).' '.Yii::$app->formatter->asDate($model->date_end_assignment, 'YYYY'); ?>

                                </p>
                            </div>
                            
                        <?php } ?>    
                        
                        <?php if($model->bio && $model->agid_person_type_id==1 ){ ?><!--bio visibile solo per politici-->
                            <div class="text-serif">
                                <p class="mt-3 font-weight-bold h6">Biografia:</p>
                                <?= $model->bio ?>
                            </div>
                        <?php } ?>           
                        <div class="row">
                        <?php if($model->person_function){ ?>
                            <div class="card card-teaser  p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                                <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                    <svg class="icon icon-primary" role="img" >
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#format-list-checkbox"></use>
                                    </svg>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                                Funzione
                                        </h5>
                                        <div class="card-text text-serif">
                                                <?= $model->person_function ?>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($model->skills){ ?>
                            <div class="card card-teaser  p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                                <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                    <svg class="icon icon-primary" role="img" >
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#brain"></use>
                                    </svg>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                                Competenze
                                        </h5>
                                        <div class="card-text text-serif">
                                                <?= $model->skills ?>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($model->delegation){ ?>
                            <div class="card card-teaser  p-0 rounded col-lg-4 col-md-6 col-xs-12 ">
                                <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                    <svg class="icon icon-primary" role="img" >
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#sitemap"></use>
                                    </svg>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                                Deleghe
                                        </h5>
                                        <div class="card-text text-serif">
                                                <?= $model->delegation ?>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </article>
            <?php } ?>

            <!--CONTATTI: telefono email-->
            <!--person_function, skills, delegation-->
            <?php if($model->telephone || $model->email){ ?>
                    <article class="it-page-section mt-5">
                        <h4 id="contatti" class="primary-color anchor-offset">Contatti</h4>
                    
                        <div class="card card-teaser  p-0 rounded col-lg-9 col-md-12 ">
                                <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                    <div class="card-body">
                                        <!--tel-->
                                        <?php if($model->telephone){ ?>
                                            <div class="mb-3">
                                                <p class="mb-0 font-weight-bold">Telefono:</p>
                                                <?= $model->telephone ?>
                                                
                                            </div>
                                        <?php } ?>
                                        
                                        <!-- email -->
                                        <?php if($model->email){ ?>
                                            <div class="mb-3">
                                                <p class="mb-0 font-weight-bold">Email:</p>
                                                <?= $model->email?>
                                            </div>
                                        <?php } ?>
                                        
                                        
                                        
                                    </div>
                                </div>  
                            </div> 
                    </article>
            <?php } ?>

            <!--DOCUMENTI-->
            <!--agid_document_cv_id, agid_document_nomination_id,-->
            <?php if($model->agid_document_cv_id || $model->agid_document_nomination_id){ ?>
                <article class="it-page-section mt-5 ">
                    <h4 id="documenti" class="primary-color anchor-offset">Documenti</h4>
                    <div class="row">

                        <?php if($model->agid_document_cv_id){ ?>
                            <?php
                                                            $cvModel= $model->cvDocumento;
                                                            $cls = $cvModel->className();
                                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($cvModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Curriculum vitae </p>
                                <div class="mb-3 card-wrapper card-teaser card-one-block ">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $model->cvDocumento->titolo ?>" >
                                                <?= $model->cvDocumento->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    
                        <?php if($model->agid_document_nomination_id){ ?>
                            <?php
                                                            $nominaModel= $model->nominationDocumento;
                                                            $cls = $nominaModel->className();
                                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($nominaModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Atto di nomina</p>
                                <div class="mb-3 card-wrapper card-teaser card-one-block ">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route ?>" title="<?=$model->nominationDocumento->titolo?>">
                                                
                                                <?= $model->nominationDocumento->titolo ?>
                                            </a>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    
                        <?php if($model->agid_document_import_id){ ?>
                            <?php
                                                            $docModel= $model->importDocumento;
                                                            $cls = $docModel->className();
                                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($docModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Importi di viaggio e/o servizio</p>
                                <div class="mb-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $model->importDocumento->titolo ?>">
                                            <?= $model->importDocumento->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                   
                        <?php if($model->agid_document_other_posts_id){ ?>
                            <?php
                                                            $docModel= $model->otherPostsDocumento;
                                                            $cls = $docModel->className();
                                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($docModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Altre cariche</p>
                                <div class="mb-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $roure?>" title="File <?= $model->otherPostsDocumento->titolo ?> KB">
                                            <?= $model->otherPostsDocumento->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    
                        <?php if($model->agid_document_balance_sheet_id){ ?>
                            <?php
                                                            $docModel= $model->balanceSheetDocumento;
                                                            $cls = $docModel->className();
                                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($docModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Situazione patrimoniale</p>
                                <div class="mb-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $model->balanceSheetDocumento->titolo ?>">
                                            
                                            <?= $model->balanceSheetDocumento->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    
                        <?php if($model->agid_document_tax_return_id){ ?>
                            <?php
                                                            $docModel= $model->taxReturnDocumento;
                                                            $cls = $docModel->className();
                                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($docModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Dichiarazione dei redditi</p>
                                <div class="mb-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $model->taxReturnDocumento->titolo?>">
                                            <?= $model->taxReturnDocumento->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                   
                        <?php if($model->agid_document_election_expenses_id){ ?>
                            <?php
                                                            $docModel= $model->electionExpensesDocumento;
                                                            $cls = $docModel->className();
                                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($docModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Spese elettorali</p>
                                <div class="mb-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $model->electionExpensesDocumento->titolo ?>">
                                            <?= $model->electionExpensesDocumento->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    
                        <?php if($model->agid_document_changes_balance_sheet_id){ ?>
                            <?php
                                                            $docModel= $model->changesBalanceSheetDocumento;
                                                            $cls = $docModel->className();
                                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($docModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Variazioni situazione patrimoniale</p>
                                <div class="mb-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $model->changesBalanceSheetDocumento->titolo ?> ">
                                            <?= $model->changesBalanceSheetDocumento->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </article>   
            <?php } ?>

            <!--CORRELATI-->
            <!--correlati -->
            <?php if(!empty($eventimm) || !empty($newsmm)){ ?>
            <article class="it-page-section mt-5 ">
                <h4 id="correlati"  class="primary-color anchor-offset">Novità correlate</h4>
                <?php if(!empty($newsmm)){ ?>
                    <p class="h6">News</p>
                    <div class="row">
                        <?php
                        
                            foreach($newsmm as $news){
                                $news= $news->news;
                                $newsModel= $news;
                                $cls = $newsModel->className();
                                $urlDetail = Yii::$app->getModule('backendobjects')::getDetachUrl($newsModel->id,$cls, $module->modelsDetailMapping[$cls]);
                            
                                $tags = $news->getTagsList();




                                if (!is_null($news->newsImage)) {
                                    $url = $news->newsImage->getUrl('original', false, true);
                                } 

                            
                        ?>

                            <?=
                            $this->render(
                                '@vendor/open20/design/src/components/agid/views/agid-card-novità',
                                [
                                'image' => $url,
                                'date' =>$news->date_news,
                                'title' => $news->title,
                                'showAvatar' => false,
                                'hideCategory' => true,
                                'descriptionSize' => 'text-serif pt-3 flex-grow-1',
                                'description' =>  $news->descrizione_breve,
                                'tags' => $tags,
                                'additionalCssExternalClass' => 'd-flex box-card mb-4',
                                'url'=> $urlDetail,
                                'widthColumn' => 'col-md-6 col-xs-12',
                                ]
                            );
                            ?>

                        <?php }
                        ?>
                        
                    </div>
                <?php } ?>
                


                <?php
                    if(!empty($eventimm)){ ?>

                <p class="h6">Eventi</p>
                <div class="row">
                <?php foreach($eventimm as $eventi){
                        $eventi= $eventi->event;
                        $eventsModel= $eventi;
                        $cls = $eventsModel->className();
                        $urlDetail = Yii::$app->getModule('backendobjects')::getDetachUrl($eventsModel->id,$cls, $module->modelsDetailMapping[$cls]);
                            
                        $tags = $eventi->getTagsList();
                        $url=null;

                        if (!is_null($eventi->eventLogo)) {
                            $url = $eventi->eventLogo->getUrl('original', false, true);
                        } ?>


                        <?=
                                $this->render(
                                    '@vendor/open20/design/src/components/agid/views/agid-card-novità',
                                    [
                                    'image' => $url,
                                    'date' =>$eventi->begin_date_hour,
                                    'title' => $eventi->title,
                                    'showAvatar' => false,
                                    'hideCategory' => true,
                                    'descriptionSize' => 'text-serif pt-3 flex-grow-1',
                                    'description' =>  $eventi->description,
                                    'tags' => $tags,
                                    'additionalCssExternalClass' => 'd-flex box-card mb-4',
                                    'url'=> $urlDetail,
                                    'widthColumn' => 'col-md-6 col-xs-12',
                                    ]
                                );
                        ?>

                <?php }  ?>
                </div>
            <?php } ?>
                        
                   
        
                        
            </article>
            <?php } ?>

            <!--ALTRE INFO-->
            <!--other_info -->
            <article class="it-page-section mt-5 ">
                        <h4 id="altre-informazioni"  class="primary-color anchor-offset">Altre informazioni</h4>
                        <?php if($model->other_info){ ?>
                            <div class="callout">
                                <div class="callout-title px-3 mr-3">
                                    <svg class="icon icon-primary">
                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-info-circle"></use>
                                    </svg>                            
                                </div>
                                
                                    <div class="text-serif">
                                        <?= $model->other_info ?>
                                    </div>
                                
                            
                            </div>
                        <?php } ?>
                        <?= \open20\amos\core\forms\LastUpdateModelWidget::widget(
                        ['model' => $model, 'cssClass' => 'small']);  ?>   
        
                        
            </article>


            
                

        </section>
    </div>
</div>