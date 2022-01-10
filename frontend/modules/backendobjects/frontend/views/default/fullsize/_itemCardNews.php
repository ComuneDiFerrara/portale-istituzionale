<?php
use yii\helpers\ArrayHelper;
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

?>


<!--impostazione img default-->
<?php
    $url = '/img/img_default.jpg';
    if (!is_null($model->newsImage)) {
      $url = $model->newsImage->getWebUrl('dashboard_news', false, true);
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
      'date' =>$model->date_news,
      'title' => $model->title,
      'showAvatar' => false,
      'hideCategory' => true,
      'descriptionSize' => 'pt-3 flex-grow-1',
      'description' =>  $model->descrizione_breve,
      'tags' => $tags,
      'additionalCssExternalClass' => 'd-flex box-card mb-4',
      'url'=> $route,
      'widthColumn' => 'col-md-4 col-xs-12',
    ]
  );
?>
