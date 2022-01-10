<?php
use yii\helpers\ArrayHelper;
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
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
      'categoryName' => $model->agidDatasetType->name,
      'cardTitle' => $model->title,
      'urlDetail' =>$route,
      'additionalCssExternalClass' => 'box-card mb-4',
      'columnWidth' => 'col-md-4 col-xs-12',
    ]
  );
?>
