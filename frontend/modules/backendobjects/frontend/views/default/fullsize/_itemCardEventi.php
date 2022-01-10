<?php
use yii\helpers\ArrayHelper;
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

?>


<!--impostazione img default-->
<?php
    $url = '/img/img_default.jpg';
    if (!is_null($model->eventLogo)) {
      $url = $model->eventLogo->getWebUrl('dashboard_news', false, true);
    }

?>

<?php 
    if( $detailPage ){
        $route = Yii::$app->getModule('backendobjects')::getSeoUrl($model->getPrettyUrl(), $blockItemId);
    }
    $tags = $model->getTagsList();
?>

<?=
  $this->render(
    '@vendor/open20/design/src/components/agid/views/agid-card-novità',
    [
      'image' => $url,
      'date' =>$model->begin_date_hour,
      'title' => $model->title,
      'showAvatar' => false,
      'hideCategory' => true,
      'descriptionSize' => 'pt-3 flex-grow-1',
      'description' =>   $model->agid_description ,
      'tags' => $tags,
      'url'=> $route,
      'additionalCssExternalClass' => 'd-flex box-card mb-4',
      'widthColumn' => 'col-md-4 col-xs-12',
    ]
  );
?>
