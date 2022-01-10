<?php

use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\attachments\components\AttachmentsListBS4;
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
use open20\design\utility\DateUtility;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

use yii\helpers\Url;
use app\modules\backendobjects\frontend\Module;

$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();

$docMainFile = $model->getDocumentMainFile();
$docSize     = ((float) $docMainFile->size) / 1000;
$module      = Module::getInstance();


// check id documento is not expired
if (\Yii::$app->user->isGuest && ((!empty($model->getPublicatedAt()) && (\Yii::$app->formatter->asDatetime('now', 'php:Y-m-d') > $model->getPublicatedAt()))
    || ($model->status != $model->getValidatedStatus()) || (\Yii::$app->formatter->asDatetime('now', 'php:Y-m-d') < $model->getPublicatedFrom()))) {
    \Yii::$app->response->redirect(['/404']);
}
?>



<!--aggiornamento nuove categorie: bandi di concorso-> assunzioni a tempo indeterminato, assunzioni a tempo determinato, avvisi mobilità ext, altre sezioni, tirocini-->
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
                        <a title="Vai alla pagina documenti e dati" href="/documenti-e-dati">Documenti</a><span class="separator">/</span>
                    </li>
                    <?php if ($model->documenti_agid_content_type_id == 1) { ?><!--bandi-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina bandi" href="/documenti-e-dati/bandi"><?= $model->documentiAgidContentType->name ?></a><span class="separator">/</span>
                        </li>

                        <?php if ($model->documenti_agid_type_id == 150) { ?><!--avvisi, bandi di gara - profilo committente-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina Avvisi, bandi di gara - profilo committente" href="/documenti-e-dati/bandi/documenti-e-dati-bandi-di-gara"><?= $model->documentiAgidType->name ?></a><span class="separator">/</span>
                            </li>
                        <?php } ?>
                        <?php if ($model->documenti_agid_type_id == 151) { ?><!--elenchi operatori economici/ item-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina Elenchi Operatori Economici" href="/documenti-e-dati/bandi/elenchi-operatori-economici">Elenchi Operatori Economici</a><span class="separator">/</span>
                            </li>
                        <?php } ?>
                        <?php if ($model->documenti_agid_type_id == 152) { ?><!--bandi di concorso/ assunzioni a tempo indeterminato/ item-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina bandi di concorso" href="/documenti-e-dati/bandi/bandi-di-concorso">Bandi di concorso</a><span class="separator">/</span>
                            </li>
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina assunzioni a tempo indeterminato" href="/documenti-e-dati/bandi/bandi-di-concorso/assunzioni-a-tempo-indeterminato">Assunzioni a tempo indeterminato</a><span class="separator">/</span>
                            </li>
                        <?php } ?>
                        <?php if ($model->documenti_agid_type_id == 153) { ?><!--bandi di concorso/ assunzioni a tempo determinato/ item-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina bandi di concorso" href="/documenti-e-dati/bandi/bandi-di-concorso">Bandi di concorso</a><span class="separator">/</span>
                            </li>
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina assunzioni a tempo determinato" href="/documenti-e-dati/bandi/bandi-di-concorso/assunzioni-a-tempo-determinato">Assunzioni a tempo determinato</a><span class="separator">/</span>
                            </li>
                        <?php } ?>
                        <?php if ($model->documenti_agid_type_id == 154) { ?><!--bandi di concorso/ avvisi di mobilità ext / item-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina bandi di concorso" href="/documenti-e-dati/bandi/bandi-di-concorso">Bandi di concorso</a><span class="separator">/</span>
                            </li>
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina avvisi di mobilità esterna" href="/documenti-e-dati/bandi/bandi-di-concorso/avvisi-di-mobilita-esterna">Avvisi di mobilità esterna</a><span class="separator">/</span>
                            </li>
                        <?php } ?>
                        <?php if ($model->documenti_agid_type_id == 155) { ?><!--bandi di concorso/ altre selezioni / item-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina bandi di concorso" href="/documenti-e-dati/bandi/bandi-di-concorso">Bandi di concorso</a><span class="separator">/</span>
                            </li>
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina altre selezioni" href="/documenti-e-dati/bandi/bandi-di-concorso/altre-selezioni">Altre selezioni</a><span class="separator">/</span>
                            </li>
                        <?php } ?>
                        <?php if ($model->documenti_agid_type_id == 156) { ?><!--bandi di concorso/ tirocini / item-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina bandi di concorso" href="/documenti-e-dati/bandi/bandi-di-concorso">Bandi di concorso</a><span class="separator">/</span>
                            </li>
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina altre selezioni" href="/documenti-e-dati/bandi/bandi-di-concorso/tirocini">Tirocini</a><span class="separator">/</span>
                            </li>
                        <?php } ?>




                        <?php if ($model->documenti_agid_type_id == 2) { ?><!--nomine-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina nomine in società e enti" href="/documenti-e-dati/bandi/documenti-e-dati-bandi-nomine"><?= $model->documentiAgidType->name ?></a><span class="separator">/</span>
                            </li>
                        <?php } ?>
                        <?php if ($model->documenti_agid_type_id == 3) { ?><!--bandi immobiliari-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina bandi immobiliari" href="/documenti-e-dati/bandi/documenti-e-dati-bandi-bandi-immobiliari"><?= $model->documentiAgidType->name ?></a><span class="separator">/</span>
                            </li>
                        <?php } ?>
                        <?php if ($model->documenti_agid_type_id == 4) { ?><!--bandi per contributi-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina bandi per contributi" href="/documenti-e-dati/bandi/documenti-e-dati-bandi-bandi-contributi"><?= $model->documentiAgidType->name ?></a><span class="separator">/</span>
                            </li>
                        <?php } ?>
                        <?php if ($model->documenti_agid_type_id == 5) { ?><!--altri bandi e avvisi-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina altri bandi e avvisi" href="/documenti-e-dati/bandi/documenti-e-dati-bandi-altri-bandi"><?= $model->documentiAgidType->name ?></a><span class="separator">/</span>
                            </li>
                        <?php } ?>

                    <?php } ?>


                    <?php if ($model->documenti_agid_content_type_id == 5) { ?><!--modulistica-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina moduli" href="/documenti-e-dati/modulistica"><?= $model->documentiAgidContentType->name ?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>


                    <?php if ($model->documenti_agid_content_type_id == 4) { ?><!--ordinanze-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina ordinanze" href="/documenti-e-dati/ordinanze"><?= $model->documentiAgidContentType->name ?></a><span class="separator">/</span>
                        </li>
                    <?php } ?>


                    <?php if ($model->documenti_agid_content_type_id == 10) { ?><!--atti normativi-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina atti normativi" href="/documenti-e-dati/atti-normativi">Atti normativi</a><span class="separator">/</span>
                        </li>
                        <?php if ($model->documenti_agid_type_id == 128) { ?><!--regolamenti-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina regolamenti" href="/documenti-e-dati/atti-normativi/documenti-e-dati-atti-normativi-regolamenti">Regolamenti</a><span class="separator">/</span>
                            </li>
                        <?php } ?>


                    <?php } ?>

                    <?php if ($model->documenti_agid_content_type_id == 6 && $model->documenti_agid_type_id
                        == 11) { ?><!--atti normativi statuto-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina atti normativi" href="/documenti-e-dati/atti-normativi">Atti normativi</a><span class="separator">/</span>
                        </li>
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina statuto comunale" href="/documenti-e-dati/atti-normativi/documenti-e-dati-atti-normativi-statuto-comunale">Statuto comunale</a><span class="separator">/</span>
                        </li>
                    <?php } ?>

<?php if ($model->documenti_agid_type_id == 126) { ?><!--atti normativi / doc unico Codice europeo di comportamento per gli eletti locali e regionali -->

                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina Atti normarivi" href="/documenti-e-dati/atti-normativi">Atti normativi</a><span class="separator">/</span>
                        </li>
                    <?php } ?>

<?php if ($model->documenti_agid_content_type_id == 7) { ?><!--doc tecnici supporto-->
                        <li class="breadcrumb-item">
                            <a title="Vai alla pagina atti normativi" href="/documenti-e-dati/documenti-tecnici-e-di-supporto"><?= $model->documentiAgidContentType->name ?></a><span class="separator">/</span>
                        </li>
    <?php if ($model->documenti_agid_type_id == 14) { ?><!--autorizzazione paesaggistiche-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina autorizzazione paesaggistiche" href="/documenti-e-dati/documenti-tecnici-e-di-supporto/documenti-e-dati-doc-tecnici-autorizzazioni-paesaggistiche"><?= $model->documentiAgidType->name ?></a><span class="separator">/</span>
                            </li>
                        <?php } ?>
    <?php if ($model->documenti_agid_type_id == 13) { ?><!--pianificazione urbanistica-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina pianificazione urbanistica" href="/documenti-e-dati/documenti-tecnici-e-di-supporto/documenti-e-dati-doc-tecnici-pianificazione-urbanistica"><?= $model->documentiAgidType->name ?></a><span class="separator">/</span>
                            </li>
                        <?php } ?>
    <?php if ($model->documenti_agid_type_id == 15) { ?><!--pubblicazioni statistiche-->
                            <li class="breadcrumb-item">
                                <a title="Vai alla pagina pubblicazioni statistiche" href="/documenti-e-dati/documenti-tecnici-e-di-supporto/documenti-e-dati-doc-tecnici-pubblicazioni-statistiche"><?= $model->documentiAgidType->name ?></a><span class="separator">/</span>
                            </li>
                        <?php } ?>
<?php } ?>




                    <li aria-current="page" class="breadcrumb-item active">
<?= $model->titolo ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!--testata titolo: inseirti dati dinamici (tipologia doc, nome, oggetto, descr brevetranne condivisione, per ora commentato-->
<div class="intro-section container my-4 uk-container">
    <div class="row">
        <div class="col-lg-7 col-md-9 px-0">     
            <h1><?= $model->titolo ?></h1>
            <p><?= $model->descrizione_breve ?></p>

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
                                    <!--OGGETTO-->
<?php if ($model->object) { ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo oggetto" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#oggetto"><span>Oggetto</span></a>
                                        </li>
<?php } ?>

                                    <!--DESCRIZIONE-->
                                    <!--desrizione estesa: extended_description-->
<?php if ($model->extended_description || $docMainFile->type) { ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo descrizione" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#descrizione"><span>Descrizione</span></a>
                                        </li>
<?php } ?>


                                    <!--PUBBLICAZIONE-->
<?php if ($model->start_date || $model->end_date) { ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo pubblicazione" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#pubblicazione"><span>Pubblicazione</span></a>
                                        </li>
<?php } ?>


                                    <!--DOCUMENTO PRINCIPALE-->
<?php if ($docMainFile || $model->link_document) { ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo documento" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#documento"><span>Documento principale</span></a>
                                        </li>
<?php } ?>

                                    <!--ALLEGATI-->
<?php if ($model->documentAttachments) { ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo allegati" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#allegati"><span>Allegati</span></a>
                                        </li>
<?php } ?>

                                    <!--TEMPI E SCADENZE-->
                                    <!--dates_and_intermediate_stages-->
<?php if ($model->dates_and_intermediate_stages) { ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo tempi e scadenze" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#tempi-scadenze"><span>Data e fasi intermedie</span></a>
                                        </li>
<?php } ?>

                                    <!--UFFICIO E AREA-->
                                    <!--agidOrganizationalUnitContentTypeOffice->name-->
                                    <!--agidOrganizationalUnitContentTypeArea->name-->
                                    <?php
                                    if ($model->agidOrganizationalUnitContentTypeOffice->name ||
                                        $model->agidOrganizationalUnitContentTypeArea->name) {
                                        ?>
                                        <li class="nav-item active">
                                            <a class="nav-link active" title="Vai al paragrafo ufficio e area resposnsabile" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#ufficio-area"><span>Contatti</span></a>
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
            <!--OGGETTO-->
            <!--$model->object-->
<?php if ($model->object) { ?>
                <article class="it-page-section mt-5">
                    <h4 id="oggetto" class="primary-color anchor-offset">Oggetto</h4>
                    <div class="text-serif">
    <?= $model->object ?>
                    </div>
                </article>
<?php } ?>

            <!--proprietà-->
            <!--desrizione estesa: extended_description-->
<?php if ($model->extended_description || $docMainFile->type) { ?>
                <article class="it-page-section mt-5">
                    <h4 id="descrizione" class="primary-color anchor-offset">Descrizione</h4>
                    <!--descrizione estesa-->
                        <?php if ($model->extended_description) { ?>
                        <div class="text-serif mb-2">
                        <?= $model->extended_description ?>
                        </div>
    <?php } ?>


                    <!--formati disponibili, non indicizzati-->
    <?php if ($docMainFile->type) { ?>
                        <p class="d-flex align-items-center">
                            <strong class="text-serif">Formati disponibili:</strong>
                            <span class="doc-format-chip chip chip-simple chip-primary mx-1">
                                <span class="chip-label my-0 text-uppercase"><?= $docMainFile->type ?></span>
                            </span>
                        </p>
                <?php } ?>
                </article>
<?php } ?>



            <!--PUBBLICAZIONE-->
            <!--$model->start_date-->
<?php if ($model->start_date || $model->end_date) { ?>
                <article class="it-page-section mt-5">
                    <h4  id="pubblicazione" class="primary-color  anchor-offset">Pubblicazione</h4>
    <?php if ($model->start_date) { ?>
                        <div class="point-list-wrapper mt-4">
                            <div class="point-list">
                                <div class="point-list-aside point-list-warning">
                                    <div class="point-date text-monospace"><?=
                                        Yii::$app->formatter->asDate($model->start_date, 'dd');
                                        ?></div>
                                    <div class="point-month text-monospace"><?=
                                        Yii::$app->formatter->asDate($model->start_date, 'MMMM')[0].Yii::$app->formatter->asDate($model->start_date,
                                            'MMMM')[1].Yii::$app->formatter->asDate($model->start_date, 'MMMM')[2]
                                        ?> / <?= Yii::$app->formatter->asDate($model->start_date, 'yy'); ?></div>
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
    <?php if ($model->end_date) { ?>
                        <div class="point-list-wrapper mb-4">
                            <div class="point-list">
                                <div class="point-list-aside point-list-warning">
                                    <div class="point-date text-monospace"><?=
                                        Yii::$app->formatter->asDate($model->end_date, 'dd');
                                        ?></div>
                                    <div class="point-month text-monospace"><?=
                                        Yii::$app->formatter->asDate($model->end_date, 'MMMM')[0].Yii::$app->formatter->asDate($model->end_date,
                                            'MMMM')[1].Yii::$app->formatter->asDate($model->end_date, 'MMMM')[2]
                                        ?> / <?= Yii::$app->formatter->asDate($model->end_date, 'yy'); ?></div>
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
<?php if ($docMainFile || $model->link_document) { ?>
                <article class="it-page-section mt-5">
                    <h4 id="documento" class="primary-color anchor-offset">Documento principale</h4>
                    <div class="row">
    <?php if ($docMainFile) { ?>
                            <div class="card-wrapper card-teaser card-one-block col-lg-4 col-md-6">
                                <div class="card card-teaser card-one-block  shadow p-4">
                                    <svg class="icon icon-primary">
                                    <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                    </svg>
                                    <div class="card-body overflow-hidden">
                                        <a class="text-decoration-none" href="<?= $docMainFile->getWebUrl() ?>" title="File <?= $docMainFile->type ?> - <?= $docSize ?> KB">
        <?= $docMainFile->name ?>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
    <?php if ($model->link_document) { ?>
                            <div class="card-wrapper card-teaser  card-one-block col-lg-4 col-md-6">
                                <div class="card card-teaser card-one-block shadow p-4">
                                    <svg class="icon icon-primary">
                                    <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip "></use>
                                    </svg>
                                    <div class="card-body overflow-hidden">
                                        <a class="text-decoration-none" target="<?= ($model->link_document) ? '_blank' : '_self' ?>" href="<?= $model->link_document ?>" title="Vai al link del documento esterno">
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
<?php if ($model->documentAttachments) { ?>

                <article class="it-page-section mt-5">
                    <h4 id="allegati" class="primary-color  anchor-offset">Allegati</h4>

                    <?=
                    AttachmentsListBS4::widget([
                        'model' => $model,
                        'attribute' => 'documentAttachments',
                        'viewDeleteBtn' => false,
                        'viewDownloadBtn' => false,
                        'viewFilesCounter' => false,
                        'hideExtensionFile' => true,
                        'enableSort' => true,
                        'viewSortBtns' => false,
                    ])
                    ?>

                </article>
<?php } ?> 

            <!--TEMPI E SCADENZE-->
            <!--fasi intermedie: dates_and_intermediate_stages-->
<?php if ($model->dates_and_intermediate_stages) { ?>
                <article class="it-page-section mt-5">
                    <h4 id="tempi-scadenze" class="primary-color anchor-offset">Data e fasi intermedie</h4>
                    <div class=" mt-3 mb-4">
                        <div class="text-serif">
    <?= $model->dates_and_intermediate_stages ?>
                        </div>
                    </div>
                </article>
<?php } ?>

            <!--UFFICIO E AREA-->
            <!--agidOrganizationalUnitContentTypeOffice->name-->
            <!--agidOrganizationalUnitContentTypeArea->name-->

            <?php
            $agid_organizational_unit_content_type_office = $model->getAgidOrganizationalUnitContentTypeOffice()
                ->andWhere(['status' => \open20\agid\organizationalunit\models\AgidOrganizationalUnit::AGID_ORGANIZATIONAL_UNIT_WORKFLOW_STATUS_VALIDATED])
                ->andWhere(['deleted_at' => null])
                ->one();

            $agid_organizational_unit_content_type_area = $model->getAgidOrganizationalUnitContentTypeArea()
                ->andWhere(['status' => \open20\agid\organizationalunit\models\AgidOrganizationalUnit::AGID_ORGANIZATIONAL_UNIT_WORKFLOW_STATUS_VALIDATED])
                ->andWhere(['deleted_at' => null])
                ->one();
            ?>

<?php if ($agid_organizational_unit_content_type_office || $agid_organizational_unit_content_type_area) : ?>

                <article class="it-page-section mt-5">
                    <h4 id="ufficio-area" class="primary-color  anchor-offset">Contatti</h4>
                    <div class="row">
                        <!--Ufficio responsabile documento: agidOrganizationalUnitContentTypeOffice->name-->
    <?php if ($agid_organizational_unit_content_type_office) : ?>
                            <div class="col-md-6 col-12 d-flex flex-column">
                                <p class="h6">Uffici</p>
                                <?php
                                $routeOffice = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_organizational_unit_content_type_office->id,
                                        $agid_organizational_unit_content_type_office->className(),
                                        $module->modelsDetailMapping[$agid_organizational_unit_content_type_office->className()]);
                                ?>
                                <div class="row mt-3 h-100">
                                    <div  class="col-12 h-100 agid-generic-card-container box-card mb-4">
                                        <div class="py-3 h-100 d-flex flex-column shadow">
                                            <div class="categoria-box-card px-4 pb-2 d-flex align-items-center">
                                                <div>
                                                    <svg class="icon icon-padded rounded-circle icon-white bg-primary d-flex  mr-1" role="img" aria-label="Numero risposte">
                                                    <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#bank-outline"></use>
                                                    </svg>
                                                </div>
                                                <div class="text-uppercase font-weight-bold primary-color">
                                                    <!-- < ?= $agid_organizational_unit_content_type_office->name ?> -->
                                                    Uffici
                                                </div>
                                            </div>

                                            <div class="px-4 flex-grow-1">
                                                <div class="h5  ">
                                                    <a class="text-black" title="Esplora avviso" href="<?= $routeOffice ?>"><?= $agid_organizational_unit_content_type_office->name ?></a>
                                                </div>
                                                <div class="text-serif pt-3">
                                                    <div>
                                                        <?= $agid_organizational_unit_content_type_office->short_description ?>
                                                        <?php
                                                        if ($agid_organizational_unit_content_type_office->address || $agid_organizational_unit_content_type_office->cap) {
                                                            ?>
                                                            <div><strong>Indirizzo:</strong> <?= $agid_organizational_unit_content_type_office->address ?> <?php if ($agid_organizational_unit_content_type_office->cap) { ?> - <?= $agid_organizational_unit_content_type_office->cap ?><?php } ?></div>
                                                        <?php } ?>

                                                        <?php if ($agid_organizational_unit_content_type_office->public_hours) { ?>
                                                            <div><strong>Orari:</strong> <?= $agid_organizational_unit_content_type_office->public_hours ?> </div>
                                                        <?php } ?>
                                                        <?php if ($agid_organizational_unit_content_type_office->telephone_reference) { ?>
                                                            <div><strong>Telefono:</strong> <?= $agid_organizational_unit_content_type_office->telephone_reference ?></div>
                                                        <?php } ?>
        <?php if ($agid_organizational_unit_content_type_office->mail_reference) { ?>
                                                            <div class="d-flex"><strong class="mr-1">Email:</strong>
                                                                <a href="mailto:<?= $agid_organizational_unit_content_type_office->mail_reference ?>" class="text-decoration-none overflow-hidden" title="invia una mail a <?= $agid_organizational_unit_content_type_office->mail_reference ?>" style="text-overflow:ellipsis"> <?= $agid_organizational_unit_content_type_office->mail_reference ?></a>
                                                            </div>
                                                        <?php } ?>
        <?php if ($agid_organizational_unit_content_type_office->pec_reference) { ?>
                                                            <div class="d-flex"><strong class="mr-1">PEC:</strong>
                                                                <a href="mailto:<?= $agid_organizational_unit_content_type_office->pec_reference ?>" class="text-decoration-none overflow-hidden" title="invia una mail a <?= $agid_organizational_unit_content_type_office->pec_reference ?>" style="text-overflow:ellipsis"> <?= $agid_organizational_unit_content_type_office->pec_reference ?></a>
                                                            </div>
        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cta-box-card px-4 py-3 uk-section- uk-visible@xl uk-section">
                                                <div class="uk-container">
                                                    <div class="read-more ">
                                                        <a class="text-uppercase font-weight-bold" title="Esplora <?= $agid_organizational_unit_content_type_office->name ?>" href="<?= $routeOffice ?>">Leggi di più →</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
    <?php endif; ?>

                        <!--area responsabile documento-->
                        <?php if ($agid_organizational_unit_content_type_area) : ?>
                            <?php
                            $routeArea = \Yii::$app->getModule('backendobjects')::getDetachUrl($agid_organizational_unit_content_type_area->id,
                                    $agid_organizational_unit_content_type_area->className(),
                                    $module->modelsDetailMapping[$agid_organizational_unit_content_type_area->className()]);
                            ?>
                            <div class="col-md-6 col-12 d-flex flex-column">
                                <p class="h6">Area di riferimento</p>
                                <div class="row mt-3 h-100">
                                    <div  class="col-12 h-100 agid-generic-card-container box-card mb-4">
                                        <div class="py-3 h-100 d-flex flex-column shadow">
                                            <div class="categoria-box-card px-4 pb-2 d-flex align-items-center">
                                                <div>
                                                    <svg class="icon icon-padded rounded-circle icon-white bg-primary d-flex  mr-1" role="img" aria-label="Numero risposte">
                                                    <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#bank-outline"></use>
                                                    </svg>
                                                </div>
                                                <div class="text-uppercase font-weight-bold primary-color">
                                                    <!-- < ?= $agid_organizational_unit_content_type_area->name ?> -->
                                                    Aree amministrative
                                                </div>
                                            </div>

                                            <div class="px-4 flex-grow-1">
                                                <div class="h5  ">
                                                    <a class="text-black" title="Esplora avviso" href="<?= $routeArea ?>"><?= $agid_organizational_unit_content_type_area->name ?></a>
                                                </div>
                                                <div class="text-serif pt-3">
                                                    <div>
                                                        <?= $agid_organizational_unit_content_type_area->short_description ?>
                                                        <?php
                                                        if ($agid_organizational_unit_content_type_area->address || $agid_organizational_unit_content_type_area->cap) {
                                                            ?>
                                                            <p><strong>Indirizzo:</strong> <?= $agid_organizational_unit_content_type_area->address ?> <?php if ($agid_organizational_unit_content_type_area->cap) { ?> - <?= $agid_organizational_unit_content_type_area->cap ?><?php } ?></p>
                                                        <?php } ?>
                                                        <?php if ($agid_organizational_unit_content_type_area->public_hours) { ?>
                                                            <p><strong>Orari:</strong> <?= $agid_organizational_unit_content_type_area->public_hours ?> </p>
                                                        <?php } ?>
                                                        <?php if ($agid_organizational_unit_content_type_area->telephone_reference) { ?>
                                                            <p><strong>Telefono:</strong> <?= $agid_organizational_unit_content_type_area->telephone_reference ?></p>
                                                        <?php } ?>
        <?php if ($agid_organizational_unit_content_type_area->mail_reference) { ?>
                                                            <p><strong>Email:</strong>
                                                                <a href="mailto:<?= $agid_organizational_unit_content_type_area->mail_reference ?>" class="text-decoration-none" title="invia una mail a <?= $agid_organizational_unit_content_type_area->mail_reference ?>"> <?= $agid_organizational_unit_content_type_area->mail_reference ?></a>
                                                            </p>
                                                        <?php } ?>
        <?php if ($agid_organizational_unit_content_type_area->pec_reference) { ?>
                                                            <p><strong>PEC:</strong>
                                                                <a href="mailto:<?= $agid_organizational_unit_content_type_area->pec_reference ?>" class="text-decoration-none" title="invia una mail a <?= $agid_organizational_unit_content_type_area->pec_reference ?>"> <?= $agid_organizational_unit_content_type_area->pec_reference ?></a>
                                                            </p>
        <?php } ?>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="cta-box-card px-4 py-3 uk-section- uk-visible@xl uk-section">
                                                <div class="uk-container">
                                                    <div class="read-more ">
                                                        <a class="text-uppercase font-weight-bold" title="Esplora <?= $agid_organizational_unit_content_type_area->name ?>" href="<?= $routeArea ?>">Leggi di più →</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
    <?php endif; ?>
                    </div>
                </article>


<?php endif; ?>




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
                  

                     <!--Altre info-->
                    <?php if($model->further_information ){ ?>   
                        <div class="text-serif mb-2 ">
                            <?= $model->further_information ?>    
                        </div>    
                    <?php } ?>  
                    <!--Riferimenti normativi-->
                    <?php if($model->regulatory_requirements){ ?> 
                        <div class="text-serif mb-2  d-flex">
                                <strong class="mr-2">Riferimenti normativi: </strong><div><?= $model->regulatory_requirements  ?></div>
                        </div>
                    <?php } ?>
                    <!--Protocollo-->
                    <?php if($model->protocol){ ?>                      
                        <div class="text-serif mb-2 d-flex">
                            <strong class="mr-2">Protocollo: </strong><div><?= $model->protocol ?></div>
                        </div>

                    <?php } ?>

                    <?php if ($model->help_box) { ?>
                            <div class="mb-3">
                            <?= $model->help_box ?>
                            </div>
                    <?php } ?>



                <!--Autore:descr-->
<?php if ($model->author) { ?>
                    <div class="text-serif mb-2">
                        <strong>Autore: </strong><?= $model->author ?>
                    </div>
<?php } ?>

                <!--Licenza distribuzione:descr-->
<?php if ($model->distribution_proscription) { ?>
                    <div class="text-serif mb-2">
                        <strong>Licenza di distribuzione: </strong><?= $model->distribution_proscription ?>
                    </div>
<?php } ?>  

                <div class="mt-3">
                    <?=
                    \open20\amos\core\forms\LastUpdateModelWidget::widget(
                        ['model' => $model, 'cssClass' => 'small']);
                    ?>
                </div>



            </article>



        </section>
    </div>
</div>