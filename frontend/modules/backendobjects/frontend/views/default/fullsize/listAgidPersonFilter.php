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
$tipologie = \open20\agid\person\models\AgidPersonType::find()->all();
$cssClass= 'uk-container';
$currentUrl=Url::current();
$pos = strpos($currentUrl, '%2F');
$currentPage=str_replace('%2C',',',str_replace('%C3%A0','à',substr($currentUrl, $pos+3)));
parse_str($currentUrl, $output);
$currentPage=substr($output['path'], (strpos($output['path'], '/')));


$js = <<<JS
    jQuery('body').on('click', '.tag-filter-express-person', function() {
        let id = jQuery(this).data('field');
        let elementoP = jQuery('input#'+id);
        let checkboxesP = elementoP.parents('.form-group').find('input[type="checkbox"]');
        checkboxesP.prop('checked', false);
        elementoP.prop('checked', true);
    });
   
   

   
    window.addEventListener("load", function(event) {
        var pulsanteTuttoServ=document.getElementById("filtro-tutto-person");
        if(pulsanteTuttoServ.classList.contains("active-filter")){
            var inputToCheck=$("#more-option-person-modal .modal-content input");
          
            inputToCheck.prop('checked', true);
          

        }
        if(document.getElementById("no-content-persone")){
            
            var content=document.getElementsByClassName("persone-argomenti-block")[0];
            content.style.display = "none"; 
           
        }
    });

JS;

$this->registerJs($js);
?>


<div id="person" class="anchor-offset">
	<div id="filtri-ricerca-person" class="d-flex justify-content-between pb-2">
		<p class="h3">Persone</p>
        <?php $form = ActiveForm::begin([
            'action' => (isset($originAction) ? [$originAction] : ['/'.$currentPage,'#' => 'person']),
            'method' => 'get',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{hint}",
                ],
        ]);

        $searchParams = \Yii::$app->request->get('AgidPersonSearch');
        ?>


		<div class="tag-filtri-container d-flex flex-wrap">
			<div class="ml-2 d-inline">
				<a href="<?= $currentPage ?>#person" id="filtro-tutto-person" class=" mr-2 <?= empty($searchParams['agid_person_type_id']) ? 'active active-filter' : '' ?> tag-filter btn btn-icon btn-outline-primary btn-sm align-top filter-person" >
					<span>Tutto</span>
				</a>
			</div>


            
            <?php
            foreach($tipologie as $i=>$filter){
                if($i<2){
                    $active = in_array($filter->id, $searchParams['agid_person_type_id']) ? 'active active-filter' : '';
                    ?>
					<button id="filtro-person-<?= $filter->id; ?>" data-field="id-p-<?= $filter->id; ?>" class=" mr-2 <?= $active; ?> btn tag-filter-express-person btn-icon btn-outline-primary btn-sm align-top">
						<span><?= $filter->name ?></span>
					</button>
                <?php }
            }
            ?>


			<div class=" d-inline">
				<button  id="more-tag-person" type="button"  class="btn btn-icon btn-outline-primary btn-sm align-top h-100" data-toggle="modal" data-target="#more-option-person-modal" >
					<svg class="icon d-flex icon-primary  mr-1" role="img">
						<use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#dots-horizontal"></use>
					</svg>

				</button>
			</div>




			<!--modale per filtri-->
			<!--modale more-option-->
			<!-- Large modal -->

			<div id="more-option-person-modal" class="modal fade more-option-person-modal" tabindex="-1" role="dialog"  aria-hidden="true">
				<div class="modale-fullscreen-ricerca modal-dialog h-100 mw-100 w-100 m-0">
					<div class="modal-content h-100">
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
						<div id="filter-container--person" class="modal-body uk-container h-100">

							<div class="advanced-subnav right-subnav">
								<div class="always-show-menu link-list-wrapper">

									<div class="mt-5">
                                        <?php

                                        $u = 0;
                                        $showTag = true;


                                        echo $form->field($model, 'agid_person_type_id')->checkboxList(\yii\helpers\ArrayHelper::map($tipologie, "id", "name"), [
                                            'onclick' => "$(this).val( $('input:checkbox:checked').val()));",
                                            'class' => 'd-flex flex-column',
                                            'item' => function($index, $label, $name, $checked, $value) {
                                                $check = ($checked ? 'checked' : '');
                                                return "<div class='form-check form-check-inline tag-filter-person'> <input id='id-p-{$value}' type='checkbox' {$check} class='filter-{$value} filter-person ' name='{$name}' value='{$value}' tabindex='3' > <label for='id-p-{$value}'> {$label}</label> </div>";
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

	<div id="modulo-backend-person" class="modulo-backend-<?= $modelLabel ?> <?= $cssClass ?>">

		<div class="card-<?= $modelLabel ?>-container">
        
            <?php
            if ($dataProvider->getTotalCount() > 0) {
               
                $params = array_merge($_GET, ['#' => 'person']);

                $dataProvider->setPagination([
                    'params' => $params,
                    'route' => $currentPage,
                    'pageSize' => $dataProvider->getPagination()->pageSize ?? 3,
                ]);
                
                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_itemCardAgidPerson',
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
                if(!empty($searchParams['agid_person_type_id'])){

                    echo' <p id="no-content-persone">Non sono presenti contenuti per questo filtro</p>';
                } else{
                    echo('<p id="no-content-persone">Non sono presenti contenuti per questo filtro</p>');
                }
            ?>

		</div>
	</div>
</div>











