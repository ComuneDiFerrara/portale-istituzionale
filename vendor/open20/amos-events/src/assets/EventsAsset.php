<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\events
 * @category   CategoryName
 */

namespace open20\amos\events\assets;
use open20\amos\core\widget\WidgetAbstract;

use yii\web\AssetBundle;

/**
 * Class AmosEventsAsset
 * @package open20\amos\events\assets
 */
class EventsAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/open20/amos-events/src/assets/web/';
    public $baseUrl = '@web';

    /**
     * @inheritdoc
     */
    public $js = [
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'less/events.less',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
    ];

    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');

        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS){
            $this->css = ['less/events_fullsize.less','less/calendary.less'];
        }

        if(!empty($moduleL))
        { $this->depends [] = 'open20\amos\layout\assets\BaseAsset'; }
        else
        { $this->depends [] = 'open20\amos\core\views\assets\AmosCoreAsset'; }
        parent::init(); // TODO: Change the autogenerated stub
    }
}
