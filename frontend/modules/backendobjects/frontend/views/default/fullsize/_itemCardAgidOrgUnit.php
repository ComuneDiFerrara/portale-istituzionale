<?php
use yii\helpers\ArrayHelper;
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

//use open20\amos\documenti\models\Documenti;
?>


<!--impostazione icona a seconda categoria-->
<?php

    $contentType=$model->agidOrganizationalUnitContentType;
    if(!is_null($contentType) && !empty($contentType->content_type_icon)){
        $categoryIcon=$contentType->content_type_icon;
    }else{
        $categoryIcon= 'office-building';
    }

 
?>



<?php 
    if( $detailPage ){
        $route = Yii::$app->getModule('backendobjects')::getSeoUrl($model->getPrettyUrl(), $blockItemId);
    }
?>





<?=
  $this->render(
    '@vendor/open20/design/src/components/agid/views/agid-card-generic',
    [
      'categoryIcon' => $categoryIcon,
      'categoryName' => $model->agidOrganizationalUnitContentType->name,
      'cardTitle' => $model->name,
      'cardText'=>$model->short_description,
      'urlDetail' =>$route,
      'additionalCssExternalClass' => 'box-card mb-4',
      'columnWidth' => 'col-md-4 col-xs-12',
      'tags'=>$model->agidOrganizationalUnitContentType->name,

    ]
  );
?>
