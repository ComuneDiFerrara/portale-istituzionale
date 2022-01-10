
<?php
use yii\widgets\ListView;
use yii\web\View;
use open20\design\assets\BootstrapItaliaDesignAsset;
use luya\helpers\Url;
use yii\widgets\ActiveForm;


$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$currentUrl=Url::current();
$pos = strpos($currentUrl, '%2F');
$currentPage=str_replace('%2C',',',str_replace('%C3%A0','à',substr($currentUrl, $pos+3)));
parse_str($currentUrl, $output);
$currentPageUpper=str_replace('-', ' ', ucwords(substr($output['path'], (strpos($output['path'], '/'))+1)));
if($currentPageUpper=='News'){
    $currentPageUpper='Notizie';
}

$js = <<<JS
    jQuery("#ricerca-testuale").on("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
        document.getElementById("search-button").click();
    }
});
JS;

$this->registerJs($js);
?>

<script>

    function onLoadToActive(){
        var filterToActive=document.getElementById("filtro-categoria").getElementsByTagName("span")[0];
        filterToActive=(filterToActive.textContent.replaceAll(" ","_")).replaceAll(",","");
       
        var inputToCheck=$("#"+filterToActive);
       
        inputToCheck.prop('checked', true);
       
      
    };


    function deleteFilter(name) {
       
       var inputToChangeCategTag=$("#"+name.id);
       inputToChangeCategTag.prop('checked', false);
       setActiveChipsInModal();
       
    };
   
    function setActiveChipsInModal() {
       
        if(document.getElementsByClassName("active-filter")[0]){
            var actualFilter =document.getElementsByClassName("active-filter")[0].textContent;
            actualFilter=((actualFilter.replace(/ /g,"")).replace(/[\r\n]+/g," ")).replace(/ /g,"");
        }
        
        var totFilterCateg=$("#container-categoria .form-check input").length;
        var activeFilterCateg=$("#container-categoria .form-check input:checked").length;

        var totFilterArg=$("#tab2 .form-check input").length;
        var activeFilterArg=$("#tab2 .form-check input:checked").length;

        
        if(!(document.getElementsByClassName("active-filter")[0]) || (actualFilter!='Tutto') || (actualFilter=='Tutto' && (activeFilterCateg<totFilterCateg || activeFilterArg<totFilterArg))){
                
                var totFilter=$("#container-categoria .form-check input");
                var activeFilter=$("#container-categoria .form-check input:checked");
                var activeFilterLen = activeFilter.length;
                var activeFilterCat='';

                for (i = 0; i < activeFilterLen; i++) {
                    var originalString=activeFilter[i].id.replaceAll("_", " ");      
                    activeFilterCat=activeFilterCat.concat(originalString);   
                }

                var activeArgoument=$("#tab2 .form-check input:checked");
                var activeArgoumentLen = activeArgoument.length;
                var activeFilterArg='';

                for (j = 0; j < activeArgoumentLen; j++) {
                    var originalString=activeArgoument[j].id.replaceAll("_", " ");        
                    activeFilterArg=activeFilterArg.concat(originalString);   
                }

                var currentPageFilter= document.getElementsByClassName("current-page-filter")[0];
                

                if(totFilter.length>activeFilterLen){
                    currentPageFilter.classList.remove("d-inline");
                    currentPageFilter.classList.add("d-none");
                    currentPageFilter.getElementsByTagName("button")[0].classList.remove("active-filter");
                    currentPageFilter.getElementsByTagName("button")[0].classList.remove("active");

                }else{
                    currentPageFilter.classList.remove("d-none");
                    currentPageFilter.classList.add("d-inline");   
                    currentPageFilter.getElementsByTagName("button")[0].classList.add("active-filter");
                    currentPageFilter.getElementsByTagName("button")[0].classList.add("active");

                
                }

                
                var filterExternalContainer=document.getElementsByClassName("categorie-src")[0];
                var filterContainer=document.getElementsByClassName("modal-filter-to-inject")[0];
        
                var htmlToInject='';
                for (i = 0; i < activeFilterLen; i++) {
                    var alreadyExsist=document.getElementById("filtro-"+activeFilter[i].id);
                    var stringToPass=(activeFilter[i].id).toString();
                    htmlToInject=htmlToInject+'<div class="ml-2 mb-2 d-inline other-filter"> <button id="filtro-'+activeFilter[i].id+'" class="active btn btn-icon btn-outline-primary btn-sm align-top active-filter"> <span class="d-flex align-items-center pr-4 position-relative">'+activeFilter[i].id.replaceAll("_", " ")+'<svg class="icon d-flex  icon-white position-absolute" style="right:0" role="img" onclick="deleteFilter('+stringToPass+')"><use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#close"></use></svg></span></button></div>';
             
                }
                for (j = 0; j < activeArgoumentLen; j++) {
                    var alreadyExsist=document.getElementById("filtro-"+activeArgoument[j].id);
                    var stringToPass=(activeArgoument[j].id).toString();
                    htmlToInject=htmlToInject+'<div class="ml-2 mb-2 d-inline other-filter-tag"> <button id="filtro-'+activeArgoument[j].id+'" class="active btn btn-icon btn-outline-primary btn-sm align-top active-filter"> <span class="d-flex align-items-center pr-4 position-relative">'+activeArgoument[j].id.replaceAll("_", " ")+'<svg class="icon d-flex  icon-white position-absolute" style="right:0" role="img" onclick="deleteFilter('+stringToPass+')"><use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#close"></use></svg></span></button></div>';
                 
                }
            
                filterContainer.innerHTML=htmlToInject; 
            

                var currentModalFilter=document.getElementsByClassName("other-filter");
                
                if(totFilter.length>activeFilterLen){
                    currentPageFilter.classList.remove("d-inline");
                    currentPageFilter.classList.add("d-none");
                    for (i = 0; i < currentModalFilter.length; i++) {
                        currentModalFilter[i].classList.remove("d-none");
                        currentModalFilter[i].classList.add("d-inline");
                        
                    
                    }
                

                }else{
                    
                    currentPageFilter.classList.remove("d-none");
                    currentPageFilter.classList.add("d-inline");   
                    for (i = 0; i < currentModalFilter.length; i++) {
                        
                        currentModalFilter[i].classList.remove("d-inline");
                        currentModalFilter[i].classList.add("d-none");
                    
                    }
                
                }


               
                var target = document.getElementsByClassName("current-page-filter")[0];
                var wrap = document.createElement('div');
                wrap.appendChild(target.cloneNode(true));
                filterExternalContainer.innerHTML='<div class="ml-2 mb-2 d-inline"> <button id="filtro-tutto" class="btn btn-icon btn-outline-primary btn-sm align-top" onclick="resetFilterTutto()"><span>Tutto</span></button></div>'+wrap.innerHTML+filterContainer.innerHTML+'<div class="modal-filter-to-inject d-flex"></div><div class="ml-2 mb-2 d-inline" style="order:2;"><button id="more-tag" type="button" class="btn btn-icon btn-outline-primary btn-sm align-top h-100" data-toggle="modal" data-target=".more-option-modal"><svg class="icon d-flex icon-primary  mr-1" role="img"><use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#dots-horizontal"></use></svg></button><div></div></div>'
             
        
        
        
        }
        
     
        if(!(document.getElementsByClassName("active-filter")[0]) && !(document.getElementsByClassName("other-filter")[0]) && !(document.getElementsByClassName("active-filter-tag")[0]) && (document.getElementsByClassName("current-page-filter")[0].classList.contains("d-none"))){
            resetFilterTutto();
        }

        

   
    };
        
    function setHref() {
        
            var actualFilter =document.getElementsByClassName("active-filter")[0].getElementsByTagName("span")[0].textContent;           
            actualFilter=((actualFilter.replace(/ /g,"_")).replace(/[\r\n]+/g," ")).replace(/ /g,"");

            if(actualFilter=='Tutto'){
                    var textToInject= document.getElementById("ricerca-testuale").value;
                    var hrefValue='/ricerca?searchtext=' + textToInject;
                    document.getElementById("search-button").href=hrefValue;
               
            }else{   
                var activeFilter=$("#container-categoria .form-check input:checked");
                var activeFilterLen = activeFilter.length;
                var activeFilterQuery='';
                for (i = 0; i < activeFilterLen; i++) {
                    var originalString=activeFilter[i].id;  
                    if(originalString.replace(/ /g,"_")=='Notizie'){
                        originalString='News';
                    }
                    if(originalString.replace(/ /g,"_")=='Personale_amministrativo'){
                        var newString='&CATEGORY_Amministrativa=on';
                    }else{
                        var newString='&CATEGORY_'+originalString.replace(/ /g,"_").replace(/\d+/g, '')+'=on';
                    }

                    activeFilterQuery=activeFilterQuery.concat(newString);   
                }
                var activeArgoument=$("#tab2 .form-check input:checked");
                var activeArgoumentLen = activeArgoument.length;
                for (j = 0; j < activeArgoumentLen; j++) {
                    var originalString=activeArgoument[j].name;   
                    originalString = originalString.replace(/ /g,"_");
                    originalString =  originalString.replace(",","%2C");
                    var newString='&'+ originalString +'=on';
                    activeFilterQuery=activeFilterQuery.concat(newString);   
                }

                var textToInject= document.getElementById("ricerca-testuale").value;
                var hrefValue='/ricerca?searchtext=' + textToInject + activeFilterQuery;
                document.getElementById("modal-confirm").href=hrefValue;
                document.getElementById("search-button").href=hrefValue;
            }  

    };

    function setHrefInModal() {
        var activeFilter=$("#container-categoria .form-check input:checked");
        var activeFilterLen = activeFilter.length;
        var activeFilterQuery='';
        for (i = 0; i < activeFilterLen; i++) {
            var originalString=activeFilter[i].id;        
            if(originalString=='Notizie'){
                originalString='News';
            }
            var newString='&CATEGORY_'+(originalString.replace(/ /g,"_")).replace(",","%2C").replace(/\d+/g, '')+'=on';
            activeFilterQuery=activeFilterQuery.concat(newString);   
        }
        var activeArgoument=$("#tab2 .form-check input:checked");
        var activeArgoumentLen = activeArgoument.length;
        for (j = 0; j < activeArgoumentLen; j++) {
            var originalString=activeArgoument[j].name;        
            var newString='&'+originalString.replace(/ /g,"_")+'=on';
            activeFilterQuery=activeFilterQuery.concat(newString);   
        }


        var textToInject= document.getElementById("ricerca-testuale").value;
        var hrefValue='/ricerca?searchtext=' + textToInject + activeFilterQuery;
        document.getElementById("modal-confirm").href=hrefValue;

    };


    function resetFilterTutto(){
        
        var bottoneFiltro=document.getElementById("filtro-tutto");
        bottoneFiltro.classList.toggle("active-filter");
        if(document.getElementById("filtro-modulistica")!=null){
            var otherButtonToDeactiveAmm=document.getElementById("filtro-modulistica");
            otherButtonToDeactiveAmm.classList.remove("active-filter");
        }

        if(document.getElementById("filtro-categoria")!=null){
            var otherButtonToDeactiveSer=document.getElementById("filtro-categoria");
            otherButtonToDeactiveSer.classList.remove("active-filter");
        }
        if(document.getElementById("filtro-novità")!=null){
            var otherButtonToDeactiveNov=document.getElementById("filtro-novità");
            otherButtonToDeactiveNov.classList.remove("active-filter");
        }
        if(document.getElementById("filtro-documenti")!=null){
            var otherButtonToDeactiveDoc=document.getElementById("filtro-documenti");
            otherButtonToDeactiveDoc.classList.remove("active-filter");
        }
        
        


    };


    function resetActualFilter(){
        var bottoneFiltroAll=document.getElementById("filtro-tutto");
        bottoneFiltroAll.classList.remove("active-filter");
        var bottoneFiltro=document.getElementById("filtro-categoria");
        bottoneFiltro.classList.toggle("active-filter");
        var inputTochange=$("#container-categoria .form-check input");
        if(bottoneFiltro.classList.contains("active-filter")){
            inputTochange.prop('checked', true);
        }else{
            inputTochange.prop('checked', false);
        }


    };

    function setCheckChild(id){
        var divCheckToChange=document.getElementById(id);
        var parentCheckbox=divCheckToChange.getElementsByClassName("check-parent")[0].getElementsByTagName("input")[0];
        var checkboxToChange=divCheckToChange.getElementsByClassName("check-child")[0].getElementsByTagName("input");
        var totCheckbox=checkboxToChange.length;
        var trueCheckbox=0;
      
        if(parentCheckbox.checked){
           
            for($i=0;$i<checkboxToChange.length;$i++){
              
                checkboxToChange[$i].checked=true;
            }
           
            
        }else{
           
            for($i=0;$i<checkboxToChange.length;$i++){
                
                checkboxToChange[$i].checked=false;
            }
          
        }
      
        

    };


    function setCheckParent(id){
        var divCheckToChange=document.getElementById(id);
        var parentCheckbox=divCheckToChange.getElementsByClassName("check-parent")[0].getElementsByTagName("input")[0];
        var checkboxToChange=divCheckToChange.getElementsByClassName("check-child")[0].getElementsByTagName("input");
        var totCheckbox=checkboxToChange.length;
        var trueCheckbox=0;
        for($i=0;$i<checkboxToChange.length;$i++){
            if(checkboxToChange[$i].checked==true){
                trueCheckbox++;
            }
        }
        if(!(trueCheckbox==0) && trueCheckbox<totCheckbox){
            parentCheckbox.checked=false;
        }
            
        

    };


</script>

<?php 
    $this->registerJs('onLoadToActive();', View::POS_READY);

?>


<div class="form-group mt-5" >
          <form >
            <input id="ricerca-testuale" type="search" class="bg-100 rounded border-bottom-0">
            <label for="ricerca-testuale" style="width: auto;" class="font-weight-normal">Cerca contenuti in
              "<?= $currentPageUpper ?>"</label>
            <a id="search-button" title="Cerca"  href="/" aria-hidden="true" class="autocomplete-icon h-100 bg-primary rounded-right " onclick="setHref()">
                <svg class="icon d-flex  mr-1 icon-white" role="img" >
                 <use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#magnify"></use>
                </svg>
            </a>
          </form>
</div>

<div id="filtri-ricerca">
    <p class="small">Filtri</p>
    <div class="categorie-src d-flex flex-wrap mt-4">
        <div class="ml-2 mb-2 d-inline">    
            <button id="filtro-tutto" class="btn btn-icon btn-outline-primary btn-sm align-top" onclick="resetFilterTutto()">
                <span>Tutto</span>
            </button>
        </div>

        
        <div class="ml-2 mb-2 d-inline current-page-filter">
            <button id="filtro-categoria" class="active active-filter btn btn-icon btn-outline-primary btn-sm align-top" onclick="resetActualFilter()">   
                <span><?= $currentPageUpper ?></span>
            </button>
        </div>
        <div class="modal-filter-to-inject d-flex">
            
        </div>
                      

        <div class="ml-2 mb-2 d-inline " style="order:2;">
            <button  id="more-tag" type="button"  class="btn btn-icon btn-outline-primary btn-sm align-top h-100" data-toggle="modal" data-target=".more-option-modal" >
                <svg class="icon d-flex icon-primary  mr-1" role="img">
                    <use xlink:href="<?=$bootstrapItaliaAsset->baseUrl?>/sprite/material-sprite.svg#dots-horizontal"></use>
                </svg>
                
            </button>
        </div>
        

    </div>
</div>
        











<!--modale more-option-->
<!-- Large modal -->

<div class="modal fade more-option-modal" tabindex="-1" role="dialog" aria-label="myLargeModalLabel" aria-hidden="true">
    <div class="modale-fullscreen-ricerca modal-dialog h-100 mw-100 w-100 m-0">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between uk-container">
                <div class="d-flex">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="setActiveChipsInModal()">
                        <svg class="icon icon-primary mr-1 mr-sm-5" role="img" >
                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#arrow-left"></use>
                        </svg>
                    </button>
                    <h2 class="h1">Filtri</h2>
                </div>
                <a class="btn btn-primary" id="modal-confirm" href="#" onclick="setHrefInModal()">
                    Conferma
                </a>

                            
            </div>
            <div class="modal-body uk-container">
                <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                    <li class="nav-item flex-grow-1 d-flex align-items-center justify-content-center">
                        <a class="nav-link active w-100" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Categorie</a>
                    </li>
                    <li class="nav-item flex-grow-1 d-flex align-items-center justify-content-center">
                        <a class="nav-link w-100" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Argomenti</a>
                    </li>  
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane p-4 fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                        <div id="container-categoria" class="advanced-subnav right-subnav">
                            <div class="always-show-menu link-list-wrapper">
                                <div class="uk-subnav ">
                                    <!--checkbox per amministrazione-->
                                    <div id="container-categoria-amministrazione" class="mt-5 container-categoria container-categoria-amministrazione">
                                        <div class="check-parent" onchange="setCheckChild('container-categoria-amministrazione')">
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Amministrazione',
                                                        'inputId' => 'Amministrazione',
                                                        'name' => 'CATEGORY_Amministrazione',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Amministrazione')

                                                    ]
                                                );
                                            ?>
                                        </div>
                                        <div class="check-child" onchange="setCheckParent('container-categoria-amministrazione')">
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Organi di governo',
                                                        'inputId' => 'Organi_di_governo',
                                                        'name' => 'CATEGORY_Organi_di_governo',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Organi_di_governo')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Aree amministrative',
                                                        'inputId' => 'Aree_amministrative',
                                                        'name' => 'CATEGORY_Aree_amministrative',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Aree_amministrative')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Uffici',
                                                        'inputId' => 'Uffici',
                                                        'name' => 'CATEGORY_Uffici',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Uffici')
                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Enti e fondazioni',
                                                        'inputId' => 'Enti_e_fondazioni',
                                                        'name' => 'CATEGORY_Enti_e_fondazioni',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Enti_e_fondazioni')
                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Personale amministrativo',
                                                        'inputId' => 'Personale_amministrativo',
                                                        'name' => 'CATEGORY_Personale_amministrativo',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Personale_amministrativo')
                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Politici',
                                                        'inputId' => 'Politica',
                                                        'name' => 'CATEGORY_Politica',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Politica')
                                                    ]
                                                );
                                            ?>
                                        </div>
                                     
                                    </div>

                                    <!--checkbox per servizi-->
                                    <div id="container-categoria-servizi" class="mt-5  container-categoria ">
                                        <div class="check-parent" onchange="setCheckChild('container-categoria-servizi')">
                                        
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Servizi',
                                                        'inputId' => 'Servizi',
                                                        'name' => 'CATEGORY_Servizi',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Servizi')
                                                    ]
                                                );
                                            ?>
                                        </div>
                                        <div class="check-child" onchange="setCheckParent('container-categoria-servizi')">

                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Ambiente',
                                                        'inputId' => 'Ambiente',
                                                        'name' => 'CATEGORY_Ambiente',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Ambiente')
                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Agricoltura',
                                                        'inputId' => 'Agricoltura',
                                                        'name' => 'CATEGORY_Agricoltura',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Agricoltura')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Anagrafe e stato civile',
                                                        'inputId' => 'Anagrafe_e_stato_civile',
                                                        'name' => 'CATEGORY_Anagrafe_e_stato_civile',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Anagrafe_e_stato_civile')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Appalti pubblici',
                                                        'inputId' => 'Appalti_pubblici',
                                                        'name' => 'CATEGORY_Appalti_pubblici',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Appalti_pubblici')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Autorizzazioni',
                                                        'inputId' => 'Autorizzazioni',
                                                        'name' => 'CATEGORY_Autorizzazioni',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Autorizzazioni')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Attività produttive e del commercio',
                                                        'inputId' => 'Attività_produttive_e_del_commercio',
                                                        'name' => 'CATEGORY_Attività_produttive_e_del_commercio',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Attività_produttive_e_del_commercio')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Urbanistica e edilizia',
                                                        'inputId' => 'Urbanistica_e_edilizia',
                                                        'name' => 'CATEGORY_Urbanistica_e_edilizia',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Urbanistica_e_edilizia')

                                                    ]
                                                );
                                            ?>
                                           
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Cultura, sport e tempo libero',
                                                        'inputId' => 'Cultura_sport_e_tempo_libero',
                                                        'name' => 'CATEGORY_Cultura,_sport_e_tempo_libero',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Cultura,_sport_e_tempo_libero')
                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Educazione e formazione',
                                                        'inputId' => 'Educazione_e_formazione',
                                                        'name' => 'CATEGORY_Educazione_e_formazione',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Educazione_e_formazione')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Giustizia e sicurezza',
                                                        'inputId' => 'Giustizia_e_sicurezza',
                                                        'name' => 'CATEGORY_Giustizia_e_sicurezza',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Giustizia_e_sicurezza')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Mobilità e trasporti',
                                                        'inputId' => 'Mobilità_e_trasporti',
                                                        'name' => 'CATEGORY_Mobilità_e_trasporti',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Mobilità_e_trasporti')
                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Salute, benessere e assistenza',
                                                        'inputId' => 'Salute_benessere_e_assistenza',
                                                        'name' => 'CATEGORY_Salute,_benessere_e_assistenza',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Salute,_benessere_e_assistenza')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Tributi e finanze',
                                                        'inputId' => 'Tributi_e_finanze',
                                                        'name' => 'CATEGORY_Tributi_e_finanze',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Tributi_e_finanze')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Turismo',
                                                        'inputId' => 'Turismo',
                                                        'name' => 'CATEGORY_Turismo',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Turismo')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Vita lavorativa',
                                                        'inputId' => 'Vita_lavorativa',
                                                        'name' => 'CATEGORY_Vita_lavorativa',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Vita_lavorativa')
                                                    ]
                                                );
                                            ?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="link-list-wrapper">
                                <div class="link-list collapse mb-0" id="altre-categ">
                                    
                                    <!--checkbox per novità-->
                                    <div id="container-categoria-novità"  class="mt-5  container-categoria container-categoria-novità">    
                                        <div class="check-parent" onchange="setCheckChild('container-categoria-novità')">
                                        
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Novità',
                                                        'inputId' => 'Novità',
                                                        'name' => 'CATEGORY_Novità',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Novità')
                                                    ]
                                                );
                                            ?>
                                        </div>
                                        <div class="check-child" onchange="setCheckParent('container-categoria-novità')">
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Notizie',
                                                        'inputId' => 'Notizie',
                                                        'name' => 'CATEGORY_News',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_News')
                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Avvisi',
                                                        'inputId' => 'Avvisi',
                                                        'name' => 'CATEGORY_Avvisi',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Avvisi')
                                                        
                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Eventi',
                                                        'inputId' => 'Eventi',
                                                        'name' => 'CATEGORY_Eventi',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Eventi')

                                                    ]
                                                );
                                            ?>
                                        </div>
                                       
                                    </div>

                                    <!--checkbox per documenti e dati-->
                                    <div id="container-categoria-documenti" class="mt-5  container-categoria container-categoria-documenti">    
                                        <div class="check-parent" onchange="setCheckChild('container-categoria-documenti')">
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Documenti e dati',
                                                        'inputId' => 'Documenti_e_dati',
                                                        'name' => 'CATEGORY_Documenti_e_dati',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Documenti_e_dati')

                                                    ]
                                                );
                                            ?>
                                        </div>
                                        <div class="check-child" onchange="setCheckParent('container-categoria-documenti')">
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Bandi',
                                                        'inputId' => 'Bandi',
                                                        'name' => 'CATEGORY_Bandi',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Bandi')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Curriculum Vitae',
                                                        'inputId' => 'Curriculum_vitae',
                                                        'name' => 'CATEGORY_Curriculum_vitae',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Bandi')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Atto di nomina',
                                                        'inputId' => 'Atto_di_nomina',
                                                        'name' => 'CATEGORY_Atto_di_nomina',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Bandi')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Modulistica',
                                                        'inputId' => 'Modulistica',
                                                        'name' => 'CATEGORY_Modulistica',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Modulistica')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Ordinanze',
                                                        'inputId' => 'Ordinanze',
                                                        'name' => 'CATEGORY_Ordinanze',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Ordinanze')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Atti normativi',
                                                        'inputId' => 'Atti_normativi',
                                                        'name' => 'CATEGORY_Atti_normativi',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Atti_normativi')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Documenti tecnici e di supporto',
                                                        'inputId' => 'Documenti_tecnici_e_di_supporto',
                                                        'name' => 'CATEGORY_Documenti_tecnici_e_di_supporto',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Documenti_tecnici_e_di_supporto')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Amministrazione trasparente',
                                                        'inputId' => 'Amministrazione_trasparente',
                                                        'name' => 'CATEGORY_Amministrazione_trasparente',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Documenti_tecnici_e_di_supporto')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Unità organizzative',
                                                        'inputId' => 'Unità_organizzative',
                                                        'name' => 'CATEGORY_Unità_organizzative',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Documenti_tecnici_e_di_supporto')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Regolamenti',
                                                        'inputId' => 'Regolamenti',
                                                        'name' => 'CATEGORY_Regolamenti',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Documenti_tecnici_e_di_supporto')

                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Anagrafe degli eletti',
                                                        'inputId' => 'Anagrafe_degli_eletti',
                                                        'name' => 'CATEGORY_Anagrafe_degli_eletti',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Documenti_tecnici_e_di_supporto')

                                                    ]
                                                );
                                            ?>
                                        </div>
                                                                                
                                        
                                    </div>
                                </div>
                            </div>

                            <p class="espandi-voci mt-4 ">
                                <a href="#altre-categ" id="menu-lista-button-2" role="button" aria-expanded="false" aria-controls="altre-categ" data-toggle="collapse" class="collapsed link-altre-voci d-flex align-items-center text-decoration-none">
                                
                                    <span class="menu-lista-apri font-weight-bold" title="Espandi">Mostra tutto</span>
                                    <span class="menu-lista-riduci font-weight-bold" title="Riduci">Mostra meno</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane p-4 fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                        
                        <div class="advanced-subnav right-subnav">
                            <div class="always-show-menu link-list-wrapper">
                            <div class="uk-subnav ">
                                <div class="mt-5"> 
                            <?php
                                $tags = \open20\amos\tag\models\Tag::find()->orderby(['nome' => SORT_ASC])->all();
                                $u = 0;
                                $showTag = true;
                                foreach($tags as $tag)
                                {
                                    if($u++ == 15)
                                    {
                                        ?>
                                </div>
                            </div>
                            </div>
                            <div class="link-list-wrapper">
                                <div class="link-list collapse mb-0" id="altri-arg">
                                    <div >
                                    <?php
                                    }
                                    if($showTag){
                                        if($tag->nome=='Ambiente' || $tag->nome=='Turismo'|| $tag->nome=='Cultura'){
                                            if($tag->nome=='Ambiente'){
                                                $name2= 'Ambiente1';
                                            }
                                            if($tag->nome=='Turismo'){
                                                $name2= 'Turismo1';
                                            }
                                            if($tag->nome=='Cultura'){
                                                $name2= 'Cultura1';
                                            }
                                            
                                            
                                        }else{
                                            $name2=$tag->nome;
                                        }

                                    
                                    ?>
                                            
                                                <!--checkbox per argomenti-->
                                                <?=

                                                    $this->render(
                                                        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                        [
                                                            'label' => $tag->nome,
                                                            'inputId' => str_replace(" ", "_", $name2),
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
                                                            'inputId' => str_replace(" ", "_", $name2),
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
                                    <a href="#altri-arg" id="menu-lista-button-1" role="button" aria-expanded="false" aria-controls="altri-arg" data-toggle="collapse" class="collapsed link-altre-voci d-flex align-items-center text-decoration-none">
                                    
                                        <span class="menu-lista-apri font-weight-bold" title="Espandi">Mostra tutto</span>
                                        <span class="menu-lista-riduci font-weight-bold" title="Riduci">Mostra meno</span>
                                    </a>
                                </p>
                        </div>
                    </div>
                </div>                     
            </div>
        </div>
      
    


    </div>
    
</div>



