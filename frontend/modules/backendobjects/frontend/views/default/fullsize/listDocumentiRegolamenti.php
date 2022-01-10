<?php

use yii\widgets\ListView;
?>

<?php
$modelLabel = strtolower($model->getGrammar()->getModelLabel());



use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$cssClass= 'uk-container';
$tags = \open20\amos\tag\models\Tag::find()->orderby(['nome' => SORT_ASC])->all();
$tagFilter=array();//array con primi due tag
$tagInModal=array();//da secondo in poi
array_push($tagFilter, $tags[0], $tags[1], $tags[2]);
$tagInModal=array_slice($tags, 3);

?>

<script>
    window.addEventListener("load", function(event) {
        if(document.getElementById("no-content-doc")){
            
            var content=document.getElementsByClassName("documenti-argomenti-block")[0];
            content.style.display = "none"; 
           
        }
        var bottoneFiltro=document.getElementById(filtroAttivo);
        bottoneFiltro.classList.toggle("active-filter");
        bottoneFiltro.classList.toggle("active");
       
    });


    
    function resetFilterTagInModal(){
        var activeArgoument=$("#filter-container .form-check input:checked");
        
        var activeArgoumentLen = activeArgoument.length;
        
        for (j = 0; j < activeArgoumentLen; j++) {
            var originalString=activeArgoument[j].id;        
            var newString=(originalString).toLowerCase();
            newString=newString.replace(/ /g,"_");
            resetFilterTag(newString);
        }
        
    };

    function onlyOne(){
        $('#filter-container .form-check input').click(function() {
       
        $('#filter-container .form-check input').not(this).prop('checked', false);
        });
    };

   


    

    

    function resetFilterTag(filtroAttivo){
        
        filtroAttivo=filtroAttivo.replace(/ /g,"_");
      
        var otherButtonToDeactive=document.getElementsByClassName("tag-filter");
        for ($i=0; $i<otherButtonToDeactive.length; $i++){
            if(otherButtonToDeactive[$i].id.toLowerCase()==filtroAttivo){
                otherButtonToDeactive[$i].classList.add("active");
                otherButtonToDeactive[$i].classList.add("active-filter");
            }else{
                otherButtonToDeactive[$i].classList.remove("active");
                otherButtonToDeactive[$i].classList.remove("active-filter");
            }
            
        }
       
        
         if(filtroAttivo=='filtro-tutto'){
            
           
            var cardToDisplay=document.getElementsByClassName("agid-generic-card-container ");
            for($i=0;$i<cardToDisplay.length;$i++){
                cardToDisplay[$i].style.display='block';

            }
        }
        
        else{
            var cardToDisplay=document.getElementsByClassName("agid-generic-card-container ");
            for($i=0;$i<cardToDisplay.length;$i++){
                
                cardToDisplay[$i].style.display='none';
                
                if(cardToDisplay[$i].getAttribute('filter') && cardToDisplay[$i].getAttribute('filter').includes(filtroAttivo)){
                    cardToDisplay[$i].style.display='block';

                }else{
                    cardToDisplay[$i].style.display='none';
                }
                
            }

        }

      


    };


  

</script>


    <?php /*
    <!--parte filtri-->
    <div id="filtri-ricerca-reg" class="d-flex flex-column flex-md-row justify-content-between pb-2 border-bottom">
        <p class="h3">Tutti i regolamenti</p>
        
        <div class="tag-filtri-container d-flex flex-wrap">
            <div class="ml-2 mb-2 d-inline">    
                <button id="filtro-tutto-regolamenti" class="active active-filter tag-filter btn btn-icon btn-outline-primary btn-sm align-top" onclick="resetFilterTag('filtro-tutto')">
                    <span>Tutto</span>
                </button>
            </div>

            <?php foreach($tagFilter as $filter){ ?>
                <div class="ml-2 mb-2 d-inline">
                    <button id="filtro-<?=str_replace(' ', '_', strtolower($filter->nome)) ?>-regolamenti" class=" tag-filter btn btn-icon btn-outline-primary btn-sm align-top" onclick="resetFilterTag('filtro-<?= $filter->nome?>'.toLowerCase())">   
                        <span><?= $filter->nome ?></span>
                    </button>
                </div>
            <?php } ?>

            <!--<div id="filtro-titolo" class="d-none ml-2">    
                <button id="filtro-titolo" class="active active-filter tag-filter-special btn btn-icon btn-outline-primary btn-sm align-top" onclick="resetFilterTag('filtro-tutto')">
                    <span>Titolo:</span>
                </button>
            </div>-->

            <div class="ml-2 mb-2 d-inline">
                <button  id="more-tag-regolamenti" type="button"  class="btn btn-icon btn-outline-primary btn-sm align-top h-100" data-toggle="modal" data-target="#more-option-filter-modal" onclick="onlyOne()">
                    <svg class="icon d-flex icon-primary  mr-1" role="img">
                        <use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#dots-horizontal"></use>
                    </svg>
                    
                </button>
            </div>
        </div>
    </div>
    */
    ?>



    <div id="modulo-backend-regolamenti" class="modulo-backend-<?= $modelLabel ?> <?= $cssClass ?> pt-4">
        
        <div class="card-<?= $modelLabel ?>-container">
            <?php
            if ($dataProvider->getTotalCount() > 0) {
                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_itemCardDocumenti',
                    'viewParams' => [
                        'detailPage' => $detailPage,
                        'viewFields' => $viewFields,
                        'blockItemId' => $blockItemId,
                    ],
                    //'layout' => "<div class='summary-design'>{summary}</div>\n<div class='list-view-design row'>{items}</div>\n<div class='pagination-design'>{pager}</div>",
                    'summary' => '',
                    'itemOptions' => [
                        'tag' => false
                    ],
                    'options' => [
                        'class' => 'list-view w-100 d-flex flex-wrap'
                    ]
                    
                ]);
            }else{ ?>
            <div id="no-content-doc" class="no-result">
            <div id="no-content-doc" class="no-result">
                    <p >Non sono presenti contenuti</p>
                    
                </div>
            <?php } ?>
        </div>
    </div>















<!--modale per filtri-->
<!--modale more-option-->
<!-- Large modal -->

<div id="more-option-filter-modal" class="modal fade more-option-filter-modal  h-100" tabindex="-1" role="dialog" aria-label="myLargeModalLabel" aria-hidden="true">
    <div class="modale-fullscreen-ricerca modal-dialog h-100 mw-100 w-100 m-0">
        <div class="modal-content h-100" style="overflow-y:scroll;">
            <div class="modal-header d-flex align-items-center justify-content-between uk-container">
                <div class="d-flex">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <svg class="icon icon-primary mr-1 mr-sm-5" role="img" >
                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#arrow-left"></use>
                        </svg>
                    </button>
                    <h2 class="h1">Filtri</h2>
                </div>
                <button class="btn btn-primary" type="button" data-dismiss="modal" aria-label="Close" onclick="resetFilterTagInModal()">
                    Conferma
                </button>
                
                            
            </div>
            <div id="filter-container" class="modal-body uk-container">
                <div class="form-group mt-5" >
                        <!--<form class="position-relative">
                            <input id="ricerca-testuale-modal" type="search" class="bg-100 rounded border-bottom-0" onkeypress="onEnter()">
                            <label for="ricerca-testuale-modal" style="width: auto;" class="font-weight-normal">Cerca elenco nella modulistica</label>
                            <button id="search-button"  type="button" data-dismiss="modal" class="autocomplete-icon h-100 bg-primary rounded-right d-flex align-items-center" style="top:0; "onclick="setTextFilter()">
                                <svg class="icon d-flex  mr-1 icon-white" role="img" >
                                <use xlink:href="< ?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#magnify"></use>
                                </svg>
                            </button>
                        </form>-->
                </div>
                    
                        
                    <div class="advanced-subnav right-subnav">
                        <div class="always-show-menu link-list-wrapper">
                          
                              <div class="mt-5"> 
                                    <?php
                                        
                                        $u = 0;
                                        $showTag = true;
                                        foreach($tagInModal as $tag)
                                        {
                                            if($u++ == 15)
                                            {
                                    ?>
                               </div>
                          
                        </div>
                        <div class="link-list-wrapper">
                            <div class="link-list collapse mb-0" id="altri-arg-regolamenti">
                                <div >
                                   <?php } if($showTag) { ?>
                                           
                                            <!--checkbox per argomenti-->
                                            <?=

                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => $tag->nome,
                                                        'inputId' => 'filtro-'.str_replace(" ", "_", $tag->nome),
                                                        'name' => 'TAG_' . $tag->id,
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('TAG_' . $tag->id)
                                                    ]
                                                );
                                            ?>
                                    
                                    <?php
                                            }else{
                                    ?>
                                        
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => $tag->nome,
                                                        'inputId' =>'filtro-'.str_replace(" ", "_", $tag->nome),
                                                        'name' => 'TAG_' . $tag->id,
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('TAG_' . $tag->id)
                                                    ]
                                                );
                                            ?>
                                    
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>             
                            </div>
                        </div>
                        <p class="espandi-voci mt-4 ">
                                <a href="#altri-arg-regolamenti" id="menu-lista-button" role="button" aria-expanded="false" aria-controls="altri-arg-regolamenti" data-toggle="collapse" class="collapsed link-altre-voci d-flex align-items-center text-decoration-none">
                                    <span class="menu-lista-apri font-weight-bold" title="Espandi">Mostra tutto</span>
                                    <span class="menu-lista-riduci font-weight-bold" title="Riduci">Mostra meno</span>
                                </a>
                        </p>
                    </div>
                    
              
        
            </div>
        </div>
      
    


    </div>  
    
</div>

