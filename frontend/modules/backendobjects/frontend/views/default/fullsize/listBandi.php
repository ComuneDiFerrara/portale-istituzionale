<?php

use DateTime;
use yii\widgets\ListView;
use open20\design\assets\BootstrapItaliaDesignAsset;
use yii\data\ActiveDataProvider;




$modelLabel = strtolower($model->getGrammar()->getModelLabel());

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$cssClass= 'uk-container';


$current_date = new DateTime();

$query_bandi_in_scadenza = clone $dataProvider->query;
$query_bandi_in_scadenza = $query_bandi_in_scadenza->andFilterWhere(['<', 'end_date', $current_date->format('Y-m-d')]);

$dataProvider_bandi_in_scandenza = new ActiveDataProvider([
    'query' => $query_bandi_in_scadenza,
    'id' => 'id_bandi_in_scadenza',
    'pagination' => [
        'pageSize' => 6,
        'route' => \Yii::$app->request->url
    ],
    'sort' => [
        'defaultOrder' => [
            'data_pubblicazione' => SORT_ASC, 
        ]
    ],
]);



$query_bandi_in_pubblicazione = clone $dataProvider->query;
$query_bandi_in_pubblicazione = $query_bandi_in_pubblicazione->andFilterWhere(['>=', 'end_date', $current_date->format('Y-m-d')]);

$dataProvider_bandi_in_pubblicazione = new ActiveDataProvider([
    'query' => $query_bandi_in_pubblicazione,
    'id' => 'id_bandi_in_pubblicazione',
    'pagination' => [
        'pageSize' => 6,
        'route' => \Yii::$app->request->url
    ],
    'sort' => [
        'defaultOrder' => [
            'data_pubblicazione' => SORT_ASC, 
        ]
    ],
]);

?>



<script>
    window.addEventListener("load", function(event) {
        if(document.getElementById("no-content-doc")){
            
            var content=document.getElementsByClassName("documenti-argomenti-block")[0];
            content.style.display = "none"; 
           
        }
    });

</script>

<div class="bandi-in-pubblicazione">
    <h4>BANDI IN PUBBLICAZIONE</h4>
    <div class="modulo-backend-<?= $modelLabel ?> <?= $cssClass ?>">
        
        <div class="card-<?= $modelLabel ?>-container">
            <?php
                if ($dataProvider_bandi_in_pubblicazione->getTotalCount() > 0) {

                    $dataProvider_bandi_in_pubblicazione->sort->defaultOrder = ['start_date' => SORT_DESC];

                    $params = (array) $dataProvider_bandi_in_pubblicazione->getPagination();
                    $params = array_merge_recursive($params, (array)\Yii::$app->request->get());
                    $params = array_unique($params);

                    $dataProvider_bandi_in_pubblicazione->setPagination([
                        'params' => $params,
                        'pageSize' => 6,
                        'route' => \Yii::$app->request->url
                    ]);
                    
                    echo ListView::widget([
                        'dataProvider' => $dataProvider_bandi_in_pubblicazione,
                        'itemView' => '_itemCardDocumentiBandi',
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
                            'id' => 'id-bandi_in_pubblicazione',
                            'class' => 'list-view w-100 d-flex flex-wrap',
                        ],
                    ]);
            }else{ ?>
            <div id="no-content-doc" class="no-result">
                    <p >Non sono presenti contenuti</p>
                    
                </div>
            <?php } ?>
        </div>
    </div>
</div>



<div class="bandi-scaduti mt-5">
    <h4>BANDI SCADUTI </h4>
    <div class="modulo-backend-<?= $modelLabel ?> <?= $cssClass ?>">
        
        <div class="card-<?= $modelLabel ?>-container">
            <?php
                if ($dataProvider_bandi_in_scandenza->getTotalCount() > 0) {

                    $params = (array) $dataProvider_bandi_in_scandenza->getPagination();
                    $params = array_merge_recursive($params, (array)\Yii::$app->request->get());
                    $params = array_unique($params);
                    
                    $dataProvider_bandi_in_scandenza->setPagination([
                        'params' => $params,
                        'pageSize' => 6,
                        'route' => \Yii::$app->request->url
                    ]);

                    $dataProvider_bandi_in_scandenza->sort->defaultOrder = ['start_date' => SORT_DESC];

                    echo ListView::widget([
                        'dataProvider' => $dataProvider_bandi_in_scandenza,
                        'itemView' => '_itemCardDocumentiBandi',
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
                            'id' => 'id-bandi_in_scadenza',
                            'class' => 'list-view w-100 d-flex flex-wrap'
                        ],
                    ]);

            }else{ ?>
            <div id="no-content-doc" class="no-result">
                    <p >Non sono presenti contenuti</p>
                    
                </div>
            <?php } ?>
        </div>
    </div>
</div>




