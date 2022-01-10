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


$truncate = 250;
?>


<div>
    <?php
    echo $contentImage = CmsHelper::img(
        $model->getFileImage()->getWebUrl(),
        [
            'class' => 'el-image',
            'alt' => AmosNews::t('amosnews', 'immagine')
        ]
    );
    ?>
</div>