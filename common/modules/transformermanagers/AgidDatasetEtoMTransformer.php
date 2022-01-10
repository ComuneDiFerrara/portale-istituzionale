<?php
namespace common\modules\transformermanagers;

use open20\elasticsearch\models\ElasticIndex;
use open20\elasticsearch\transformer\modeltransformers\BaseElasticToModelTRansformer;


class AgidDatasetEtoMTransformer extends BaseElasticToModelTRansformer
{
    /* @var $model ElasticIndex */
    public function transform($elasticObject) 
    {
        $values = $elasticObject['_source'];
        unset($values['content_type']);
        unset($values['public']);
        unset($values['start_publication']);
        unset($values['end_publication']);
        $class = $this->getObjectClass();
        $model = new $class($values);
        $model->id = $elasticObject['_id'];
        return $model;
        
    }
}
