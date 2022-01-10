<?php
namespace common\modules\transformermanagers;

use open20\amos\events\models\Event;
use open20\elasticsearch\transformer\modeltransformers\BaseModelToElasticTransformer;

class EventMtoETransformer extends BaseModelToElasticTransformer 
{
    /* @var $model Event */
    public function transform($model) 
    {
        
        $values = [];
        $values['title'] = $this->filterString($model->title). " " . $this->filterString($model->summary);
        $values['summary'] = $this->filterString($model->summary);
        $values['agid_description'] = $this->filterString($model->agid_description);
        $values['agid_georeferencing'] = $this->filterString($model->agid_georeferencing);
        $values['agid_dates_and_hours'] = $this->filterString($model->agid_dates_and_hours);
        $values['agid_price'] = $this->filterString($model->agid_price);
        $values['agid_organized_by'] = $this->filterString($model->agid_organized_by);
        $values['agid_contact'] = $this->filterString($model->agid_contact);
        $values['agid_website'] = $this->filterString($model->agid_website);
        $values['agid_other_informations'] = $this->filterString($model->agid_other_informations);
        $values['agid_geolocation'] = $this->filterString($model->agid_geolocation);
        // $values['description'] = $this->filterString($model->description);
        $values['description'] = $this->filterString($model->agid_description);
        //$values['begin_date_hour'] = $this->filterString($model->begin_date_hour);
        $values['start_publication'] =  date("c",strtotime($model->publication_date_begin));
        $values['end_publication'] =  date("c",strtotime($model->publication_date_end));
        $values['tags'] = $this->getTags($model);
        $values['content_type'] = 'Eventi';
        $values['public'] = ( $model->status == Event::EVENTS_WORKFLOW_STATUS_PUBLISHED ? "1" : "0");
        return $values;
    }
}
