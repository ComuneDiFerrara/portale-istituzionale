<?php
namespace common\modules\transformermanagers;

use open20\agid\organizationalunit\models\AgidOrganizationalUnit;
use open20\elasticsearch\transformer\modeltransformers\BaseModelToElasticTransformer;


class AgidOrganizationalUnitMtoETransformer extends BaseModelToElasticTransformer
{
    /* @var $model AgidOrganizationalUnit */
    public function transform($model) 
    {
        $values = [];
        $values['title'] = $this->filterString($model->name);
        $values['name'] = $this->filterString($model->name);
        $values['short_description'] = $this->filterString($model->short_description);
        $values['skills'] = $this->filterString($model->skills);
        $values['headquarters_name'] = $this->filterString($model->headquarters_name);
        $values['address'] = $this->filterString($model->address);
        $values['public_hours'] = $this->filterString($model->public_hours);
        $values['cap'] = $this->filterString($model->cap);
        $values['telephone_reference'] = $this->filterString($model->telephone_reference);
        $values['mail_reference'] = $this->filterString($model->mail_reference);
        $values['pec_reference'] = $this->filterString($model->pec_reference);
        $values['further_information'] = $this->filterString($model->further_information);
        $values['help_box'] = $this->filterString($model->help_box);
        
        $values['start_publication'] =  date("c",strtotime(self::MIN_DATE));
        $values['end_publication'] =  date("c",strtotime(self::MAX_DATE));
        
        $president = $model->agidPersonPresident;
        if(!is_null($president))
        {
            $values['president'] = $president->getNameSurname();
        }
        else
        {
            $values['president'] = '';
        }
        $vicepresident = $model->agidPersonVicePresident;
        if(!is_null($vicepresident))
        {
            $values['vicepresident'] = $vicepresident->getNameSurname();
        }
        else
        {
            $values['vicepresident'] = '';
        }
        $values['tags'] = $this->getTags($model);
        $content = $model->agidOrganizationalUnitContentType;
        $type = $model->agidOrganizationalUnitType;
        $values['content_type'] = sprintf("'%s'",(is_null($content) ? '' : str_replace(' ', '_',$content->name)) . "','" . (is_null($type) ? '' : str_replace(' ', '_',$type->name)));
        $values['public'] = ( $model->status ==  AgidOrganizationalUnit::AGID_ORGANIZATIONAL_UNIT_WORKFLOW_STATUS_VALIDATED ? "1" : "0");
        return $values;
    }
}
