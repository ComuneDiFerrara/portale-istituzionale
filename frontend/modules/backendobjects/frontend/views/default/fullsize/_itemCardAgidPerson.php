<?php
use yii\helpers\ArrayHelper;
use open20\design\assets\BootstrapItaliaDesignAsset;
use app\modules\backendobjects\frontend\Module;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

//use open20\amos\documenti\models\Documenti;
?>


<!--impostazione icona a seconda categoria-->
<?php
  $contentType=$model->agidPersonContentType;
  if(!is_null($contentType) && !empty($contentType->content_type_icon)){
    $categoryIcon=$contentType->content_type_icon;
  }else{
      $categoryIcon= 'account-multiple';
  }
  
   
      
        if($model->agid_person_type_id==2){
          
           
            $organizzazione=$model->getAgidOrganizationalUnit();
            
           
            $name= [];
            $link= [];
            $refArea=[];
            foreach ($organizzazione as $org) :
              $module = Module::getInstance();
              array_push($name, trim($org->name));
              
              $areaModel= $org;
              $cls = $areaModel->className();
             
              $linkToUse=Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls, $module->modelsDetailMapping[$cls]);
              //echo($linkToUse);
              array_push($link, $linkToUse);
              $refArea[$org->name]=$linkToUse;

            endforeach; 
          

            //$refArea = array_fill_keys($name, $link);            


            $responsabile= $model->agidPersonOrganizationalUnitMmsManager; 
            $name2= [];
            $link2= [];
            $refArea2=[];
            
            foreach ($responsabile as $resp) :
              $module2 = Module::getInstance();
              array_push($name2, trim($resp->agidOrganizationalUnit->name));
              
              $areaModel= $resp->agidOrganizationalUnit;
              $cls2 = $areaModel->className();
              //array_push($link2, Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls2, $module2->modelsDetailMapping[$cls2]));
              $linkToUse2=Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls2, $module2->modelsDetailMapping[$cls2]);

              $refArea2[$resp->agidOrganizationalUnit->name]=$linkToUse2;


             
            endforeach; 

            
            
           

            
            $result = array_merge($refArea2, $refArea);
            
            
            
            
            

        }
    
    
?>

<?php 
    if( $detailPage ){
        $route = Yii::$app->getModule('backendobjects')::getSeoUrl($model->getPrettyUrl(), $blockItemId);
    }
    $titleCard=$model->name .' ' .$model->surname;
    if( $model->email ){
      $email= ' '. $model->email;
    }
    if( $model->telephone ){
      $telephone= ' '. $model->telephone;
    }
?>

<?=
  $this->render(
    '@vendor/open20/design/src/components/agid/views/agid-card-person',
    [
      'categoryIcon' => $categoryIcon,
      'categoryName' => $model->agidPersonType->name,
      'cardTitle' => $titleCard,
      'email'=> $email,
      'telefono'=> $telephone,
      'refArea'=> $result,
      'urlDetail' =>$route,
      'additionalCssExternalClass' => 'box-card mb-4',
      'columnWidth' => 'col-md-4 col-xs-12',
      'tags'=> $model->agidPersonType->name,
      'unita_organizzative' => $unita_organizzative

    ]
  );
?>
