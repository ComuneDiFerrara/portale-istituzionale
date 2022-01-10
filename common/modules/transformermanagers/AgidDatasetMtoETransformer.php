<?php
namespace common\modules\transformermanagers;

use open20\agid\dataset\models\AgidDataset;
use open20\elasticsearch\transformer\modeltransformers\BaseModelToElasticTransformer;

class AgidDatasetMtoETransformer extends BaseModelToElasticTransformer {

    /* @var $model AgidDataset */
    public function transform($model) 
    {
        $values = [];
        $values['title'] = $this->filterString($model->title);
        $values['description'] = $this->filterString($model->description);
        $values['start_publication'] =  date("c",strtotime(self::MIN_DATE));
        $values['end_publication'] =  date("c",strtotime(self::MAX_DATE));
        $values['tags'] = $this->getTags($model); 
        $content = $model->agidDatasetContentType;
        $type = $model->agidDatasetType;
        $values['content_type'] = sprintf("'%s'",(is_null($content) ? '' : str_replace(' ', '_',$content->name)) . "','" . (is_null($type) ? '' : str_replace(' ', '_',$type->name)));
        $values['public'] = ( $model->status ==  AgidDataset::AGID_DATASET_WORKFLOW_STATUS_VALIDATED ? "1" : "0");
        return $values;
    }
}
