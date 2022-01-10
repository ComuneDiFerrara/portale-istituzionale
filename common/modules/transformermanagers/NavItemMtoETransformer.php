<?php
namespace common\modules\transformermanagers;

use open20\elasticsearch\models\NavItem;
use open20\elasticsearch\transformer\modeltransformers\BaseModelToElasticTransformer;


class NavItemMtoETransformer  extends BaseModelToElasticTransformer 
{

    /* @var $model NavItem */
    public function transform($model) 
    {
        $values['elasticSourceText'] = $this->filterString($model->elasticSourceText);
        $values['elasticUrl'] = $this->filterString($model->elasticUrl);
        $values['public'] = "1";
        $values['start_publication'] =  date("c",strtotime(self::MIN_DATE));
        $values['end_publication'] =  date("c",strtotime(self::MAX_DATE));
        return $values;
    }
}
