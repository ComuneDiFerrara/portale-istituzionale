<?php
namespace common\modules\transformermanagers;

use open20\amos\news\models\News;
use open20\amos\news\models\NewsCategorie;
use open20\elasticsearch\transformer\modeltransformers\BaseModelToElasticTransformer;

class NewsMtoETransformer  extends BaseModelToElasticTransformer 
{

    /* @var $model News */
    public function transform($model) 
    {
        $category = $model->newsCategorie;
        if(is_null($category))
        {
            $category = new NewsCategorie();
        }
        $values = [];
        $values['title'] = $this->filterString($model->titolo);
        $values['titolo'] = $this->filterString($model->titolo);
        $values['descrizione'] = $this->filterString($model->descrizione);
        $values['descrizione_breve'] = $this->filterString($model->descrizione_breve);
        $values['categoria_titolo'] = $this->filterString($category->titolo);
        $values['categoria_descrizione'] = $this->filterString($category->descrizione);
        $values['start_publication'] =  date("c",strtotime($model->data_pubblicazione));
        $values['end_publication'] =  date("c",strtotime($model->data_rimozione));
        $values['tags'] = $this->getTags($model);
        $content = $model->newsContentType;
        $values['content_type'] = (is_null($content) ? '' : "'". str_replace(' ', '_',$content->name)) . "'";
        $values['public'] = ( $model->status == News::NEWS_WORKFLOW_STATUS_VALIDATO ? "1" : "0");
        return $values;
    }
   
}
