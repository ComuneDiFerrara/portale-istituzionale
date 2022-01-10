<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\attachments\components\AttachmentsListBS4;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
use app\modules\backendobjects\frontend\Module;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$module = Module::getInstance();

?>

<?php
    $url = '/img/img_default.jpg';
    if (!is_null($model->newsImage)) {
      $url = $model->newsImage->getWebUrl('social', false, true);
    }
    $siteManagementModule = \Yii::$app->getModule('sitemanagement');
    if($model->newsDocumento){
        $mainDoc=$model->newsDocumento->getDocumentMainFile();
    }

    $docSize=((float)$mainDoc->size)/1000;
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
                    <a title="Vai alla novità" href="/novità">Novità</a><span class="separator">/</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                    <?= $model->title ?>
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
            <h1><?= $model->title ?></h1>
            
            <?php if($model->descrizione_breve){ ?>
                <p><?= $model->descrizione_breve ?></p>
            <?php } ?>

            <?php 
                // TODO da portare la logica nel model se c'è tempo
                $edited_by_agid_organizational_unit = $model->getEditedByAgidOrganizationalUnit()
                    ->andWhere(['status' => \open20\agid\organizationalunit\models\AgidOrganizationalUnit::AGID_ORGANIZATIONAL_UNIT_WORKFLOW_STATUS_VALIDATED ])
                    ->andWhere(['deleted_at' => null])
                    ->one();

                $news_agid_person_id = ArrayHelper::getColumn(
                    $model->newsAgidPersonMm,

                    function ($element) {
                        return $element['agid_person_id'];
                    }
                );
                $news_agid_person = \open20\agid\person\models\AgidPerson::find()
                                    ->andWhere([ 'id' => $news_agid_person_id ])  
                                    ->andWhere(['status' => \open20\agid\person\models\AgidPerson::AGID_PERSON_STATUS_VALIDATED])
                                    ->andWhere([ 'deleted_at' => null ])
                                    ->all();
            ?>

            <?php if($edited_by_agid_organizational_unit || $news_agid_person ) : ?>

                <?php if($edited_by_agid_organizational_unit) : ?>
                    <p class=" small">
                        <strong>A cura di: </strong>
                        <?= $edited_by_agid_organizational_unit->name ?>
                    </p>
                <?php endif; ?>


                <?php if($news_agid_person) : ?>
                    <div class="text-serif small">
                        <strong>Persone: </strong>
                        <span class="comma-list">
                            <?php foreach ($news_agid_person as $key => $agid_person) : ?>

                                <?php 
                                    $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_person->id, $agid_person->className(), 
                                        $module->modelsDetailMapping[$agid_person->className()]);    
                                ?>
                                <a href="<?= $route?>" title="Vai alla scheda di <?= $agid_person->name ?><?=  $agid_person->surname ?> ">
                                    <?= $agid_person->name. ' '.  $agid_person->surname ?>  
                                </a>

                            <?php endforeach; ?>
                        </span>
                    </div> 
                <?php endif;  ?>

            <?php endif;  ?>

          
            <?php if($model->date_news || $model->news_expiration_date): ?>
                <div class="row mt-3 mb-4">
                    <?php if($model->date_news): ?>
                        <div class="col-6">
                            <small>Data di inizio:</small>
                            <p class="font-weight-semibold text-monospace"><?= Yii::$app->formatter->asDate($model->date_news, 'dd').'/'.ucwords(Yii::$app->formatter->asDate($model->date_news, 'MM')).'/'.Yii::$app->formatter->asDate($model->date_news, 'YYYY'); ?></p>
                        </div>
                    <?php endif ?>
                    <?php if ($model->news_expiration_date){ ?>
                        <div class="col-6">
                            <small>Data di scadenza:</small>
                            <p class="font-weight-semibold text-monospace"><?= Yii::$app->formatter->asDate($model->news_expiration_date, 'dd').'/'.ucwords(Yii::$app->formatter->asDate($model->news_expiration_date, 'MM')).'/'.Yii::$app->formatter->asDate($model->news_expiration_date, 'YYYY'); ?></p>
                        </div>
                    <?php } ?>
                    
                </div>
            <?php endif; ?>
                        
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
                                    <!--CORPO-->
                                    <!--testo, gallery, persone-->
                                    <li class="nav-item active">
                                        <a class="nav-link active" title="Vai al paragrafo corpo" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#corpo"><span>Contenuto della notizia</span></a>
                                    </li>



                                    <!--doc allegati -->
                                    <?php if($mainDoc || $model->attachmentsForItemView){ ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo documento" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#allegati"><span>Documenti</span></a>
                                        </li>
                                    <?php } ?>
                                    
                                    

                                    <!--Correlati-->
                                    <?php if($model->newsRelatedNewsMm || $model->newsRelatedDocumentiMm || $model->newsRelatedAgidServiceMm){ ?>
                                        <li class="nav-item">
                                            <a class="nav-link" title="Vai al paragrafo correlati" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#correlati">
                                            <span>Correlati</span>
                                            </a>
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

        <!--IMMAGINE--> 
                <article class="it-page-section mt-5">  
                    <figure class="figure">
                        <img src="<?= $url ?>" class="figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">
                    </figure>
                </article>
            
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
                    <div class="mt-4 images-gallery">
                        <?= \amos\sitemanagement\widgets\SMSliderWidgetBS4::widget(['sliderId' => $model->image_site_management_slider_id]); ?>
                    </div>
                <?php endif; ?>

                <!--video notizia-->
                <?php if (!is_null($siteManagementModule)): ?>  
                    <div class="mt-4 videos-gallery">
                        <?= \amos\sitemanagement\widgets\SMSliderWidgetBS4::widget(['sliderId' => $model->video_site_management_slider_id]); ?>
                    </div>
                <?php endif; ?>
            </article>




            <!--DOCUMENTI: doc principale, allegati-->
            <?php if($mainDoc || $model->attachmentsForItemView){ ?>
                <article class="it-page-section mt-5">
                    <h4 id="allegati" class="primary-color anchor-offset">Documenti</h4>
                    <!--doc principale-->
                    <?php if($mainDoc || !empty($model->newsDocumento->link_document)){ ?>
                        <h6>Documento principale</h6>
                        <?php if($mainDoc): ?>
                            <div class="row mb-3">
                                <div class="card-wrapper col-lg-4 col-md-6 ">
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
                            </div> 
                        <?php endif; ?>
                        
                        <?php if( $model->newsDocumento && !empty($model->newsDocumento->link_document)): ?>
                            <div class="row">
                                <div class="attachment-item card-wrapper mb-4 card-teaser card-one-block col-lg-4 col-md-6">
                                    <div class="card card-teaser card-one-block  shadow p-4">
                                        <svg class="icon icon-primary">
                                            <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip"></use>
                                        </svg>
                                        <div class="card-body">
                                            <a href="<?=$model->newsDocumento->link_document?>" target="_blank" title="Visualizza il file <?= $model->newsDocumento->titolo ?>">
                                                <?=$model->newsDocumento->titolo?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                        <?php endif; ?>
                    <?php } ?>   

                     <!--allegati:-->     
                     <?php if(!empty($model->attachmentsForItemView)){ ?>
                        <h6>Documenti allegati</h6>
                            
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
            <?php 

                // newsRelatedNewsMm
                $news_related_news_id = ArrayHelper::getColumn(
                    $model->newsRelatedNewsMm,

                    function ($element) {
                        return $element['related_news_id'];
                    }
                );
                $news_related_news = \open20\amos\news\models\News::find()
                                    ->andWhere([ 'id' => $news_related_news_id ])  
                                    ->andWhere(['status' => \open20\amos\news\models\News::NEWS_WORKFLOW_STATUS_VALIDATO])
                                    ->andWhere([ 'deleted_at' => null ])
                                    ->all();


                // newsRelatedDocumentiMm
                $news_related_documenti_id = ArrayHelper::getColumn(
                    $model->newsRelatedDocumentiMm,

                    function ($element) {
                        return $element['related_documenti_id'];
                    }
                );
                $news_related_documenti = \open20\amos\documenti\models\Documenti::find()
                        ->andWhere([ 'id' => $news_related_documenti_id ])  
                        ->andWhere(['status' => \open20\amos\documenti\models\Documenti::DOCUMENTI_WORKFLOW_STATUS_VALIDATO])
                        ->andWhere([ 'deleted_at' => null ])
                        ->all();


                // newsRelatedAgidServiceMm
                $news_related_agid_service_id = ArrayHelper::getColumn(
                    $model->newsRelatedAgidServiceMm,

                    function ($element) {
                        return $element['related_agid_service_id'];
                    }
                );
                $news_related_agid_service = \open20\agid\service\models\AgidService::find()
                    ->andWhere([ 'id' => $news_related_agid_service_id ])  
                    ->andWhere(['status' => \open20\agid\service\models\AgidService::AGID_SERVICE_STATUS_VALIDATED])
                    ->andWhere([ 'deleted_at' => null ])
                    ->all();
            ?>

            <?php if($news_related_news || $news_related_documenti || $news_related_agid_service ) : ?>

                <article class="it-page-section mt-5">
                    <h4 id="correlati" class="primary-color anchor-offset">Correlati</h4>

                    <?php if($news_related_news) : ?>
                        <div class="text-serif"><strong>News correlate:</strong>
                            <span class="comma-list">
                                <?php foreach ($news_related_news as $news) : ?>
                                    <?php
                                        $module = Module::getInstance();
                                        $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($news->id, $news->className(), $module->modelsDetailMapping[$news->className()]);
                                                            
                                    ?>
                                    <a class="text-decoration-none" title="Vai alla pagina <?= $news->titolo?>" href="<?= $route ?>">
                                        <?= $news->titolo ?>
                                    </a>
                                <?php endforeach; ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if($news_related_documenti) : ?>
                        <div class="text-serif">
                            <strong>Documenti correlati:</strong>
                            <span class="comma-list">
                                <?php foreach ($news_related_documenti as $key => $documento) : ?>
                                    <?php
                                        $module = Module::getInstance();
                                        $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($documento->id, $documento->className(), 
                                            $module->modelsDetailMapping[$documento->className()]);
                                    ?>
                                    <a class="text-decoration-none" title="Vai alla pagina <?= $documento->titolo?>" href="<?= $route ?>">
                                        <?= $documento->titolo ?>
                                    </a>
                                <?php endforeach; ?>
                            </span>                     
                        </div>
                    <?php endif; ?>

                    <?php if($news_related_agid_service) : ?>
                        <div class="text-serif">
                            <strong>Servizi correlati:</strong>
                            <span class="comma-list">
                                <?php foreach ($news_related_agid_service as $agid_service) : ?>
                                    <?php
                                        $module = Module::getInstance();
                                        $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_service->id,$agid_service->className(), $module->modelsDetailMapping[$agid_service->className()]);
                                    ?>
                                    <a class="text-decoration-none" title="Vai alla pagina <?= $agid_service->name?>" href="<?= $route ?>">
                                        <?= $agid_service->name ?>
                                    </a>
                                <?php endforeach; ?>  
                            </span>
                        </div>
                    <?php endif; ?>
 
                </article>

            <?php endif; ?>
            
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




