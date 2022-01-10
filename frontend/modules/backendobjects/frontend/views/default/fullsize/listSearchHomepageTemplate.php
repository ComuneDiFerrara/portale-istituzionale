
<?php
use yii\widgets\ListView;
use yii\web\View;
use open20\design\assets\BootstrapItaliaDesignAsset;
use luya\helpers\Url;
use yii\widgets\ActiveForm;


$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$currentUrl=Url::current();
$pos = strpos($currentUrl, '%2F');

$currentPage=str_replace('%2C',',',str_replace('%C3%A0','à',substr($currentUrl, $pos+3)));
$currentPageUpper=str_replace('-', ' ',ucwords(str_replace('%2C',',',str_replace('%C3%A0','à',substr($currentUrl, $pos+3)))));
if($currentPageUpper=='News'){
    $currentPageUpper='Novità';
}
?>

<script>

    function onEnter() {
        if (event.keyCode === 13) {
            
            setHref();
            document.getElementById("search-button").click();
            return;
        }
        return;
        

    };
    
    function setHref() {
        var textToInject= document.getElementById("ricerca-testuale").value;
                    var hrefValue='/ricerca?searchtext=' + textToInject;
                    document.getElementById("search-button").href=hrefValue;  

    };

    function setHrefInModal() {
        var activeFilter=$("#container-categoria .form-check input:checked");
        var activeFilterLen = activeFilter.length;
        var activeFilterQuery='';
        for (i = 0; i < activeFilterLen; i++) {
            var originalString=activeFilter[i].id;        
            if(originalString=='Notizie'){
                originalString='News';
            }
            var newString='&CATEGORY_'+(originalString.replace(/ /g,"_")).replace(/\d+/g, '').replace(",","%2C")+'=on';
            activeFilterQuery=activeFilterQuery.concat(newString);   
        }
        var activeArgoument=$("#tab2 .form-check input:checked");
        var activeArgoumentLen = activeArgoument.length;
        for (j = 0; j < activeArgoumentLen; j++) {
            var originalString=activeArgoument[j].name;        
            var newString='&'+originalString.replace(/ /g,"_")+'=on';
            activeFilterQuery=activeFilterQuery.concat(newString);   
        }


        var textToInject= document.getElementById("ricerca-testuale").value;
        var hrefValue='/ricerca?searchtext=' + textToInject + activeFilterQuery;
        document.getElementById("modal-confirm").href=hrefValue;

    };

</script>





<div class="section section-background-header" >
    <div class="container ">
        <div class="row flex-column align-items-center">
            <div class="col col-sm-10 col-md-8">
                <form>
                    <div class="form-group mb-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <a id="search-button" title="Cerca" href="/" class="border-0 px-0" style="background-color:white;" onclick="setHref()">
                                    
                                        <svg class="icon icon-primary icon-sm align-top">          
                                            <use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#magnify"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <input title="ricerca-testuale" id="ricerca-testuale" type="text" class="form-control" onkeypress="onEnter()">
                            <label for="ricerca-testuale" style="width: auto;">Cerca servizi, informazioni, persone</label>
                        </div>
                    </div>
                </form>
     
                <!--modale more-option-->
                <!-- Large modal -->
                <div class="modal fade more-option-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modale-fullscreen-ricerca modal-dialog h-100 mw-100 w-100 m-0">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center justify-content-between uk-container">
                                <div class="d-flex">
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <svg class="icon icon-primary mr-5" role="img" >
                                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#arrow-left"></use>
                                        </svg>
                                    </button>
                                    <h2 class="h1">Filtri</h2>
                                </div>
                                <a class="btn btn-primary" id="modal-confirm" href="#" onclick="setHrefInModal()">
                                    Conferma
                                </a>

                                            
                            </div>
                            <div class="modal-body uk-container">
                                <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                                    <li class="nav-item flex-grow-1 d-flex align-items-center justify-content-center">
                                        <a class="nav-link active w-100" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Categorie</a>
                                    </li>
                                    <li class="nav-item flex-grow-1 d-flex align-items-center justify-content-center">
                                        <a class="nav-link w-100" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Argomenti</a>
                                    </li>  
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane p-4 fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                        <div id="container-categoria" class="advanced-subnav right-subnav">
                                            <div class="always-show-menu link-list-wrapper">
                                                <div class="uk-subnav ">
                                                    <!--checkbox per amministrazione-->
                                                    <div id="container-categoria-amministrazione" class="mt-5 container-categoria container-categoria-amministrazione">
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Amministrazione',
                                                                    'inputId' => 'Amministrazione',
                                                                    'name' => 'CATEGORY_Amministrazione',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Amministrazione')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Organi di governo',
                                                                    'inputId' => 'Organi_di_governo',
                                                                    'name' => 'CATEGORY_Organi_di_governo',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Organi_di_governo')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Aree amministrative',
                                                                    'inputId' => 'Aree_amministrative',
                                                                    'name' => 'CATEGORY_Aree_amministrative',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Aree_amministrative')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Uffici',
                                                                    'inputId' => 'Uffici',
                                                                    'name' => 'CATEGORY_Uffici',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Uffici')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Enti e fondazioni',
                                                                    'inputId' => 'Enti_e_fondazioni',
                                                                    'name' => 'CATEGORY_Enti_e_fondazioni',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Enti_e_fondazioni')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Personale amministrativo',
                                                                    'inputId' => 'Personale_amministrativo',
                                                                    'name' => 'CATEGORY_Personale_amministrativo',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Personale_amministrativo')
                                                                ]
                                                            );
                                                        ?>
                                                    </div>

                                                    <!--checkbox per servizi-->
                                                    <div id="container-categoria-servizi" class="mt-5  container-categoria ">
                                            
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Servizi',
                                                                    'inputId' => 'Servizi',
                                                                    'name' => 'name',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Servizi')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Ambiente',
                                                                    'inputId' => 'Ambiente1',
                                                                    'name' => 'name',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Ambiente')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Agricoltura',
                                                                    'inputId' => 'Agricoltura',
                                                                    'name' => 'CATEGORY_Agricoltura',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Agricoltura')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Anagrafe e stato civile',
                                                                    'inputId' => 'Anagrafe_e_stato_civile',
                                                                    'name' => 'CATEGORY_Anagrafe_e_stato_civile',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Anagrafe_e_stato_civile')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Appalti pubblici',
                                                                    'inputId' => 'Appalti_pubblici',
                                                                    'name' => 'CATEGORY_Appalti_pubblici',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Appalti_pubblici')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Autorizzazioni',
                                                                    'inputId' => 'Autorizzazioni',
                                                                    'name' => 'CATEGORY_Autorizzazioni',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Autorizzazioni')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Urbanistica e edilizia',
                                                                    'inputId' => 'Urbanistica_e_edilizia',
                                                                    'name' => 'CATEGORY_Urbanistica_e_edilizia',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Urbanistica_e_edilizia')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Cultura e tempo libero',
                                                                    'inputId' => 'Cultura_e_tempo_libero',
                                                                    'name' => 'CATEGORY_Cultura_e_tempo_libero',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Cultura_e_tempo_libero')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Educazione e formazione',
                                                                    'inputId' => 'Educazione_e_formazione',
                                                                    'name' => 'CATEGORY_Educazione_e_formazione',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Educazione_e_formazione')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Giustizia e sicurezza',
                                                                    'inputId' => 'Giustizia_e_sicurezza',
                                                                    'name' => 'CATEGORY_Giustizia_e_sicurezza',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Giustizia_e_sicurezza')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Mobilità e trasporti',
                                                                    'inputId' => 'Mobilità_e_trasporti',
                                                                    'name' => 'CATEGORY_Mobilità_e_trasporti',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Mobilità_e_trasporti')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Salute, benessere e assistenza',
                                                                    'inputId' => 'Salute_benessere_e_assistenza',
                                                                    'name' => 'CATEGORY_Salute_benessere_e_assistenza',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Salute_benessere_e_assistenza')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Tributi e finanze',
                                                                    'inputId' => 'Tributi_e_finanze',
                                                                    'name' => 'CATEGORY_Tributi_e_finanze',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Tributi_e_finanze')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Turismo',
                                                                    'inputId' => 'Turismo1',
                                                                    'name' => 'CATEGORY_Turismo',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Turismo')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Vita lavorativa',
                                                                    'inputId' => 'Vita_lavorativa',
                                                                    'name' => 'CATEGORY_Vita_lavorativa',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Vita_lavorativa')
                                                                ]
                                                            );
                                                        ?>
                                                    </div>
                                                        
                                    
                                                
                                                        </div>
                                            </div>
                                            <div class="link-list-wrapper">
                                                <div class="link-list collapse mb-0" id="altre-categ">
                                                    
                                                    <!--checkbox per novità-->
                                                    <div id="container-categoria-novità"  class="mt-5  container-categoria container-categoria-novità">    
                                                        
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Novità',
                                                                    'inputId' => 'Novità',
                                                                    'name' => 'CATEGORY_Novità',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Novità')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Notizie',
                                                                    'inputId' => 'Notizie',
                                                                    'name' => 'CATEGORY_Notizie',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Notizie')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Avvisi',
                                                                    'inputId' => 'Avvisi',
                                                                    'name' => 'CATEGORY_Avvisi',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Avvisi')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Eventi',
                                                                    'inputId' => 'Eventi',
                                                                    'name' => 'CATEGORY_Eventi',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Eventi')
                                                                ]
                                                            );
                                                        ?>
                                                        
                                                        
                                                    </div>

                                                    <!--checkbox per documenti e dati-->
                                                    <div id="container-categoria-documenti" class="mt-5  container-categoria container-categoria-documenti">    
                                                        
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Documenti e dati',
                                                                    'inputId' => 'Documenti_e_dati',
                                                                    'name' => 'CATEGORY_Documenti_e_dati',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Documenti_e_dati')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Bandi',
                                                                    'inputId' => 'Bandi',
                                                                    'name' => 'CATEGORY_Bandi',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Bandi')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Modulistica',
                                                                    'inputId' => 'Modulistica',
                                                                    'name' => 'CATEGORY_Modulistica',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Modulistica')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Ordinanze',
                                                                    'inputId' => 'Ordinanze',
                                                                    'name' => 'CATEGORY_Ordinanze',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Ordinanze')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Atti normativi',
                                                                    'inputId' => 'Atti_normativi',
                                                                    'name' => 'CATEGORY_Atti_normativi',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Atti_normativi')
                                                                ]
                                                            );
                                                        ?>
                                                        <?=
                                                            $this->render(
                                                                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                [
                                                                    'label' => 'Documenti tecnici e di supporto',
                                                                    'inputId' => 'Documenti_tecnici_e_di_supporto',
                                                                    'name' => 'CATEGORY_Documenti_tecnici_e_di_supporto',
                                                                    'value' =>\app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Documenti_tecnici_e_di_supporto')
                                                                ]
                                                            );
                                                        ?>
                                                        
                                                        
                                                    </div>
                                                        </div>
                                            </div>

                                            <p class="espandi-voci mt-4 ">
                                                <a href="#altre-categ" id="menu-lista-button" role="button" aria-expanded="false" aria-controls="altre-categ" data-toggle="collapse" class="collapsed link-altre-voci d-flex align-items-center text-decoration-none">
                                                
                                                    <span class="menu-lista-apri font-weight-bold" title="Espandi">Mostra tutto</span>
                                                    <span class="menu-lista-riduci font-weight-bold" title="Riduci">Mostra meno</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-4 fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                        
                                    <div class="advanced-subnav right-subnav">
                                        <div class="always-show-menu link-list-wrapper">
                                        <div class="uk-subnav ">
                                            <div class="mt-5"> 
                                        <?php
                                            $tags = \open20\amos\tag\models\Tag::find()->orderby(['nome' => SORT_ASC])->all();
                                            $u = 0;
                                            $showTag = true;
                                            foreach($tags as $tag)
                                            {
                                                if($u++ == 15)
                                                {
                                                    ?>
                                            </div>
                                                </div>
                                        </div>
                                        <div class="link-list-wrapper">
                                            <div class="link-list collapse mb-0" id="altri-arg">
                                                <div >
                                                <?php
                                                }
                                                if($showTag)
                                                {
                                        ?>
                                                        
                                                            <!--checkbox per argomenti-->
                                                            <?=

                                                                $this->render(
                                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                    [
                                                                        'label' => $tag->nome,
                                                                        'inputId' => str_replace(" ", "_", $tag->nome),
                                                                        'name' => 'TAG_' . $tag->id,
                                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('TAG_' . $tag->id)
                                                                    ]
                                                                );
                                                            ?>
                                                    
                                        <?php
                                                }else{
                                        ?>
                                                        
                                                            <?=
                                                                $this->render(
                                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                                    [
                                                                        'label' => $tag->nome,
                                                                        'inputId' => str_replace(" ", "_", $tag->nome),
                                                                        'name' => 'TAG_' . $tag->id,
                                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('TAG_' . $tag->id)
                                                                    ]
                                                                );
                                                            ?>
                                                    
                                        <?php
                                                }
                                            }
                                            ?>
                                            </div>             
                                        </div>
                                            </div>
                                            <p class="espandi-voci mt-4 ">
                                                <a href="#altri-arg" id="menu-lista-button-2" role="button" aria-expanded="false" aria-controls="altri-arg" data-toggle="collapse" class="collapsed link-altre-voci d-flex align-items-center text-decoration-none">
                                                
                                                    <span class="menu-lista-apri font-weight-bold" title="Espandi">Mostra tutto</span>
                                                    <span class="menu-lista-riduci font-weight-bold" title="Riduci">Mostra meno</span>
                                                </a>
                                            </p>
                                        </div>
                                    
                                    
                                </div>
                            
                        
                            </div>
                        </div>
                    
                    


                    </div>
                    
                </div>
            </div>
<!--il resto dei div chiusi nel php panel, altrimenti non si vedono bottoni-->




