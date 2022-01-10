<?php

namespace app\modules\uikit\blocks;

use app\modules\uikit\Module;
use luya\cms\frontend\blockgroups\DevelopmentGroup;
use app\modules\uikit\BaseUikitBlock;
use trk\uikit\Uikit;
use Yii;


class VerticalMenuListBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "verticalmenulist";

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
        return Module::t('vertical-menu-list');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'data_usage';
    }

    /**
     * @inheritdoc
     */
    public function admin(array $params = array())
    {   
        
        return "Vertical menu of page.";
    }

    /**
     * 
     * @param array $params
     * @return string
     */
    public function frontend(array $params = array())
    {
        $blockId = $this->getEnvOption('id');
        $params['blockItemId'] = $blockId;
        
        $configs = $this->getValues();
        $configs["id"] = Uikit::unique($this->component);
        $params['data'] = Uikit::configs($configs);
        $params['debug'] = $this->config();
        $params['filters'] = $this->filters;
        
        $params['items'] = Yii::$app->menu->current->with(['hidden'])->children;
        $params['maxlevel'] = $this->getVarValue('level', '');
        return $this->view->render($this->getViewFileName('php'), $params, $this);
    }
}
