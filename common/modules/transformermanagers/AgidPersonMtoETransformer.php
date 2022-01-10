<?php

namespace common\modules\transformermanagers;

use open20\agid\person\models\AgidPerson;
use open20\elasticsearch\transformer\modeltransformers\BaseModelToElasticTransformer;

class AgidPersonMtoETransformer extends BaseModelToElasticTransformer {

    /* @var $model AgidPerson */
    public function transform($model) 
    {
        $values = [];
        $values['title'] = $this->filterString($model->name) . " ". $this->filterString($model->surname);
        $values['name'] = $this->filterString($model->name);
        $values['surname'] = $this->filterString($model->surname);
        $values['role'] = $this->filterString($model->role);
        $values['role_description'] = $this->filterString($model->role_description);
        //$values['date_end_assignment'] = $this->filterString($model->date_end_assignment);
        $values['skills'] = $this->filterString($model->skills);
        $values['delegation'] = $this->filterString($model->delegation);
        //$values['date_start_settlement'] = $this->filterString($model->date_start_settlement);
        $values['bio'] = $this->filterString($model->bio);
        $values['telephone'] = $this->filterString($model->telephone);
        $values['email'] = $this->filterString($model->email);
        $values['other_info'] = $this->filterString($model->other_info);
        $values['start_publication'] =  date("c",strtotime(self::MIN_DATE));
        $values['end_publication'] =  date("c",strtotime(self::MAX_DATE));
        //$values['person_function'] = $this->filterString($model->person_function);
        //$values['person_function_1'] = $this->filterString($model->person_function_1);
        //$values['person_function_2'] = $this->filterString($model->person_function_2);
        //$values['person_function_3'] = $this->filterString($model->person_function_3);
        //$values['person_function_4'] = $this->filterString($model->person_function_4);
        //$values['person_function_5'] = $this->filterString($model->person_function_5);
        $values['tags'] = $this->getTags($model);
        $content = $model->agidPersonContentType;
        $type = $model->agidPersonType;
        $values['content_type'] = sprintf("'%s'",(is_null($content) ? '' : str_replace(' ', '_',$content->name)) . "','" . (is_null($type) ? '' : str_replace(' ', '_',$type->name)));
        $values['public'] = ( $model->status == AgidPerson::AGID_PERSON_STATUS_VALIDATED ? "1" : "0");
        return $values;
    }

}
