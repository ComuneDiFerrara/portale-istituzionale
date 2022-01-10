<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\design
 * @category   CategoryName
 */
use yii\helpers\Html;
use yii\helpers\Url;

use app\assets\CustomAsset;


?>
<?php 
/*
$test = <<< JS
var testVar='test';
var textToInjectInMetaTitle=document.getElementsByTagName("h1")[0].textContent;
var metaTitle=document.getElementsByTagName("title")[0];
var metaTitleText=document.getElementsByTagName("title")[0].textContent;
metaTitle.innerHTML=metaTitleText+' : ' +textToInjectInMetaTitle;
alert(metaTitle.textContent);
JS;

$this->registerJs($test, View::POS_READY);
*/
?>
<?php 
$positions = array();
$pos = -1;
while (($pos = strpos(Url::current(), '/', $pos+1)) !== false) {
    $positions[] = $pos;
}

$positions2=array();
$pos2 = -1;
while (($pos2 = strpos(Url::current(), '?', $pos2+1)) !== false) {
    $positions2[] = $pos2;
}
$lastPost= end($positions);
if($positions2){
    $lastPost2= reset($positions2);
}

if($lastPost2){
    $metaTitle= substr(Url::current(),$lastPost+1, $lastPost2);
}else{
    $metaTitle= substr(Url::current(),$lastPost+1);
}
$metaTitle = str_replace('-', " ", $metaTitle);
$metaTitle = ucwords($metaTitle);
$metaTitle = ' : '. $metaTitle;


if (strpos($metaTitle,'?')) {
    $posFinal = strpos($metaTitle, '?');
    $metaTitle=substr($metaTitle,0, $posFinal); 
}
?>
<base href="<?= Yii::$app->params['platform']['frontendUrl']; ?>">
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Comune di Ferrara | Città Patrimonio dell'Umanità <?= (!empty($metaTitle)) ? $metaTitle : '' ?></title>
<meta name="description" content="Il sito web istituzionale del Comune di Ferrara: amministrazione, novità, servizi, documenti e dati.">
<link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl . Yii::$app->params['favicon'] ?>" type="image/x-icon" />
<?php $this->head() ?>
<?php $this->registerJs("window.__PUBLIC_PATH__ = '{$currentAsset->baseUrl}/node_modules/bootstrap-italia/dist/fonts'", \yii\web\View::POS_HEAD); ?>

