<?php

namespace app\modules\uikit\blocks;

use app\modules\uikit\BaseUikitBlock;
use app\modules\uikit\Module;
use luya\cms\frontend\blockgroups\DevelopmentGroup;
use trk\uikit\Uikit;

class CarouselEventsBlock extends BaseUikitBlock
{
    public $cacheEnabled = false;

    /**
     * @inheritdoc
     */
    protected $component = "carouselevents";

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return DevelopmentGroup::className();
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('carouselevents');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function admin(array $params = array())
    {
        return $this->frontend($params);
    }

    public function frontend(array $params = array())
    {
        if (!Uikit::element('data', $params, '')) {
            $configs        = $this->getValues();
            $configs["id"]  = Uikit::unique($this->component);
            $params['data'] = Uikit::configs($configs);
        }
        return $this->view->render($this->getViewFileName('php'), $params, $this);
    }
}