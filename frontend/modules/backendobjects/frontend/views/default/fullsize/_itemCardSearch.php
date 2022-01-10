<?php

use app\modules\backendobjects\frontend\Module;
use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\amos\news\models\News;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$route = "#";
$cls = $model->classname();
$module = Module::getInstance();

$realModel = $cls::findOne($model->id);
if (!is_null($realModel)) {
    $route = Yii::$app->getModule('backendobjects')::getDetachUrl($realModel->id,$cls, $module->modelsDetailMapping[$cls]);
}


if($model->classname()=='open20\amos\news\models\News'){
    $news=News::findOne($model->id);
    $title=$news->titolo;
    
    $description=$news->descrizione_breve;
    $icon='newspaper';
    $category='Notizia';
}else{
    if($model->classname()=='open20\amos\events\models\Event'){
        $title=$model->title;
        // $description=$model->description;
        $description = $model->agid_description;
        $icon='calendar';
        $category='Evento';
    }else{

        switch (trim($model->classname())) {
    
            case "open20\agid\organizationalunit\models\AgidOrganizationalUnit":
                $title= $model->name;
                $description=$model->short_description;
                $icon='bank-outline';
                $category='Unità organizzativa';
        
                break;
            case "open20\amos\documenti\models\Documenti":
                $title=$model->titolo;
                $description=$model->descrizione_breve;
                $icon='file-document-outline';
                $category='Documenti';
                break;
            case "open20\agid\service\models\AgidService":
                $title=$model->name;
                $description=$model->description;
                $icon='cog';
                $category='Servizi';
              
                break;
            
            case "open20\agid\person\models\AgidPerson":
                $title=$model->name .' ' .$model->surname;
                $description='';
                $icon='card-account-details-outline';
                $category='Persona';
        
                
                break;  
       
         
        
        }
    }



}





?>


<?=

$this->render(
        '@vendor/open20/design/src/components/agid/views/agid-item-search-result',
        [
            'columnWidth' => 'col-lg-4 col-md-6 col-sm-12 d-flex',
            'icon' => $icon,
            'category' => $category,//end(explode('_',$model->content_type)),
            'cardTitle' => $title,
            'cardDescription' => $description,
            'cardLink' => $route,
            'iconClass' => 'icon-sm icon-primary',
            'categoryClass' => 'text-decoration-none',
            'titleClass' => 'text-decoration-none',
        ]
);
?>