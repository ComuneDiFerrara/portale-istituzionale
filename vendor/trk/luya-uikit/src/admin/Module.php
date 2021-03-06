<?php

namespace trk\uikit\admin;

use Yii;
use luya\base\CoreModuleInterface;

/**
 * Uikit Admin Module.
 *
 *
 */
final class Module extends \luya\admin\base\Module implements CoreModuleInterface
{
    /**
     * @inheritdoc
     */
    public function getAdminAssets()
    {
        return  [
            'trk\uikit\admin\assets\Main',
        ];
    }
}
