<?php

use yii\widgets\ListView;
?>

<?php
$modelLabel = strtolower($model->getGrammar()->getModelLabel());



use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$cssClass= 'uk-container';
?>

<?php
    if($model->agid_person_type_id==1){
        $categoryIcon= 'account-tie';
    }else{
        if($model->agid_person_type_id==2){
            $categoryIcon= 'card-account-details-outline';
        }
    }
?>

<div class="modulo-backend-agidOrganizationalUnit <?= $cssClass ?>">
    
    <div class="card-<?= $modelLabel ?>-container">
        <?php
        if ($dataProvider->getTotalCount() > 0) {
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_itemCardAgidPersonPolitici',
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
        }else{ ?>
            <div class="no-result">
                <p >Non sono presenti contenuti</p>
            </div>
        <?php } ?>
    </div>
</div>