<?php
use DateTime;
use yii\helpers\Url;
use app\modules\backendobjects\frontend\Module;
use open20\design\assets\BootstrapItaliaDesignAsset;
use \open20\amos\news\models\NewsAgidPersonMm;
use open20\amos\events\models\AgidAdministrativePersonsMm;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;


$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();
$module = Module::getInstance();

// get current date 
$current_date = new DateTime();
// $current_date->setTime(0, 0);


/**
 * estrazione delle news che sono associate alla persona e che hanno:
 * la data inizio minore della data corrente e una data scadenza maggiore della data corrente 
 * oppure che hanno una data inizio minore della data corrente e una data scadenza settata a null
 * che hanno lo statu del workflow pubblicato e che siano settate in primo piano (pubblicate sul portale)
 */
$newsmm = NewsAgidPersonMm::find()
            ->joinWith(['news'])
            ->andWhere(['agid_person_id' => $model->id])
            ->andWhere(['news.status' => 'NewsWorkflow/VALIDATO'])
            ->andWhere(['primo_piano' => 1])
            ->andWhere(['>=', 'news_expiration_date', $current_date->format('Y-m-d H:i:s')])
            ->andWhere(['<=', 'news.date_news', $current_date->format('Y-m-d H:i:s')])
            ->andWhere(['news_agid_person_mm.deleted_at' => null])
            
            ->orWhere(['and',
                ['agid_person_id' => $model->id],
                ['news.status' => 'NewsWorkflow/VALIDATO'],
                ['primo_piano' => 1],
                ['news_expiration_date' => null],
                ['news_agid_person_mm.deleted_at' => null],
                ['<=', 'news.date_news', $current_date->format('Y-m-d H:i:s')]
            ])
            ->all();


/**
 * estrazione degli eventi che sono associati alla persona e che hanno:
 * la data inizio minore della data corrente e una data scadenza maggiore della data corrente 
 * oppure che hanno una data inizio minore della data corrente e una data scadenza settata a null
 * che hanno lo statu del workflow pubblicato e che siano settate in primo piano (pubblicate sul portale)
 */
$eventimm = AgidAdministrativePersonsMm::find()
    ->joinWith(['event'])
    ->andWhere(['person_id'=>$model->id])
    ->andWhere(['primo_piano' => 1])
    ->andWhere(['event.status' => 'EventWorkflow/PUBLISHED'])
    ->andWhere(['<=', 'event.publication_date_begin', $current_date->format('Y-m-d H:i:s')])
    ->andWhere(['>=', 'event.publication_date_end', $current_date->format('Y-m-d H:i:s')])
    // ->andWhere(['<=', 'event.begin_date_hour', $current_date->format('Y-m-d H:i:s')])
    // ->andWhere(['>=', 'event.end_date_hour', $current_date->format('Y-m-d H:i:s')])
    ->andWhere(['agid_event_administrative_persons_mm.deleted_at' => null])

    ->orWhere(['and',
        ['person_id' => $model->id],
        ['event.status' => 'EventWorkflow/PUBLISHED'],
        ['primo_piano' => 1],
        ['event.deleted_at' => null],
        ['agid_event_administrative_persons_mm.deleted_at' => null],
        ['event.publication_date_end' => null],
        ['<=', 'event.publication_date_begin', $current_date->format('Y-m-d H:i:s')]
        // ['event.end_date_hour' => null],
        // ['<=', 'event.begin_date_hour', $current_date->format('Y-m-d H:i:s')]
    ])
    ->all();

?>

<!--impostazione icona a seconda categoria-->
<?php
    if($model->agid_person_type_id==1){
        $categoryIcon= 'account-tie';
    }else{
        if($model->agid_person_type_id==2){
            $categoryIcon= 'card-account-details-outline';
        }
    }
?>

<?php
    if (!is_null($model->photo)) {

        $photo = $model->getPhoto();
        $url = $photo->getWebUrl($size = 'original', $absolute = false, $canCache = true);
    }

    // Responsabile di: AgidOrganizationalUnit
    $agid_person_organizational_units_manager = $model->getAgidPersonOrganizationalUnitsManager();

    // Fa parte di: AgidOrganizationalUnit
    $organizzazione= $model->getAgidOrganizationalUnit();

    $tags = $model->getTagsList();

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
                    <a title="Vai alla pagina Amministrazione" href="/amministrazione">Amministrazione</a><span class="separator">/</span>
                    </li>                    
                    <?php if($model->agid_person_type_id==1){ ?>
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina Politici" href="/amministrazione/politici">Politici</a><span class="separator">/</span>
                        </li>
                    <?php }else{ ?>
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina Personale amministrativo" href="/amministrazione/personale-amministrativo">Personale amministrativo</a><span class="separator">/</span>
                        </li>
                    <?php } ?>
                    <li aria-current="page" class="breadcrumb-item active">
                    <?= $model->name ?> <?= $model->surname ?>
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
            <h1><?= $model->name ?> <?= $model->surname ?></h1>
            <h2 class="text-secondary h4"><?= $model->role ?></h2>

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
                                                    $model->manager_org || $model->person_function || $model->skills || $model->delegation || $organizzazione || $agid_person_organizational_units_manager ){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link text-decoration-none" title="Vai al paragrafo ruolo" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#ruolo"><span>Ruolo</span></a>
                                        </li>
                                    <?php } ?>      
                                
                                    <!--contatti: telefono email-->
                                    <!--telephone, email-->
                                    <?php if($model->telephone || $model->email){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link text-decoration-none" title="Vai al paragrafo contatti" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#contatti"><span>Contatti</span></a>
                                        </li>
                                    <?php } ?>     

                                    <!--documenti-->
                                    <!--agid_document_cv_id, agid_document_nomination_id,-->
                                    <?php if($model->agid_document_cv_id || $model->agid_document_nomination_id ){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link text-decoration-none" title="Vai al paragrafo documenti"  href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#documenti"><span>Documenti</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--correlati-->
                                    <?php if(!empty($eventimm) || !empty($newsmm)){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link text-decoration-none" title="Vai al paragrafo correlati"  href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#correlati"><span>Novità correlate</span></a>
                                        </li>
                                    <?php } ?>
                                            
                                    <!--altre info-->
                                    <!--other_info -->
                                    <li class="nav-item">
                                        <a class="nav-link text-decoration-none" title="Vai al paragrafo altre informazioni" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#altre-informazioni"><span>Altre informazioni </span></a>
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
                        $model->manager_org || $model->person_function || $model->skills || $model->delegation || $organizzazione || $agid_person_organizational_units_manager){ ?>
                    <article  class="it-page-section mt-5 ">
                        <h4 id="ruolo" class="primary-color anchor-offset">Ruolo</h4>
                        <?php if($model->role_description ){ ?>
                            <div class="text-serif">
                                <?= $model->role_description ?>
                            </div>
                        <?php } ?>
                        
                        <?php if($organizzazione || $agid_person_organizational_units_manager){ ?>
                            
                                <!--organizzazione riferimento-->
                                <!--reference_org-->
                                
                                <?php if(!is_null($organizzazione)){ ?>
                                    
                                    <div class="text-serif">
                                        <p  class="mt-3 font-weight-bold ">Fa parte di:</p>
                                        <div class="row mt-3">
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
                                <?php if($agid_person_organizational_units_manager) : ?>
                                    <div class="text-serif">
                                        <p class="mt-3 font-weight-bold">Responsabile di:</p>
                                        <div class="row mt-3">
                                            <?php 
                                                foreach ($agid_person_organizational_units_manager as $key => $agid_organizational_unit) {
                                                    $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_organizational_unit->id,
                                                        $agid_organizational_unit->className(), $module->modelsDetailMapping[$agid_organizational_unit->className()]);

                                                    echo $this->render('@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                                        [
                                                            'categoryIcon' => 'bank-outline',
                                                            'categoryName' => $agid_organizational_unit->agidOrganizationalUnitContentType->name,
                                                            'cardTitle' => $agid_organizational_unit->name,
                                                            'cardText'=>$agid_organizational_unit->short_description,
                                                            'urlDetail' =>$route,
                                                            'additionalCssExternalClass' => 'box-card mb-4',
                                                            'columnWidth' => 'col-md-6 col-xs-12',
                                                        ]
                                                    );
                                                }
                                            ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            
                        <?php } ?>           
                            
                        <?php if($model->date_start_settlement && $model->agid_person_type_id==1){ ?>
                            <div class="mt-2 d-flex align-items-center text-serif">
                                <p class="h6 d-flex font-weight-bold my-0 mr-1">Data inizio insediamento:</p>
                                <p class="my-0"><?= Yii::$app->formatter->asDate($model->date_start_settlement, 'dd').' '.ucwords(Yii::$app->formatter->asDate($model->date_start_settlement, 'MMMM')).' '.Yii::$app->formatter->asDate($model->date_start_settlement, 'YYYY'); ?></p>
                            </div>
                                    
                        <?php } ?>
                        <?php if($model->date_end_assignment){ ?>
                            <div class="mt-2 d-flex align-items-center text-serif">
                                <p class="h6 d-flex font-weight-bold my-0 mr-1">Data conclusione incarico:</p>
                                <p class="my-0">
                                    <?= Yii::$app->formatter->asDate($model->date_end_assignment, 'dd').' '.ucwords(Yii::$app->formatter->asDate($model->date_end_assignment, 'MMMM')).' '.Yii::$app->formatter->asDate($model->date_end_assignment, 'YYYY'); ?>

                                </p>
                            </div>
                            
                        <?php } ?>    
                        
                        <?php if($model->bio && $model->agid_person_type_id==1 ){ ?><!--bio visibile solo per politici-->
                            <div class="text-serif mt-2">
                                <p class="font-weight-bold h6">Biografia:</p>
                                <?= $model->bio ?>
                            </div>
                        <?php } ?>           
                        <div class="row">
                        <!--< ?php if($model->person_function){ ?>
                            <div class="card card-teaser  pl-1 rounded col-lg-4 col-md-6 col-xs-12 ">
                                <div class="shadow  p-4 mt-3 flex-grow-1 d-flex">
                                    <svg class="icon icon-primary" role="img" >
                                            <use xlink:href=" < ?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#format-list-checkbox"></use>
                                    </svg>
                                    <div class="card-body ml-2">
                                        <h5 class="card-title">
                                                Funzione
                                        </h5>
                                        <div class="card-text text-serif">
                                                < ?= $model->person_function ?>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        < ?php } ?>-->
                        <?php if($model->skills){ ?>
                            <div class="card card-teaser  pl-1 rounded col-lg-6 col-md-6 col-xs-12 ">
                                <div class="shadow  p-4 mt-3 flex-grow-1 d-flex">
                                    <svg class="icon icon-primary" role="img" >
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#brain"></use>
                                    </svg>
                                    <div class="card-body ml-2">
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
                            <div class="card card-teaser  pl-1 rounded col-lg-6 col-md-6 col-xs-12 ">
                                <div class="shadow  p-4 mt-3 flex-grow-1 d-flex">
                                    <svg class="icon icon-primary" role="img" >
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#sitemap"></use>
                                    </svg>
                                    <div class="card-body ml-2">
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
                    
                        <div class="card card-teaser  p-1 rounded col-lg-9 col-md-12 ">
                                <div class="shadow  p-4  flex-grow-1 d-flex">
                                    <div class="card-body">
                                        <!--tel-->
                                        <?php if($model->telephone){ ?>
                                            <div class="mb-2">
                                                <p class="mb-0 font-weight-bold">Telefono:</p>
                                                <?= $model->telephone ?>
                                                
                                            </div>
                                        <?php } ?>
                                        
                                        <!-- email -->
                                        <?php if($model->email){ ?>
                                            <div class="mb-2">
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
            <?php if($model->agid_document_cv_id || $model->agid_document_nomination_id) : ?>

                <article class="it-page-section mt-5 ">
                    <h4 id="documenti" class="primary-color anchor-offset">Documenti</h4>
                    <div class="row">

                        <?php 
                            $agid_document_cv = $model->getCvDocumentoValidated();
                        ?>

                        <?php if($agid_document_cv) : ?>

                            <?php 
                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_document_cv->id, $agid_document_cv->className(), 
                                                    $module->modelsDetailMapping[$agid_document_cv->className()]);
                            ?>

                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Curriculum vitae </p>
                                <div class="my-3 card-wrapper card-teaser card-one-block ">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $agid_document_cv->titolo ?>" >
                                                <?= $agid_document_cv->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>



                        <?php 
                            $agid_document_nomination = $model->getNominationDocumentoValidated();
                        ?>
                    
                        <?php if($agid_document_nomination) : ?>

                            <?php 
                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_document_nomination->id, $agid_document_nomination->className(), 
                                                                            $module->modelsDetailMapping[ $agid_document_nomination->className() ]);
                            ?>

                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Atto di nomina</p>
                                <div class="my-3 card-wrapper card-teaser card-one-block ">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route ?>" title="<?= $agid_document_nomination->titolo?>">
                                                
                                                <?= $agid_document_nomination->titolo ?>
                                            </a>    
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>
                    

                        <?php 
                            $agid_document_import = $model->getImportDocumentoValidated();
                        ?>

                        <?php if($agid_document_import) : ?>

                            <?php
                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_document_import->id, $agid_document_import->className(), 
                                                                    $module->modelsDetailMapping[$agid_document_import->className()]);
                            ?>

                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Importi di viaggio e/o servizio</p>
                                <div class="my-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $agid_document_import->titolo ?>">
                                                <?= $agid_document_import->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>


                        <?php
                            $agid_document_other_posts = $model->getOtherPostsDocumentoValidated();
                        ?>
                   
                        <?php if($agid_document_other_posts) : ?>

                            <?php
                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_document_other_posts->id , $agid_document_other_posts->className(), 
                                                $module->modelsDetailMapping[$agid_document_other_posts->className()]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Altre cariche</p>
                                <div class="my-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href="<?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $roure?>" title="File <?= $agid_document_other_posts->titolo ?> KB">
                                                <?= $agid_document_other_posts->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>



                        <?php 
                            $agid_document_balance_sheet = $model->getBalanceSheetDocumentoValidated();
                        ?>
                    
                        <?php if($agid_document_balance_sheet) : ?>
                            <?php
                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_document_balance_sheet->id,
                                            $agid_document_balance_sheet->className(), $module->modelsDetailMapping[$agid_document_balance_sheet->className()]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Situazione patrimoniale</p>
                                <div class="my-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $agid_document_balance_sheet->titolo ?>">
                                            
                                            <?= $agid_document_balance_sheet->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    

                        <?php 
                            $agid_document_tax_return = $model->getTaxReturnDocumentoValidated();
                        ?>

                        <?php if($agid_document_tax_return) : ?>

                            <?php
                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_document_tax_return->id, $agid_document_tax_return->className(), 
                                        $module->modelsDetailMapping[$agid_document_tax_return->className()]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Dichiarazione dei redditi</p>
                                <div class="my-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href="<?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $agid_document_tax_return->titolo?>">
                                                <?= $agid_document_tax_return->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>


                        <?php 
                            $agid_document_election_expenses = $model->getElectionExpensesDocumentoValidated();
                        ?>
                   
                        <?php if($agid_document_election_expenses) : ?>
                            <?php
                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_document_election_expenses->id, $agid_document_election_expenses->className(), 
                                            $module->modelsDetailMapping[$agid_document_election_expenses->className()]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Spese elettorali</p>
                                <div class="my-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $agid_document_election_expenses->titolo ?>">
                                            <?= $agid_document_election_expenses->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php 
                            $agid_document_changes_balance_sheet = $model->getChangesBalanceSheetDocumentoValidated();
                        ?>

                        <?php if($agid_document_changes_balance_sheet) : ?>
                            <?php
                                $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_document_changes_balance_sheet->id, 
                                    $agid_document_changes_balance_sheet->className(), $module->modelsDetailMapping[$agid_document_changes_balance_sheet->className()]);
                                                        
                            ?>
                            <div class="d-flex flex-column col-md-6">
                                <p class="h6">Variazioni situazione patrimoniale</p>
                                <div class="my-3 card-wrapper card-teaser card-one-block">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                        </svg>
                                        <div class="card-body overflow-hidden">
                                            <a class="text-decoration-none" href="<?= $route  ?>" title="<?= $agid_document_changes_balance_sheet->titolo ?> ">
                                            <?= $agid_document_changes_balance_sheet->titolo ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </article> 

            <?php endif; ?>
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
                                    $url = $news->newsImage->getWebUrl('dashboard_news', false, true);
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

                        <?php } ?>
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
                            $url = $eventi->eventLogo->getWebUrl('dashboard_news', false, true);
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