<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
use yii\widgets\ListView;
use open20\amos\core\helpers\Html;
use yii\widgets\ActiveForm;
use luya\helpers\Url;

?>




<?php
$modelLabel = strtolower($model->getGrammar()->getModelLabel());
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$cssClass= 'uk-container';
$tipologie = \open20\agid\service\models\AgidServiceType::find()->all();
$cssClass= 'uk-container';

$currentUrl=Url::current();
$pos = strpos($currentUrl, '%2F');
$currentPage=str_replace('%2C',',',str_replace('%C3%A0','à',substr($currentUrl, $pos+3)));
parse_str($currentUrl, $output);
$currentPage=substr($output['path'], (strpos($output['path'], '/')));

$js = <<<JS
    jQuery('body').on('click', '.tag-filter-express-servizi', function() {
        let id = jQuery(this).data('field');
        let elementoS = jQuery('input#'+id);
        let checkboxesS = elementoS.parents('.form-group').find('input[type="checkbox"]');
        
        checkboxesS.prop('checked', false);
        elementoS.prop('checked', true);
    });
   
    window.addEventListener("load", function(event) {
        var pulsanteTuttoServ=document.getElementById("filtro-tutto-service");
        if(pulsanteTuttoServ.classList.contains("active-filter")){
            var inputToCheck=$("#more-option-servizi-modal .modal-content input");
          
            inputToCheck.prop('checked', true);
          

        }
       
        if(document.getElementById("no-content-service")){
           
            var content=document.getElementsByClassName("servizi-argomenti-block")[0];
            content.style.display = "none"; 
           
        }
        
    });
JS;

$this->registerJs($js);
?>

<div id="service" class="anchor-offset">
    <div id="filtri-ricerca-service" class="d-flex justify-content-between pb-2">
        <p class="h3">Servizi</p>
        <?php $form = ActiveForm::begin([
            'action' => (isset($originAction) ? [$originAction] : ['/'.$currentPage ,'#' => 'service']),
            'method' => 'get',
        ]);

        $searchParams = \Yii::$app->request->get('AgidServiceSearch');
        ?>


        <div class="tag-filtri-container d-flex flex-wrap">
            <div class="ml-2 d-inline">
                <a href="<?= $currentPage ?>#service" id="filtro-tutto-service" class=" mr-2 <?= empty($searchParams['agid_service_type_id']) ? 'active active-filter' : '' ?> tag-filter btn btn-icon btn-outline-primary btn-sm align-top">
                    <span>Tutto</span>
                </a>
            </div>
            <?php
            foreach($tipologie as $i=>$filter){
                if($i<3){
                    $active = in_array($filter->id, $searchParams['agid_service_type_id']) ? 'active active-filter' : '';
                    ?>
                    <button id="filtro-service-<?= $filter->id; ?>" data-field="id-s-<?= $filter->id; ?>" class=" mr-2 <?= $active; ?> btn tag-filter-express-servizi btn-icon btn-outline-primary btn-sm align-top filter-person">
                        <span><?= $filter->name ?></span>
                    </button>
                <?php }
            }
            ?>


            <div class=" d-inline">
                <button  id="more-tag-service" type="button"  class="btn btn-icon btn-outline-primary btn-sm align-top h-100" data-toggle="modal" data-target="#more-option-servizi-modal" >
                    <svg class="icon d-flex icon-primary  mr-1" role="img">
                        <use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#dots-horizontal"></use>
                    </svg>

                </button>
            </div>


            <!--modale per filtri-->
            <!--modale more-option-->
            <!-- Large modal -->

            <div id="more-option-servizi-modal" class="modal fade more-option-servizi-modal" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modale-fullscreen-ricerca modal-dialog h-100 mw-100 w-100 m-0" style="height:100% !important;">
                    <div class="modal-content h-100" style="overflow-y:scroll;">
                        <div class="modal-header d-flex align-items-center justify-content-between uk-container">
                            <div class="d-flex">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <svg class="icon icon-primary mr-5" role="img" >
                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#arrow-left"></use>
                                    </svg>
                                </button>
                                <h2 class="h1">Filtri</h2>
                            </div>
                            <button class="btn btn-primary" type="submit"  aria-label="Close" >
                                Conferma
                            </button>


                        </div>
                        <div id="filter-container-service" class="modal-body uk-container h-100">

                            <div class="advanced-subnav right-subnav">
                                <div class="always-show-menu link-list-wrapper">

                                    <div class="mt-5">
                                        <?php

                                        $u = 0;
                                        $showTag = true;


                                        echo $form->field($model, 'agid_service_type_id')->checkboxList(\yii\helpers\ArrayHelper::map($tipologie, "id", "name"), [
                                            'onclick' => "$(this).val( $('input:checkbox:checked').val()));",
                                            'class' => 'd-flex flex-column',
                                            'item' => function($index, $label, $name, $checked, $value) {
                                                $check = ($checked ? 'checked' : '');
                                                return "<div class='form-check form-check-inline tag-filter-servizi'> <input id='id-s-{$value}' type='checkbox' {$check} class='filter-{$value} filter-service' name='{$name}' value='{$value}' tabindex='3' > <label for='id-s-{$value}'> {$label}</label> </div>";
                                            }
                                        ])->label(false);

                                        ?>
                                    </div>
                                    
                                </div>
                            </div>



                        </div>
                    </div>




                </div>

            </div>

        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div id="modulo-backend-servizi" class="modulo-backend-<?= $modelLabel ?> <?= $cssClass ?>">

        <div class="card-<?= $modelLabel ?>-container">
           
            <?php
            if ($dataProvider->getTotalCount() > 0) {
                
                $params = array_merge($_GET, ['#' => 'service']);

                $dataProvider->setPagination([
                    'params' => $params,
                    'route' => $currentPage,
                    'pageSize' => $dataProvider->getPagination()->pageSize ?? 3,
                ]);

                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_itemCardAgidService',
                    'viewParams' => [
                        'detailPage' => $detailPage,
                        'viewFields' => $viewFields,
                        'blockItemId' => $blockItemId,
                    ],
                    //'layout' => "<div class='summary-design'>{summary}</div>\n<div class='list-view-design row'>{items}</div>\n<div class='pagination-design'>{pager}</div>",
                    'summary' => '',
                    'itemOptions' => [
                        'tag' => false
                    ],
                    'options' => [
                        'class' => 'list-view w-100 d-flex flex-wrap'
                    ]

                ]);

            }else 
                if(!empty($searchParams['agid_service_type_id'])){

                    echo' <p id="no-content-service">Non sono presenti contenuti per questo filtro</p>';
                }else{
                    echo' <p id="no-content-service">Non sono presenti contenuti per questo filtro</p>';
                    
                }
            ?>

        </div>
    </div>
</div>