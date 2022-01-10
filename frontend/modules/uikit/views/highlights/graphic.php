<?php
use open20\design\utility\DateUtility;
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$moduleBckObj = Yii::$app->getModule('backendobjects');
$cls = $item->className();
$detailUrl=Yii::$app->getModule('backendobjects')::getDetachUrl($item->id,$cls, $moduleBckObj->modelsDetailMapping[$cls]);

switch (trim($item->classname())) {
    case 'open20\amos\news\models\News': //ok
    
        if (!is_null($item->newsImage)) {
            $imageUrl = $item->newsImage->getUrl('dashboard_news', false, true);
        }
        $date=$item->date_news;
        $category='Notizie';
        $title=$item->title;
        $description=$item->descrizione_breve;
        $icon='newspaper-variant-multiple';
        
    break;

    case 'open20\agid\organizationalunit\models\AgidOrganizationalUnit': //ok
        $title= $item->name;
        $icon='bank-outline';
        $category=$item->agidOrganizationalUnitContentType->name;
        $description=$item->short_description;
        
    break;
    
    case 'open20\amos\documenti\models\Documenti': //ok
        $title= $item->titolo;
        $icon='file-document-outline';
        $category=$item->documentiAgidContentType->name;
        $description=$item->descrizione_breve;
      
    break;
  
    case 'open20\agid\service\models\AgidService': //ok
        $title=$item->name;
        $description=$item->description;
        $icon='cog';
        $category='Servizi';
        
    break;
    
    case 'open20\amos\events\models\Event': //ok
        $title=$item->title;
        $description=$item->description;
        $icon='calendar';
        $category='Evento';
        $date=$item->begin_date_hour;
        if (!is_null($item->eventLogo)) {
            $imageUrl = $item->eventLogo->getUrl('dashboard_news', false, true);
        }
    
    break;  

    case 'open20\agid\person\models\AgidPerson': //ok
        if($model->agid_person_type_id==1){
            $categoryIcon= 'account-tie';
        }else{
          
            if($model->agid_person_type_id==2){
              
                $categoryIcon= 'card-account-details-outline';
                $organizzazione=$model->getAgidOrganizationalUnit();
                
               
                $name= [];
                $link= [];
                $refArea=[];
                foreach ($organizzazione as $org) :
                  array_push($name, $org->name);
                  
                  $areaModel= $org;
                  $cls = $areaModel->className();
                 
                  $linkToUse=Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls, $moduleBckObj->modelsDetailMapping[$cls]);
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
                  array_push($name2, $resp->agidOrganizationalUnit->name);
                  
                  $areaModel= $resp->agidOrganizationalUnit;
                  $cls2 = $areaModel->className();
                  //array_push($link2, Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls2, $moduleBckObj->modelsDetailMapping[$cls2]));
                  $linkToUse2=Yii::$app->getModule('backendobjects')::getDetachUrl($areaModel->id,$cls2, $moduleBckObj->modelsDetailMapping[$cls2]);
    
                  $refArea2[$resp->agidOrganizationalUnit->name]=$linkToUse2;
    
    
                 
                endforeach; 
    
                
                
               
    
                
                $result = array_merge($refArea2, $refArea);
                
                
                
                
                
    
            }
        }
        $title=$item->name .' ' .$item->surname;
        $description='';
        $icon='card-account-details-outline';
        $category='Persona';
        $email= $item->email;
        $telefono= $item->telephone;
        $refArea= $result;
    break;  

}
?>

<?php if($i%4==0 || $i%4==1 || ($i%4==2 && $dataProvider->getCount()==$i+1 )): ?><!--primo template card lunghe-->
   
   <div class="container-news d-flex h-100">
       <div class="card-wrapper shadow w-100">
           <div class="card card-img d-flex flex-column ">
                <?php if($imageUrl): ?>
                   <div class="image-wrapper position-relative w-100">
                       <div class="h-100 majory-news-card-image-wrapper">
                            <a href="<?= $detailUrl ?>" title="<?=$title?>" class="el-link">
                                <img src="<?= $imageUrl ?>" class="el-image" alt="Immagine di <?= $title ?>">
                            </a>
                            <?php if($date): ?>
                                <div class="card-calendar position-absolute rounded-0">
                                    <div class="card-day font-weight-bold text-600 lead uk-margin">
                                        <!--< ?= gmdate("d", $date ) ?>--><?=DateUtility::getDate($date, 'php:d')?>
                                    </div>
                                    <div class="card-month font-weight-bold text-600 small text-uppercase">
                                        <!--< ?= gmdate("M", $date ) ?>--><?= DateUtility::getDate($date, 'php:M');?>

                                    </div>
                                    <div class="card-year font-weight-light text-600 small ">
                                        <!--< ?= gmdate("Y", $date ) ?>--><?=DateUtility::getDate($date, 'php:Y');?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            
                       </div>
                   </div>
                <?php else: ?>
                    <div class="categoria-box-card px-4 p pt-3 b-2 d-flex align-items-center">
                        <!--icon material-->
                        <svg class="icon icon-padded rounded-circle icon-white bg-primary d-flex  mr-1" role="img">
                                    <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#<?= $icon ?>"></use>
                            </svg> 
                        
                        <p class="title-category font-weight-bold text-uppercase primary-color mb-0"><?=  $category ?></p>
                    </div>
                <?php endif; ?>
               
               <div class="card-body flex-grow-1 d-flex flex-column">
                   <div class="h5 card-title mb-0 d-none d-xl-block link-list-title">
                       <a href="<?= $detailUrl?>" title="Vai alla pagina <?= $title  ?>">
                           <?= $title ?>
                       </a>
                   </div>
                   <div class="text-serif py-3 flex-grow-1 uk-margin">
                       <?= $description ?>
                        <?php if($email){ ?>
                            <div > 
                                <strong>Email:</strong><?= $email ?> 
                            </div>
                        <?php } ?>

                        <?php if($telefono){ ?>
                            <div> 
                                <strong>Telefono:</strong><?= $telefono ?> 
                            </div>
                        <?php } ?>

                        <?php if($refArea){ ?>
                            <div>
                                <p>
                                    <strong>Area di riferimento:</strong>
                                    
                                    <?php 
                                    $i=0;
                                    foreach ($refArea as $key => $value) : ?>
                                                <!--< ?php print_r($value); ?>-->
                                                
                    
                                                <a href="<?=$value?>" title="Vai alla pagina <?= $key?>">
                                                    <?= $key?> 
                                                </a>
                                                <?php if($i<count($refArea)-1){ ?>
                                                , 
                                                <?php } ?>
                                    <?php 
                                    $i++;
                                    endforeach; ?>
                                </p>
                            </div>

                        <?php } ?>
                   </div>
                   <div >
                       <a class="read-more flex-grow-1 align-items-end" title="Vai alla pagina <?=$title?>" href="<?=$detailUrl?>">
                       Leggi di più →
                       </a>
                   </div>
               </div>
           </div>
       </div>
   </div>
<?php else: ?><!--secondo template card su 2 righe-->
   
   <div class="box-card bg-white shadow-lg flex-grow-1 <?=  ($i%2==0 && $dataProvider->getCount()>$i+1)? 'mb-3' : '' ?>">
       <div class="py-3 h-100 d-flex flex-column">
           <div class="categoria-box-card px-4 pb-2 d-flex align-items-center">
              
               <!--icon material-->
               <svg class="icon icon-padded rounded-circle icon-white bg-primary d-flex  mr-1" role="img">
                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#<?= $icon ?>"></use>
                </svg> 
               
               <p class="title-category font-weight-bold text-uppercase primary-color"><?=  $category ?></p>
           </div>
           <div class="px-4 flex-grow-1">
                   <div class="h5 card-title mb-0 link-list-title uk-margin">
                       <a href="<?=$detailUrl?>" target="_blank"  title="Vai alla pagina <?=$item ['title']?>"><?= $title ?></a>
                   </div>
                   <div class="text-serif">
                       <?= $description?>
                   </div>
                    <?php if($email){ ?>
                        <div > 
                            <strong>Email:</strong><?= $email ?> 
                        </div>
                    <?php } ?>

                    <?php if($telefono){ ?>
                        <div> 
                            <strong>Telefono:</strong><?= $telefono ?> 
                        </div>
                    <?php } ?>

                    <?php if($refArea){ ?>
                        <div>
                            <p>
                                <strong>Area di riferimento:</strong>
                                
                                <?php 
                                $i=0;
                                foreach ($refArea as $key => $value) : ?>
                                            <!--< ?php print_r($value); ?>-->
                                            
                
                                            <a href="<?=$value?>" title="Vai alla pagina <?= $key?>">
                                                <?= $key?> 
                                            </a>
                                            <?php if($i<count($refArea)-1){ ?>
                                            , 
                                            <?php } ?>
                                <?php 
                                $i++;
                                endforeach; ?>
                            </p>
                        </div>

                    <?php } ?>

           </div>
           <div class="cta-box-card  px-4 py-3">
                   <a href="<?=$detailUrl?>" target="_blank" title="<?=$title?>" class="read-more flex-grow-1 align-items-end"> Leggi di più →</a>
           </div>
       </div>
   </div>
<?php endif; ?>

