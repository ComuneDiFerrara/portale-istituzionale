<?php
use yii\helpers\ArrayHelper;
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);


$columnWidth = (isset($columnWidth)) ? $columnWidth : 'col-12';
$topicIcon = (isset($topicIcon)) ? $topicIcon : 'help-circle-outline';


if($model->agid_person_type_id==1){
  $categoryIcon= 'account-tie';
}else{
    if($model->agid_person_type_id==2){
        $categoryIcon= 'card-account-details-outline';
    }else{
      $categoryIcon= 'file-document';
    }
}

if( $detailPage ){
  $urlDetail = Yii::$app->getModule('backendobjects')::getSeoUrl($model->getPrettyUrl(), $blockItemId);
}
$titleCard=$model->name .' ' .$model->surname;
if( $model->email ){
  $email= ' '. $model->email;
}
if( $model->telephone ){
  $telephone= ' '. $model->telephone;
}
if (!is_null($model->photo)) {
  $imageUrl = $model->photo->getWebUrl('dashboard_news', false, true);
}

?>


<div class="col-lg-4 col-md-6 col-xs-12 agid-generic-card-container box-card mb-4 ">
    <div class=" h-100  shadow ">
      <div class="row h-100 ">
        <?php if (!is_null($model->photo)) { ?>
          <div class="col-md-6 col-lg-8 d-flex flex-column" style="padding-top:0 !important; padding-bottom:0 !important">
            <a class="h5 pt-4 px-4 text-uppercase font-weight-bold primary-color" title="Vai alla scheda di <?= $titleCard ?>" href="<?= $urlDetail ?>"><?= $titleCard ?></a>
            <div class="px-4 role-description"><?= $model->role_description ?> in carica dal 
              <?= Yii::$app->formatter->asDate($model->date_start_settlement, 'dd').' '.ucwords(Yii::$app->formatter->asDate($model->date_start_settlement, 'MMMM')).' '.Yii::$app->formatter->asDate($model->date_start_settlement, 'YYYY'); ?>
            </div>    
            <div class="py-4 px-4 read-more flex-grow-1 d-flex align-items-end">
              <a class="text-uppercase font-weight-bold" title="Esplora <?= $titleCard ?>" href="<?= $urlDetail ?>">Leggi di più →</a> 
            </div>   
          </div>
          <div class="col-md-6 col-lg-4 pl-0" style="margin-top:-16px;margin-bottom:-16px;">
            <img src="<?= $imageUrl ?>" class="h-100 w-100 figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura." style="object-fit:cover; margin-bottom:0;">            
          </div>
        <?php }else{ ?>
          <div class="col d-flex flex-column "  style="padding-top:0 !important; padding-bottom:0 !important">
            <a class="h5 pt-4 px-4 text-uppercase font-weight-bold primary-color" title="Vai alla scheda di <?= $titleCard ?>" href="<?= $urlDetail ?>"><?= $titleCard ?></a>
            <div class="px-4 role-description">
              <?= $model->role_description ?> in carica dal <?= Yii::$app->formatter->asDate($model->date_start_settlement, 'dd').' '.ucwords(Yii::$app->formatter->asDate($model->date_start_settlement, 'MMMM')).' '.Yii::$app->formatter->asDate($model->date_start_settlement, 'YYYY'); ?>
            </div>
            <div class="py-4 px-4  read-more flex-grow-1 d-flex align-items-end">
              <a class="text-uppercase font-weight-bold" title="Esplora <?= $titleCard ?>" href="<?= $urlDetail ?>">Leggi di più →</a> 
            </div>   
            
          </div>
        <?php } ?>
      </div>                                   
      


    </div>                                   
</div>
