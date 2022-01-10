<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

use app\modules\cms\helpers\CmsHelper;
use open20\amos\news\AmosNews;
use app\assets\ResourcesAsset;
$resourceAsset = ResourcesAsset::register($this);


$truncate = 250;
$url = $resourceAsset->baseUrl . '/img/img_default.jpg';
?>


<?php
if( $detailPage ){
    $route = Yii::$app->getModule('backendobjects')::getSeoUrl($model->getPrettyUrl(), $blockItemId);
}
if(!is_null($model->newsImage->getWebUrl('square_medium', false, true))){
    $url = $model->newsImage->getWebUrl('square_medium', false, true);
}
?>
<a href="<?= $route ?>" title="Leggi tutto">
<div class="content-image">
    <?php
    echo $contentImage = CmsHelper::img(
        $url,
        [
            'class' => 'el-image',
            'alt' => AmosNews::t('amosnews', 'Immagine della notizia')
        ]
    );
    ?>
</div>


<div class="el-content">
    <h2 class="el-title">
        <?= $model->getTitle(); ?>
    </h2>
</div>

</a>

