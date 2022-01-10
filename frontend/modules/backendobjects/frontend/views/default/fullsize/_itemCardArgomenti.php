<?php
use yii\helpers\ArrayHelper;
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

use open20\amos\documenti\models\Documenti;
?>



<?php 
   
        $route = '/' . app\modules\cms\helpers\CmsHelper::slugifyAlias($model->nome);
        //PUNTA A PAG CMS
  if(!empty($model->icon)){
    $icon=$model->icon;
  }else{
    $icon='forum';
  }
?>

<?=
  $this->render(
    '@vendor/open20/design/src/components/agid/views/agid-card-topic',
    [
      'topicIcon' => $model->icon, 
      'topicTitle' => $model->nome,
      'topicLink' => $route,
      'additionalContainerClass' => 'box-card mb-4 col-md-4 col-xs-12',
      //'columnWidth' => '',
    ]
  );
?>