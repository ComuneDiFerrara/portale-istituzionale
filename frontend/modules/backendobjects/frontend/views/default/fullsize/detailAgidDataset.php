<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
use open20\amos\core\widget\graphics\WidgetShareAndSeeActions;
use yii\helpers\Url;

$share_and_see_actions = new open20\amos\core\widget\graphics\WidgetShareAndSeeActions();

?>

<!--impostazione icona a seconda categoria-->
<?php
    if($model->agid_dataset_type_id==1){//agricoltura
        $categoryIcon= 'flower-outline';
    }
    if($model->agid_dataset_type_id==2){//economia
        $categoryIcon= 'finance';
    }
    if($model->agid_dataset_type_id==3){//istruzione cultura e tempo libero
        $categoryIcon= 'head-snowflake-outline';
    }
    if($model->agid_dataset_type_id==4){//energia
        $categoryIcon= 'lamp';
    }
    if($model->agid_dataset_type_id==5){//ambiente
        $categoryIcon= 'sprout-outline';
    }
    if($model->agid_dataset_type_id==6){//governo
        $categoryIcon= 'bank-outline';
    }
    if($model->agid_dataset_type_id==7){//salute
        $categoryIcon= 'bottle-tonic-plus-outline';
    }
    if($model->agid_dataset_type_id==8){//tematiche inter
        $categoryIcon= 'web';
    }
    if($model->agid_dataset_type_id==9){//giustizia
        $categoryIcon= 'gavel';
    }
    if($model->agid_dataset_type_id==10){//regioni e città
        $categoryIcon= 'home-group';
    }
    if($model->agid_dataset_type_id==11){//popolazione e società
        $categoryIcon= 'account-group';
    }
    if($model->agid_dataset_type_id==12){//scienze e tecnologia
        $categoryIcon= 'android-studio';
    }
    if($model->agid_dataset_type_id==13){//trasporti
        $categoryIcon= 'train-car';
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
                    <a  title="Vai alla pagina dataset" href="/documenti-e-dati/documenti-e-dati-dataset">Dataset</a><span class="separator">/</span>
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
            <p class="h1"><?= $model->title ?> </p>                        
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
                                    <!--descrizione-->
                                        <!--description-->
                                        <?php if($model->description){ ?>
                                            <li class="nav-item active">
                                                <a class="nav-link active" title="Vai al paragrafo descrizione" href="<?= str_replace('%2F','/',\Yii::$app->params['platform']['frontendUrl'] . Url::current()) ?>#descrizione"><span>Descrizione</span></a>
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
            <!--descrizione-->
            <!--description-->
            <?php if($model->description){ ?>
                <article  class="it-page-section mt-5 mt-5 ">
                    <h4 id="descrizione" class="primary-color anchor-offset">Descrizione</h4>
                    <div class="text-serif">
                        <?= $model->description ?>
                    </div>
                </article>
            <?php } ?>

            
            <article class="it-page-section mt-5 ">
                <h4 id="altre-informazioni" class="primary-color anchor-offset ">Altre informazioni</h4>          
                    <?= \open20\amos\core\forms\LastUpdateModelWidget::widget(
                    ['model' => $model, 'cssClass' => 'small']);  ?>         
            </article>   

            
        </section>
    </div>
</div>
