<?php

use yii\widgets\ListView;
use open20\amos\core\helpers\Html;
use yii\widgets\ActiveForm;
use luya\helpers\Url;

?>




<?php
$modelLabel = strtolower($model->getGrammar()->getModelLabel());



use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$cssClass= 'uk-container';
$tipologie = \open20\amos\documenti\models\DocumentiAgidContentType::find()->all();
$currentUrl=Url::current();
$pos = strpos($currentUrl, '%2F');
$currentPage=str_replace('%2C',',',str_replace('%C3%A0','à',substr($currentUrl, $pos+3)));
parse_str($currentUrl, $output);
$currentPage=substr($output['path'], (strpos($output['path'], '/')));


$js = <<<JS
    jQuery('body').on('click', '.tag-filter-express-documenti', function() {
        let id = jQuery(this).data('field');
        let elemento = jQuery('input#'+id);
        let checkboxes = elemento.parents('.form-group').find('input[type="checkbox"]');
        checkboxes.prop('checked', false);
        elemento.prop('checked', true);
    });
 
    window.addEventListener("load", function(event) {
        var pulsanteTuttoServ=document.getElementById("filtro-tutto-doc");
        if(pulsanteTuttoServ.classList.contains("active-filter")){
            var inputToCheck=$("#more-option-documenti-modal .modal-content input");
          
            inputToCheck.prop('checked', true);
          

        }
        if(document.getElementById("no-content-doc")){
            
            var content=document.getElementsByClassName("documenti-argomenti-block")[0];
            content.style.display = "none"; 
           
        }
        
    });
JS;

$this->registerJs($js);
?>


<div id="doc" class="anchor-offset">

<div id="filtri-ricerca-doc" class="d-flex justify-content-between pb-2">
	<p class="h3">Documenti</p>
    <?php $form = ActiveForm::begin([
        'action' => (isset($originAction) ? [$originAction] : ['/'.$currentPage ,'#' => 'doc']),
        'method' => 'get',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{hint}",
            ],
    ]);

    $searchParams = \Yii::$app->request->get('DocumentiSearch');
    ?>


	<div class="tag-filtri-container d-flex flex-wrap">
		<div class="ml-2 d-inline">
			<a id="filtro-tutto-doc"  href="<?= $currentPage?>#doc" class=" mr-2 <?= empty($searchParams['documenti_agid_content_type_id']) ? 'active active-filter' : '' ?> tag-filter btn btn-icon btn-outline-primary btn-sm align-top filter-doc">
				<span>Tutto</span>
			</a>
		</div>
        <?php
        foreach($tipologie as $i=>$filter){
            if($i<2){
                $active = in_array($filter->id, $searchParams['documenti_agid_content_type_id']) ? 'active active-filter' : '';
                ?>
				<button id="filtro-doc-<?= $filter->id; ?>" data-field="id-<?= $filter->id; ?>" class=" mr-2 <?= $active; ?> btn tag-filter-express-documenti btn-icon btn-outline-primary btn-sm align-top">
					<span><?= $filter->name ?></span>
				</button>
            <?php }
        }
        ?>


		<div class=" d-inline">
			<button  id="more-tag-doc" type="button"  class="btn btn-icon btn-outline-primary btn-sm align-top h-100" data-toggle="modal" data-target="#more-option-documenti-modal" >
				<svg class="icon d-flex icon-primary  mr-1" role="img">
					<use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#dots-horizontal"></use>
				</svg>

			</button>
		</div>




		<!--modale per filtri-->
		<!--modale more-option-->
		<!-- Large modal -->

		<div id="more-option-documenti-modal" class="modal fade more-option-documenti-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modale-fullscreen-ricerca modal-dialog h-100 mw-100 w-100 m-0">
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
					<div id="filter-container-doc" class="modal-body uk-container h-100">

						<div class="advanced-subnav right-subnav">
							<div class="always-show-menu link-list-wrapper">

								<div class="mt-5">
                                    <?php

                                    $u = 0;
                                    $showTag = true;


                                    echo $form->field($model, 'documenti_agid_content_type_id')->checkboxList(\yii\helpers\ArrayHelper::map($tipologie, "id", "name"), [
                                        'onclick' => "$(this).val( $('input:checkbox:checked').val()));",
                                        'class' => 'd-flex flex-column',
                                        'item' => function($index, $label, $name, $checked, $value) {
                                            $check = ($checked ? 'checked' : '');
                                            return "<div class='form-check form-check-inline tag-filter-documenti'> <input id='id-{$value}' type='checkbox' {$check} class='filter-{$value} filter-doc' name='{$name}' value='{$value}' tabindex='3' > <label for='id-{$value}'> {$label}</label> </div>";
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

<div id="modulo-backend-documenti" class="modulo-backend-<?= $modelLabel ?> <?= $cssClass ?>">
	<div class="card-<?= $modelLabel ?>-container">
        <?php
        if ($dataProvider->getTotalCount() > 0) {
            $params = array_merge($_GET, ['#' => 'doc']);

            $dataProvider->setPagination([
                'params' => $params,
                'route' => $currentPage,
                'pageSize' => $dataProvider->getPagination()->pageSize ?? 3,
            ]);
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_itemCardDocumenti',
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
        }else {
            if(!empty($searchParams['documenti_agid_content_type_id'])){

            echo' <p id="no-content-doc" >Non sono presenti contenuti per questo filtro</p>';
            }else{
                echo' <p id="no-content-doc" >Non sono presenti contenuti per questo filtro</p>';

            }
        } ?>

	</div>
</div>

</div>


