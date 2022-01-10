<?php
namespace common\modules\transformermanagers;

use open20\agid\service\models\AgidService;
use open20\elasticsearch\transformer\modeltransformers\BaseModelToElasticTransformer;

class AgidServiceMtoETransformer extends BaseModelToElasticTransformer {

    /* @var $model AgidService */
    public function transform($model) 
    {
        $values = [];
        $values['title'] = $this->filterString($model->name) . " " . $this->filterString($model->subtitle);
        $values['name'] = $this->filterString($model->name);
        $values['service_status_motivation'] = $this->filterString($model->service_status_motivation);
        $values['subtitle'] = $this->filterString($model->subtitle);
        $values['description'] = $this->filterString($model->description);
        $values['long_description'] = $this->filterString($model->long_description);
        $values['recipients_description'] = $this->filterString($model->recipients_description);
        $values['persons_apply'] = $this->filterString($model->persons_apply);
        $values['geographical_apply'] = $this->filterString($model->geographical_apply);
        $values['procedure_apply'] = $this->filterString($model->procedure_apply);
        $values['outcome_procedure_apply'] = $this->filterString($model->outcome_procedure_apply);
        $values['output'] = $this->filterString($model->output);
        $values['digital_channel_url'] = $this->filterString($model->digital_channel_url);
        $values['authentication_way'] = $this->filterString($model->authentication_way);
        $values['physical_channel'] = $this->filterString($model->physical_channel);
        $values['physical_channel_reservation'] = $this->filterString($model->physical_channel_reservation);
        $values['instructions'] = $this->filterString($model->instructions);
        $values['costs'] = $this->filterString($model->costs);
        $values['constrains'] = $this->filterString($model->constrains);
        $values['phases_deadline'] = $this->filterString($model->phases_deadline);
        $values['special_case'] = $this->filterString($model->special_case);
        $values['external_links'] = $this->filterString($model->external_links);
        $values['start_publication'] =  date("c",strtotime(self::MIN_DATE));
        $values['end_publication'] =  date("c",strtotime(self::MAX_DATE));
        $values['tags'] = $this->getTags($model);
        $content = $model->agidServiceContentType;
        $type = $model->agidServiceType;
        $values['content_type'] = sprintf("'%s'",(is_null($content) ? '' : str_replace(' ', '_',$content->name)) . "','" . (is_null($type) ? '' : str_replace(' ', '_',$type->name)));        
        $values['public'] = ( $model->status == AgidService::AGID_SERVICE_STATUS_VALIDATED ? "1" : "0");
        return $values;
    }
}
