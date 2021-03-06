<?php
namespace common\modules\transformermanagers;

use open20\elasticsearch\transformer\modeltransformers\BaseElasticToModelTRansformer;

class NewsEtoMTransformer  extends BaseElasticToModelTRansformer
{
    /* @var $model ElasticIndex */
    public function transform($elasticObject) 
    {
        $values = $elasticObject['_source'];
        unset($values['public']);
        unset($values['title']);
        unset($values['categoria_titolo']);
        unset($values['categoria_descrizione']);
        unset($values['content_type']);
        unset($values['start_publication']);
        unset($values['end_publication']);
        //$values['tags'] = $model->getTagValues();
        $class = $this->getObjectClass();
        $model =  new $class($values);
        $model->id = $elasticObject['_id'];
        return $model;
        
    }
}
