<?php

namespace app\modules\uikit\blocks;

use app\modules\uikit\BaseUikitBlock;
use app\modules\uikit\Module;
use luya\cms\frontend\blockgroups\DevelopmentGroup;
use trk\uikit\Uikit;
use Yii;

class AssetsHighlightsBlock extends BaseUikitBlock
{
    public $cacheEnabled = false;
    public $frontendModuleName = "backendobjects";
    public $module = 'backendobjects';
    
    private $modelSearchClass;
    private $backendModule;
    
    private $evidenza_field = 'in_evidenza';

    /**
     * @inheritdoc
     */
    protected $component = "assetshighlights";

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
        return Module::t('assetshighlights');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'drag_indicator';
    }
    
    public function config() {
        $config = parent::config();
        array_unshift( $config ['vars'],
                ['var' => 'backendModule', 'label' => 'Module', 'type' => self::TYPE_SELECT, 'options' => $this->getBackendModules()]);
        
        $config ['vars'][] = ['var' => 'tags', 'label' => 'Tags', 'type' => self::TYPE_MULTIPLE_INPUTS, 'options' =>
            [
                 [
                     'type' => self::TYPE_SELECT,
                     'var' => 'tag',
                     'label' => 'Tag',
                     'options' => $this->getTags()
                 ]
             ]
        ];
        return $config;
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
        
        $backendModule    = $params['data']["backendModule"];
        $modelSearchClass = "";
        if (class_exists($backendModule) && in_array('open20\amos\core\interfaces\CmsModuleInterface',
                class_implements($backendModule))) {
            $modelSearchClass = $backendModule::getModelSearchClassName();

            if (class_exists($modelSearchClass) && in_array('open20\amos\core\interfaces\CmsModelInterface',
                    class_implements($modelSearchClass))) {
                $this->modelSearchClass = $modelSearchClass;
                $this->backendModule    = $backendModule;
            }
        }
        $params['dataProvider'] = null;
        if(!empty($this->modelSearchClass))
        {
            $searchModel = new $this->modelSearchClass();
            switch($params['data']['layout'])
            {
                case 1:
                    $limit = 4;
                    break;
                case 2:
                    $limit = 3;
                    break;
                default:
                    $limit = 4;
                    break;
            }
            $methodSearch = "cmsSearch";
            $parms["withPagination"] = true;
            $parms["conditionSearch"] = "";
            if(count($params['data']['tags']))
            {
                $parms["conditionSearch"] = "['in','tag_id',[". $this->implodeTags($params['data']['tags']). "] ]";         
            }
            if($params['data']['is_highlights'] && $searchModel->hasAttribute($this->evidenza_field) )
            {
                if(!empty($parms["conditionSearch"]))
                {
                    $parms["conditionSearch"] .= "; ";
                }
                $parms["conditionSearch"] .= "[$this->evidenza_field => 1]";
            }

            // orderBy
            if( isset($params['data']['orderBy']) && (null != $params['data']['orderBy']) ){

                $parms['orderBy'] = $params['data']['orderBy'];
            }

            $params['dataProvider'] = $searchModel->$methodSearch($parms, $limit);
        }
        return $this->view->render($this->getViewFileName('php'), $params, $this);
    }
    
    /**
     * 
     * @return type
     */
    public function getBackendModules() {
        $frontendModule = Yii::$app->getModule($this->frontendModuleName);

        $data = [];
        if ($frontendModule && $frontendModule->modulesEnabled) {
            foreach ($frontendModule->modulesEnabled as $backModuleEnabled) {
                if (class_exists($backModuleEnabled) && in_array('open20\amos\core\interfaces\CmsModuleInterface', class_implements($backModuleEnabled))) {
                    $moduleName = $backModuleEnabled::getModuleName();
                    $modelSearchClass = $backModuleEnabled::getModelSearchClassName();
                    if (class_exists($modelSearchClass) && in_array('open20\amos\core\interfaces\CmsModelInterface', class_implements($modelSearchClass))) {
                        $data[] = ['value' => $backModuleEnabled, 'label' => $moduleName];
                    }
                }
            }
        }
        return $data;
    }
    
    /**
     * 
     * @return array
     */
    public function getTags()
    {
        $data = [];
        $tags = \open20\amos\tag\utility\TagUtility::findTagsByRootId(1);
        foreach($tags as $tag)
        {
            $data[] = ['value' => $tag->id, 'label' => $tag->nome];
        }
        return $data;
    }
    
    /**
     * 
     * @param array $tags
     */
    private function implodeTags($tags)
    {
        $string_implode= "";
        $first = true;
        foreach($tags as $tag)
        {
            if(!$first)
            {
                $string_implode .= ", ";
            }
            else
            {
                $first = false;
            }
            $string_implode .= $tag['tag'];
        }
        return $string_implode;
    }
}