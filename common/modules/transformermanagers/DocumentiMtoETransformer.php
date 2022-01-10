<?php
namespace common\modules\transformermanagers;

use open20\amos\documenti\AmosDocumenti;
use open20\amos\documenti\models\Documenti;
use open20\amos\documenti\models\DocumentiCategorie;
use open20\elasticsearch\transformer\modeltransformers\BaseModelToElasticTransformer;
use Yii;


class DocumentiMtoETransformer extends BaseModelToElasticTransformer
{
    /* @var $model Documenti */
    public function transform($model) 
    {
        $category = $model->documentiCategorie;
        if(is_null($category))
        {
            $category = new DocumentiCategorie();
        }
        $values = [];
        $values['title'] = $this->filterString($model->titolo) . " " . $this->filterString($model->sottotitolo);
        $values['titolo'] = $this->filterString($model->titolo);
        $values['sottotitolo'] = $this->filterString($model->sottotitolo);
        $values['descrizione'] = $this->filterString($model->descrizione);
        $values['descrizione_breve'] = $this->filterString($model->descrizione_breve);
        $values['object'] = $this->filterString($model->object);
        $values['extended_description'] = $this->filterString($model->extended_description); 
        $values['distribution_proscription'] = $this->filterString($model->distribution_proscription); 
        $values['dates_and_intermediate_stages'] = $this->filterString($model->dates_and_intermediate_stages); 
        $values['further_information'] = $this->filterString($model->further_information);
        $values['regulatory_requirements'] = $this->filterString($model->regulatory_requirements); 
        $values['protocol'] = $this->filterString($model->protocol);
        $values['protocol_date'] = $this->filterString($model->protocol_date); 
        $values['help_box'] = $this->filterString($model->help_box);
        $values['author'] = $this->filterString($model->author);
        $values['start_publication'] =  date("c",strtotime($model->data_pubblicazione));
        $values['end_publication'] =  date("c",strtotime($model->data_rimozione));
        
        $values['categoria_titolo'] = $this->filterString($category->titolo);
        $values['categoria_sottotitolo'] = $this->filterString($category->sottotitolo);
        $values['categoria_descrizione'] = $this->filterString($category->descrizione);
        $values['categoria_descrizione_breve'] = $this->filterString($category->descrizione_breve);
        
        
        $values['tags'] = $this->getTags($model);
        $content = $model->documentiAgidContentType;
        $type = $model->documentiAgidType;
        $values['content_type'] = sprintf("'%s'",(is_null($content) ? '' : str_replace(' ', '_',$content->name)) . "','" . (is_null($type) ? '' : str_replace(' ', '_',$type->name)));
        $values['public'] = ( $model->status == Documenti::DOCUMENTI_WORKFLOW_STATUS_VALIDATO ? "1" : "0");
        return $values;
    }
    
    /**
     * 
     * @param Documenti $model
     */
    public function canSaveIndex($model)
    {
        $ret = true;
        $documentsModule = Yii::$app->getModule(AmosDocumenti::getModuleName());
        if ($documentsModule->enableDocumentVersioning) 
        {
            if (!is_null($model->version_parent_id))
            {
                $ret = false;
            }
        }
        if($model->is_folder)
        {
            $ret = false;
        }
        return $ret;
    }
}
