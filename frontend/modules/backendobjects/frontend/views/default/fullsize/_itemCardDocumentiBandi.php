<?php
use DateTime;
use yii\helpers\ArrayHelper;
use app\modules\backendobjects\frontend\Module;
use open20\amos\documenti\models\Documenti;
use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

?>

<!--impostazione icona a seconda categoria-->
<?php
    $contentType=$model->documentiAgidContentType;
    if(!is_null($contentType) && !empty($contentType->content_type_icon)){
        $categoryIcon=$contentType->content_type_icon;
    }else{
        $categoryIcon= 'file-document';
    }

    if($model->documenti_agid_content_type_id==5){
        
        if($model->agidOrganizationalUnitContentTypeArea){
            $refArea = $model->agidOrganizationalUnitContentTypeArea->name ;
            $module = Module::getInstance();

            $areaModel= $model->agidOrganizationalUnitContentTypeArea;
            $cls = $areaModel->className();
            $refAreaLink = Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls, $module->modelsDetailMapping[$cls]);
        
        }

    }
   
?>

<?php 
    if( $detailPage ){
        $route = Yii::$app->getModule('backendobjects')::getSeoUrl($model->getPrettyUrl(), $blockItemId);
    }
    if( (($model->documenti_agid_content_type_id == 6) && ($model->documenti_agid_type_id== 12)) || ($model->documenti_agid_content_type_id == 5) ){
        $tags = $model->getTagsList();
        
    }else{
        $tags = $model->documentiAgidContentType->name;
    }
?>


<?php 

    // // set format italia for start_date and end date
    // // $start_date = null;

    // // if( (null != $model->start_date) && !empty($model->start_date) ){
    // //     $start_date = new DateTime($model->start_date);

    // //     $oldLocale = setlocale(LC_TIME, 'it_IT');
    // //     $start_date = utf8_encode( strftime("%d %B %Y", strtotime($start_date->format('d F Y'))) );
    // //     setlocale(LC_TIME, $oldLocale);
    // // }

    // // $end_date = null;

    // // if( (null != $model->end_date) && !empty($model->end_date) ){
    // //     $end_date = new DateTime($model->end_date);

    // //     $oldLocale = setlocale(LC_TIME, 'it_IT');
    // //     $end_date = utf8_encode( strftime("%d %B %Y", strtotime($end_date->format('d F Y'))) );
    // //     setlocale(LC_TIME, $oldLocale);
    // // }
   
?>

<?=
  $this->render(
    '@vendor/open20/design/src/components/agid/views/agid-card-generic',
    [
      'categoryIcon' => $categoryIcon,
      'categoryName' => $model->documentiAgidContentType->name,
      'cardTitle' => $model->titolo,
      'cardText'=>$model->descrizione_breve,
      'urlDetail' => $route,
      'refArea' => $refArea,
      'refAreaLink' => $refAreaLink,
      'additionalCssExternalClass' => 'box-card mb-4',
      'columnWidth' => 'col-md-4 col-xs-12',
      'tags'=>$tags,
      'start_date' => $model->start_date,
      'end_date' =>  $model->end_date,
    ]
  );
?>