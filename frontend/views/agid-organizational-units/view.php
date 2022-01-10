<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\core\helpers\Html;
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
use open20\agid\organizationalunit\Module;
use open20\agid\organizationalunit\models\AgidOrganizationalOrganizationalUnitMm;
use open20\agid\person\models\AgidPersonOrganizationalUnitMm;
use open20\agid\organizationalunit\models\AgidOrganizationalUnitServiceMm;
use \open20\agid\service\models\AgidService;
use yii\helpers\Url;



$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();


$persone=AgidPersonOrganizationalUnitMm::find()->andWhere(['agid_organizational_unit_id' =>$model->id ])->all();
$tags = $model->getTagsList();



if(!empty($persone)){

    $ids = \open20\agid\person\models\AgidPersonOrganizationalUnitMm::find()->select('agid_person_id')->andWhere(['agid_organizational_unit_id' =>$model->id ])->distinct()->column();    
    $personeArea=\open20\agid\person\models\AgidPerson::find()
                                                        ->andWhere(['NOT IN', 'id', $ids])
                                                        ->andWhere(['or', 
                                                                    ['=', 'agid_organizational_unit_1_id', $model->id],
                                                                    ['=', 'agid_organizational_unit_2_id', $model->id],
                                                                    ['=', 'agid_organizational_unit_3_id', $model->id],
                                                                    ['=', 'agid_organizational_unit_4_id', $model->id],
                                                                    ['=', 'agid_organizational_unit_5_id', $model->id],
                                                                    ])                                                                   
                                                        ->all();
    }else{
        $personeArea=\open20\agid\person\models\AgidPerson::find()
                                                        ->andWhere(['or', 
                                                                    ['=', 'agid_organizational_unit_1_id', $model->id],
                                                                    ['=', 'agid_organizational_unit_2_id', $model->id],
                                                                    ['=', 'agid_organizational_unit_3_id', $model->id],
                                                                    ['=', 'agid_organizational_unit_4_id', $model->id],
                                                                    ['=', 'agid_organizational_unit_5_id', $model->id],
                                                                    ])                                                                   
                                                        ->all();
    }

                                                                    
                                                                   
$organizations=AgidOrganizationalOrganizationalUnitMm::find()->andWhere(['agid_organizational_unit_id' => $model->id])->all();


$module = Yii::$app->getModule('backendobjects');

$serviceUnit=AgidOrganizationalUnitServiceMm::find()->andWhere(['agid_organizational_unit_id' => $model->id])->all(); 
$documenti=$model->agidOrganizationalUnitDocumentiMm;
$servizi=$model->agidOrganizationalUnitServicesMm;       

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$this->title =strip_tags($model);
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/app']];
$this->params['breadcrumbs'][] = ['label' => Module::t('amosorganizationalunit', 'Organizational Unit'), 'url' => ['index']];
$this->params['breadcrumbs'][] = strip_tags($model);

if (!is_null($model->logo_image)) {
    $url = $model->logo_image->getUrl('original', false, true);
  }
?>


<!--testata titolo: inseirti dati dinamici (tipologia doc, nome, sottotitolo, descr brevetranne condivisione, per ora commentato-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">               
            <?php if($model->short_description){ ?>
                <?= $model->short_description ?>
            <?php } ?>
            
        </div>
        <div class="offset-lg-1 col-lg-3 col-md-4">
            <aside id="argomenti-sezione">
                <div class="argomenti">                 
                    <div class="condividi">
                        <?= $share_and_see_actions->getHtml(); ?>
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
<?php if ($model->logo_image){ ?>
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
                                    <h3 id="titolo-indice" class="position-relative no_toc px-4 text-left primary-color d-flex align-items-center justify-content-between" style="font-size:16px">
                                        Indice della pagina  
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#chevron-down"></use>
                                        </svg>                       
                                </a>  
                                
                                <ul id="lista-paragrafi" class="link-list collapse show">
                                    <!--competenze-->
                                    <!--skills-->
                                    <?php if($model->skills){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo competenze" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#competenze"><span>Cosa fa</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--persone-->
                                    <!--persone-->
                                    <?php if($persone || $personeArea){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo persone" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#persone"><span>Persone</span></a>
                                        </li>
                                    <?php } ?>

                                    <!--uffici-->
                                    <!--uffici-->
                                    <?php if($organizations){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo uffici" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#uffici"><span>Uffici</span></a>
                                        </li>
                                    <?php } ?>

                                    

                                    <!--ORGANIZZAZIONE-->
                                    <?php if($model->agid_person_president_id || $model->agid_person_vice_president_id){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo organizzazione" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#organizzazione"><span>Organizzazione</span></a>
                                        </li>
                                    <?php } ?>

                                    

                                    <!--contatti-->
                                    <!-- telephone_reference , mail_reference, pec_reference -->
                                    <?php if($model->telephone_reference || $model->mail_reference ||$model->pec_reference ){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo contatti" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#contatti"><span>Contatti</span></a>
                                        </li>
                                    <?php } ?>


                                    
                                   <!--CONTENUTI CORRELATI-->
                                    <?php if($documenti || $servizi){?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo correlati" href="<?= \Yii::$app->params['platform']['frontendUrl'] . Url::current()?>#correlati"><span>Correlati</span></a>
                                        </li>
                                    <?php } ?>



                                    
                                    <!--altre info-->
                                    <!--further_information, help_box -->
                                    
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
            <!--COMPETENZE-->
            <!--skills-->
            <?php if($model->skills){ ?>
                <article  class="it-page-section mt-5 mt-5 ">
                    <h4 id="competenze" class="primary-color anchor-offset">Cosa fa</h4>
                    <div class="text-serif">
                        <?= $model->skills ?>
                    </div>
                </article>
            <?php } ?>

            <!--PERSONE-->
            <!--PERSONE RESPONSABILI ALL'UO, COLLEGATE ALL'UO-->
            <?php if($persone || $personeArea){ ?>
                <article  class="it-page-section mt-5 mt-5 ">
                    <h4 id="persone" class="primary-color anchor-offset">Persone</h4>
                    <?php if($persone){ ?>
                        <p class="h6">Responsabili</p>
                        <div class="list-view w-100 d-flex flex-wrap">
                            <?php foreach ( $persone as $p) : ?>
                                <?php 
                                    if (!is_null($p->agidPerson->photo)) {
                                        $imageUrl = $p->agidPerson->photo->getUrl('original', false, true);
                                    }
                                    $titleCard=$p->agidPerson->name . ' '. $p->agidPerson->surname;


                                    $personModel= $p->agidPerson;
                                    $cls = $personModel->className();
                                    $urlDetail = Yii::$app->getModule('backendobjects')::getDetachUrl($personModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                    
                                ?>
                                
                                <div class="col-md-6 col-xs-12 agid-generic-card-container rounded box-card mb-4 ">
                                    <div class=" h-100  shadow ">
                                        <div class="row m-0">
                                            <?php if(!is_null($p->agidPerson->photo)) { ?>
                                                <div class="col-md-6 col-lg-8 py-3 px-3 d-flex flex-column">
                                                    <a class="h5 text-uppercase font-weight-bold primary-color" title="Vai alla scheda di <?= $titleCard ?>" href="<?= $urlDetail ?>"><?= $titleCard ?></a>
                                                        <p class="role-description"><?= $p->agidPerson->role ?>  </p>    
                                                        <div class="read-more flex-grow-1 d-flex align-items-end">
                                                            <a class="text-uppercase font-weight-bold" title="Esplora <?= $titleCard ?>" href="<?= $urlDetail ?>">Leggi di più →</a> 
                                                        </div>   
                                                </div>
                                                <div class="col-md-6 col-lg-4 p-0">
                                                    <img src="<?= $imageUrl ?>" class="h-100 mb-0 figure-img img-fluid " style="max-height: 250px ; object-fit: cover;" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">


                                                    
                                                </div>
                                            <?php }else{ ?>
                                                <div class="col py-3 px-3 d-flex flex-column ">
                                                    <a class="h5 text-uppercase font-weight-bold primary-color" title="Vai alla scheda di <?= $titleCard ?>" href="<?= $urlDetail ?>"><?= $titleCard ?></a>
                                                    <p class="role-description"><?= $p->agidPerson->role ?> </p>
                                                    
                                                    <div class="read-more flex-grow-1 d-flex align-items-end">
                                                    <a class="text-uppercase font-weight-bold" title="Esplora <?= $titleCard ?>" href="<?= $urlDetail ?>">Leggi di più →</a> 
                                                    </div>   
                                                    
                                                </div>
                                            <?php } ?>
                                        </div>                                   
                                    


                                    </div>                                   
                                </div>
                            
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>
                    <?php if($personeArea){ ?>
                        <p class="h6">Riferimenti</p>

                        <div class="list-view w-100 d-flex flex-wrap">
                            <?php foreach ( $personeArea as $p) : ?>
                                <?php 
                                    if (!is_null($p->photo)) {
                                        $imageUrl = $p->photo->getUrl('original', false, true);
                                    }
                                    $titleCard=$p->name . ' '. $p->surname;


                                    $personModel= $p;
                                    $cls = $personModel->className();
                                    $urlDetail = Yii::$app->getModule('backendobjects')::getDetachUrl($personModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                    
                                ?>
                                
                                <div class="col-md-6 col-xs-12 agid-generic-card-container rounded box-card mb-4 ">
                                    <div class=" h-100  shadow ">
                                        <div class="row m-0">
                                            <?php if(!is_null($p->photo)) { ?>
                                                <div class="col-md-6 col-lg-8 py-3 px-3 d-flex flex-column">
                                                    <a class="h5 text-uppercase font-weight-bold primary-color" title="Vai alla scheda di <?= $titleCard ?>" href="<?= $urlDetail ?>"><?= $titleCard ?></a>
                                                        <p class="role-description"><?= $p->role ?>  </p>    
                                                        <div class="read-more flex-grow-1 d-flex align-items-end">
                                                            <a class="text-uppercase font-weight-bold" title="Esplora <?= $titleCard ?>" href="<?= $urlDetail ?>">Leggi di più →</a> 
                                                        </div>   
                                                </div>
                                                <div class="col-md-6 col-lg-4 p-0">
                                                    <img src="<?= $imageUrl ?>" class="h-100 mb-0 figure-img img-fluid " style="max-height: 250px ; object-fit: cover;" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">


                                                    
                                                </div>
                                            <?php }else{ ?>
                                                <div class="col py-3 px-3 d-flex flex-column ">
                                                    <a class="h5 text-uppercase font-weight-bold primary-color" title="Vai alla scheda di <?= $titleCard ?>" href="<?= $urlDetail ?>"><?= $titleCard ?></a>
                                                    <p class="role-description"><?= $p->role ?> </p>
                                                    
                                                    <div class="read-more flex-grow-1 d-flex align-items-end">
                                                    <a class="text-uppercase font-weight-bold" title="Esplora <?= $titleCard ?>" href="<?= $urlDetail ?>">Leggi di più →</a> 
                                                    </div>   
                                                    
                                                </div>
                                            <?php } ?>
                                        </div>                                   
                                    


                                    </div>                                   
                                </div>
                            
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>

                </article>
            <?php } ?>

            <!--Uffici-->
            <!--Uffici (strutture cllegate-->
         
            <?php if($organizations){ ?>
                <article  class="it-page-section mt-5 mt-5 ">
                    <h4 id="uffici" class="primary-color anchor-offset">Uffici</h4>
                    <div class="row">
                    
                        <?php foreach($organizations as $ou) : ?>
                            <?php 
                                $uoModel=$ou->agidFatherOrganizationalUnit;

                                $cls = $uoModel->className();
                                $urlDetail = Yii::$app->getModule('backendobjects')::getDetachUrl($uoModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                
                            ?>
                            
                            <?=
                                $this->render(
                                    '@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                    [
                                    'categoryIcon' => 'bank-outline',
                                    'categoryName' => $uoModel->agidOrganizationalUnitContentType->name,
                                    'cardTitle' => $uoModel->name,
                                    'cardText'=>$uoModel->short_description,
                                    'urlDetail' =>$urlDetail,
                                    'additionalCssExternalClass' => 'box-card mb-4',
                                    'columnWidth' => 'col-md-6 col-xs-12',
                                    ]
                                );
                            ?>
                        
                        <?php endforeach; ?>
                    </div>
                </article>
            <?php } ?>

           

            <!--ORGANIZZAZIONE-->
            <?php if($model->agid_person_president_id || $model->agid_person_vice_president_id){ ?>
                <article class="it-page-section mt-5 mt-5 ">
                    <h4 id="organizzazione"  class="primary-color anchor-offset">Organizzazione</h4>
                        <?php if($model->agid_person_president_id){ ?>
                            <div class="mb-4">
                                <p class="h6">Presidente:</p>
                                <?php
                                    $presidenteModel= $model->agidPersonPresident;
                                    $cls = $presidenteModel->className();
                                    $route = Yii::$app->getModule('backendobjects')::getDetachUrl($presidenteModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                                        
                                ?>
                                <a href="<?=$route ?>" class="chip chip-simple chip-primary text-decoration-none">
                                    <span class="chip-label"><?= $model->agidPersonPresident->name ?> <?= $model->agidPersonPresident->surname ?></span>
                                </a> 
                            </div>                
                        <?php } ?>
                        <?php if($model->agid_person_vice_president_id){ ?>
                            <div class="mb-4">
                                <h6>Vicepresidente:</h6>
                                  <a href="<?=Yii::$app->getModule('backendobjects')::getDetachUrl($model->agidPersonVicePresident->id,$model->agidPersonVicePresident->className(), $module->modelsDetailMapping[$model->agidPersonVicePresident->className()]) ?>" class="chip chip-simple chip-primary text-decoration-none">
                                  <span class="chip-label"><?= $model->agidPersonVicePresident->name ?> <?= $model->agidPersonVicePresident->surname ?></span>
                                  </a>

                            </div>
                        <?php } ?>
                </article>
            <?php } ?>


            <!--CONTATTI: telefono email-->
            <!--telephone_reference, mail_reference, pec_reference-->
            <?php if($model->telephone_reference || $model->mail_reference || $model->pec_reference){ ?>
                <article class="it-page-section mt-5 mt-5">
                    <h4 id="contatti"  class="primary-color anchor-offset">Contatti</h4>
                    <div class="row">
                        <div class="card card-teaser  p-0 rounded col-lg-9 col-md-12 ">
                            <div class="shadow  p-4 m-3 flex-grow-1 d-flex">
                                <div class="card-body">
                                    <!--sede principale-->
                                    <!--headquarters_name-->
                                    <?php if($model->headquarters_name || $model->address){ ?>
                                        <div class="mb-3">
                                            <p class="mb-0 font-weight-bold">Sede:</p>
                                            <?= $model->headquarters_name ?>
                                            <?php if($model->headquarters_name && $model->address){ ?><span>-</span><?php } ?>
                                            <?= $model->address ?> 
                                            <?php if($model->cap){ ?>
                                                - <?= '' .$model->cap?> 
                                            <?php } ?>
                                            
                                        </div>
                                    <?php } ?>
                                    <!--orari-->
                                    <!-- public_hours -->
                                    <?php if($model->public_hours){ ?>
                                        <div class="mb-3">
                                            <p class="mb-0 font-weight-bold">Orari:</p>
                                            <?= $model->public_hours?>
                                        </div>
                                    <?php } ?>
                                    <?php if($model->telephone_reference){ ?>
                                        <div class="mb-3">
                                            <p class="mb-0 font-weight-bold">Telefono:</p>
                                            <?= $model->telephone_reference ?>
                                        </div>
                                    <?php } ?>
                                    <?php if($model->mail_reference){ ?>
                                        <div class="mb-3">
                                            <p class="mb-0 font-weight-bold">Email:</p>
                                            <?= $model->mail_reference ?>
                                        </div>
                                    <?php } ?>
                                    <?php if($model->pec_reference){ ?>
                                        <div class="mb-3">
                                            <p class="mb-0 font-weight-bold">PEC:</p>
                                            <?= $model->pec_reference ?>
                                        </div>
                                    <?php } ?>
                                    
                                    
                                </div>
                            </div>  
                        </div> 
                    </div>     
                   
                    

                    
                    
                </article>
            <?php } ?>




            <!--CONTENUTI CORRELATI-->
            <?php if($documenti || $servizi){?>
                <article  class="it-page-section mt-5 mt-5 ">
                    <h4 id="correlati" class="primary-color anchor-offset">Contenuti correlati</h4>
                        <?php if($documenti){ ?>
                            <div class="my-3">
                                <p class="h6">Documenti </p>
                                <div class="row">
                                    <?php
                                    
                                        foreach($documenti as $docmm){
                                            $doc=$docmm->documenti;
                                            $doc->titolo;
                                            $doc->sottotitolo; 

                                            $docModel= $doc;
                                            $cls = $docModel->className();
                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($docModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                            



                                        
                                        
                                            $refArea = $doc->agidOrganizationalUnitContentTypeArea->name ;
                                            if(!empty($refArea)){
                                                $areaModel= $doc->agidOrganizationalUnitContentTypeArea;
                                                $cls = $areaModel->className();
                                                $refAreaLink = Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                            
                                            }
                                            
                                        ?>
                                            <?=
                                            $this->render(
                                                '@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                                [
                                                'categoryIcon' => 'file-document-outline',
                                                'categoryName' => $doc->documentiAgidContentType->name,
                                                'cardTitle' => $doc->titolo,
                                                'cardText'=>$doc->descrizione_breve,
                                                'urlDetail' => $route,
                                                'refArea' => $refArea,
                                                'refAreaLink' => $refAreaLink,
                                                'additionalCssExternalClass' => 'box-card mb-4',
                                                'columnWidth' => 'col-md-6 col-xs-12',
                                                ]
                                            );
                                        ?>
                                    
                                        <?php }
                                    ?>
                                </div>
                        
                            </div>
                        <?php } ?>

                        <?php if($servizi){ ?>
                            <div class="my-3">
                                <p class="h6">Servizi </p>
                                
                                <div class="row">
                                    <?php
                                        
                                        foreach($servizi as $servmm){
                                            $servizio=$servmm->agidService;
                                            $servizio->name;
                                            $servizio->description; 

                                            $servizioModel= $servizio;
                                            $cls = $servizioModel->className();
                                            $route = Yii::$app->getModule('backendobjects')::getDetachUrl($servizioModel->id,$cls, $module->modelsDetailMapping[$cls]);
                                    
                                            
                                            
                                        ?>
                                        <?=
                                    $this->render(
                                        '@vendor/open20/design/src/components/agid/views/agid-card-generic',
                                        [
                                        'categoryIcon' => 'card-account-details-outline',
                                        'categoryName' => $servizio->agidServiceType->name,
                                        'cardTitle' => $servizio->name,
                                        'cardText'=>$servizio->description,
                                        'urlDetail' => $route,
                                        'additionalCssExternalClass' => 'box-card mb-4',
                                        'columnWidth' => 'col-md-6 col-xs-12',
                                        ]
                                    );
                                    ?>
                                    <?php } ?>
                                    
                                    


                                </div>
                            </div>
                        
                        <?php } ?>

                        
                </article>
            <?php } ?>











            <!--ALTRE INFO-->
            <!--further_information, help_box -->
            <?php if($model->further_information || $model->help_box){ ?> 
                <article class="it-page-section mt-5 mt-5 ">
                    <h4 id="altre-informazioni" class="primary-color anchor-offset">Altre informazioni</h4>
                    <div class="callout">
                        <div class="callout-title px-3 mr-3">
                            <svg class="icon icon-primary">
                                <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-info-circle"></use>
                            </svg>
                        </div>
                    
                        <?php if($model->further_information){ ?>
                            <div class="mb-3">
                                <?= $model->further_information ?>
                            </div>
                        <?php } ?>
                        <?php if($model->help_box){ ?>
                            <div class="mb-3">
                                <?= $model->help_box ?>   
                            </div>
                        <?php } ?>
                        
                    
                    </div>
                    <?= \open20\amos\core\forms\LastUpdateModelWidget::widget(
                    ['model' => $model, 'cssClass' => 'small']);  ?>  
      
                    
                        
                    
                    
                        
                    
                </article>
            <?php } ?>




            
           



            
            



            
        </section>
    </div>
</div>
