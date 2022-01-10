
<?php
use yii\widgets\ListView;
use yii\web\View;
use open20\design\assets\BootstrapItaliaDesignAsset;
use luya\helpers\Url;
use yii\widgets\ActiveForm;
use open20\design\assets\AgidDesignAsset;

$agidAsset = AgidDesignAsset::register($this);

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$urlBase = \Yii::$app->params['platform']['frontendUrl'];
?>

<script>

   
    function setActiveTab(tab){
        var tab1=document.getElementById("tab1-tab");
        var tab1Content=document.getElementById("tab1");
        var tab2=document.getElementById("tab2-tab");
        var tab2Content=document.getElementById("tab2");
        if(tab=='categ'){
            tab1Content.classList.add("active");
            tab1Content.classList.add("show");
            tab1.classList.add("active");
            tab2Content.classList.remove("active");
            tab2Content.classList.remove("show");
            tab2.classList.remove("active");
        }else{
            tab2Content.classList.add("active");
            tab2Content.classList.add("show");
            tab2.classList.add("active");
            tab1Content.classList.remove("active");
            tab1Content.classList.remove("show");
            tab1.classList.remove("active");

        }
        
        
       
    };
    
    function resetFilterTutto(){
        
        var bottoneFiltro=document.getElementById("filtro-tutto");
        bottoneFiltro.classList.add("active-filter");
        var otherButtonToDeactiveAmm=document.getElementById("filtro-amministrazione");
        var otherButtonToDeactiveSer=document.getElementById("filtro-servizi");
        var otherButtonToDeactiveNov=document.getElementById("filtro-novità");
        var otherButtonToDeactiveDoc=document.getElementById("filtro-documenti");

        otherButtonToDeactiveAmm.classList.remove("active-filter");
        otherButtonToDeactiveSer.classList.remove("active-filter");
        otherButtonToDeactiveNov.classList.remove("active-filter");
        otherButtonToDeactiveDoc.classList.remove("active-filter");

        var inputTochange=$("#container-categoria-amministrazione .form-check input");
        inputTochange.prop('checked', true);
        var inputTochange=$("#container-categoria-servizi .form-check input");
        inputTochange.prop('checked', true);
        var inputTochange=$("#container-categoria-novità .form-check input");
        inputTochange.prop('checked', true);
        var inputTochange=$("#container-categoria-documenti .form-check input");
        inputTochange.prop('checked', true);

    };
    

    function resetFilterAmministrazione(){
        var bottoneFiltroAll=document.getElementById("filtro-tutto");
        bottoneFiltroAll.classList.remove("active-filter");
        var bottoneFiltro=document.getElementById("filtro-amministrazione");
        bottoneFiltro.classList.toggle("active-filter");
        var inputTochange=$("#container-categoria-amministrazione .form-check input");
        
        var inputTochangeSer=$("#container-categoria-servizi .form-check input");
        var buttonTochangeSer=document.getElementById("filtro-servizi");
        if(!buttonTochangeSer.classList.contains("active-filter")){
            inputTochangeSer.prop('checked', false);
        }
       
        var inputTochangeNov=$("#container-categoria-novità .form-check input");
        var buttonTochangeNov=document.getElementById("filtro-novità");
        if(!buttonTochangeNov.classList.contains("active-filter")){
            inputTochangeNov.prop('checked', false);
        }

       
        var inputTochangeDoc=$("#container-categoria-documenti .form-check input");
        var buttonTochangeDoc=document.getElementById("filtro-documenti");
        if(!buttonTochangeDoc.classList.contains("active-filter")){
            inputTochangeDoc.prop('checked', false);
        }


        if(bottoneFiltro.classList.contains("active-filter")){
            inputTochange.prop('checked', true);
        }else{
            inputTochange.prop('checked', false);
        }


    };

    function resetFilterServizi(){
        var bottoneFiltroAll=document.getElementById("filtro-tutto");
        bottoneFiltroAll.classList.remove("active-filter");
        var bottoneFiltro=document.getElementById("filtro-servizi");
        bottoneFiltro.classList.toggle("active-filter");
        var inputTochange=$("#container-categoria-servizi .form-check input");

        var inputTochangeAmm=$("#container-categoria-amministrazione .form-check input");
        var buttonTochangeAmm=document.getElementById("filtro-amministrazione");
        if(!buttonTochangeAmm.classList.contains("active-filter")){
            inputTochangeAmm.prop('checked', false);
        }


        var inputTochangeNov=$("#container-categoria-novità .form-check input");
        var buttonTochangeNov=document.getElementById("filtro-novità");
        if(!buttonTochangeNov.classList.contains("active-filter")){
            inputTochangeNov.prop('checked', false);
        }
       
        var inputTochangeDoc=$("#container-categoria-documenti .form-check input");
        var buttonTochangeNov=document.getElementById("filtro-documenti");
        if(!buttonTochangeNov.classList.contains("active-filter")){
            inputTochangeDoc.prop('checked', false);
        }


        if(bottoneFiltro.classList.contains("active-filter")){
            inputTochange.prop('checked', true);
        }else{
            inputTochange.prop('checked', false);
        }


    };

    function resetFilterNovità(){
        var bottoneFiltroAll=document.getElementById("filtro-tutto");
        bottoneFiltroAll.classList.remove("active-filter");
        var bottoneFiltro=document.getElementById("filtro-novità");
        bottoneFiltro.classList.toggle("active-filter");
        var inputTochange=$("#container-categoria-novità .form-check input");

        var inputTochangeAmm=$("#container-categoria-amministrazione .form-check input");
        var buttonTochangeAmm=document.getElementById("filtro-amministrazione");
        if(!buttonTochangeAmm.classList.contains("active-filter")){
            inputTochangeAmm.prop('checked', false);
        }
        
        var inputTochangeSer=$("#container-categoria-servizi .form-check input");
        var buttonTochangeSer=document.getElementById("filtro-servizi");
        if(!buttonTochangeSer.classList.contains("active-filter")){
            inputTochangeSer.prop('checked', false);
        }
        
        var inputTochangeDoc=$("#container-categoria-documenti .form-check input");
        var buttonTochangeDoc=document.getElementById("filtro-documenti");
        if(!buttonTochangeDoc.classList.contains("active-filter")){
            inputTochangeDoc.prop('checked', false);
        }
        


        if(bottoneFiltro.classList.contains("active-filter")){
            inputTochange.prop('checked', true);
        }else{
            inputTochange.prop('checked', false);
        }


    };

    function resetFilterDocumenti(){
        var bottoneFiltroAll=document.getElementById("filtro-tutto");
        bottoneFiltroAll.classList.remove("active-filter");
        var bottoneFiltro=document.getElementById("filtro-documenti");
        bottoneFiltro.classList.toggle("active-filter");
        var inputTochange=$("#container-categoria-documenti .form-check input");

        var inputTochangeAmm=$("#container-categoria-amministrazione .form-check input");
        var buttonTochangeAmm=document.getElementById("filtro-amministrazione");
        if(!buttonTochangeAmm.classList.contains("active-filter")){
            inputTochangeAmm.prop('checked', false);
        }
        
        var inputTochangeSer=$("#container-categoria-servizi .form-check input");
        var buttonTochangeSer=document.getElementById("filtro-servizi");
        if(!buttonTochangeAmm.classList.contains("active-filter")){
            inputTochangeSer.prop('checked', false);
        }
        
        var inputTochangeNov=$("#container-categoria-novità .form-check input");
        var buttonTochangeNov=document.getElementById("filtro-novità");
        if(!buttonTochangeNov.classList.contains("active-filter")){
            inputTochangeNov.prop('checked', false);
        }
       

        if(bottoneFiltro.classList.contains("active-filter")){
            inputTochange.prop('checked', true);
        }else{
            inputTochange.prop('checked', false);
        }


    };

    function isButtonsToActive(){   
        
        var bottoneFiltroAll=document.getElementById("filtro-tutto");
       
        var inputToverifyAmm=$("#container-categoria-amministrazione .form-check input");
        var inputCheckedAmm=$("#container-categoria-amministrazione .form-check input:checked");
        var firstInputCheckedAmm=document.getElementById("container-categoria-amministrazione").getElementsByClassName("form-check")[0].getElementsByTagName("input")[0];


        var inputToverifySer=$("#container-categoria-servizi .form-check input");
        var inputCheckedSer=$("#container-categoria-servizi .form-check input:checked");
        var firstInputCheckedSer=document.getElementById("container-categoria-servizi").getElementsByClassName("form-check")[0].getElementsByTagName("input")[0];


        var inputToverifyDoc=$("#container-categoria-documenti .form-check input");
        var inputCheckedDoc=$("#container-categoria-documenti .form-check input:checked");
        var firstInputCheckedDoc=document.getElementById("container-categoria-documenti").getElementsByClassName("form-check")[0].getElementsByTagName("input")[0];

        var inputToverifyNov=$("#container-categoria-novità .form-check input");
        var inputCheckedNov=$("#container-categoria-novità .form-check input:checked");
        var firstInputCheckedNov=document.getElementById("container-categoria-novità").getElementsByClassName("form-check")[0].getElementsByTagName("input")[0];

        if(inputCheckedAmm.length>0){   
            if((firstInputCheckedAmm.checked==1) || (inputToverifyAmm.length == inputCheckedAmm.length) || (firstInputCheckedAmm.checked==0 && inputToverifyAmm.length-1 == inputCheckedAmm.length)){  
                bottoneFiltroAll.classList.remove("active-filter");
                var bottoneFiltro=document.getElementById("filtro-amministrazione");
                bottoneFiltro.classList.add("active-filter");
                if((inputToverifySer.length == inputCheckedSer.length) ||
                    (firstInputCheckedSer.checked==1) ||
                    (firstInputCheckedSer.checked==0 && inputToverifySer.length-1 == inputCheckedSer.length) ||
                    (inputToverifyDoc.length == inputCheckedDoc.length) ||
                    (firstInputCheckedDoc.checked==1) ||
                    (firstInputCheckedDoc.checked==0 && inputToverifyDoc.length-1 == inputCheckedDoc.length) ||
                    (inputToverifyNov.length == inputCheckedNov.length) ||
                    (firstInputCheckedNov.checked==1) ||
                    (firstInputCheckedNov.checked==0 && inputToverifyNov.length-1 == inputCheckedNov.length)
                  ){  
                var bottoneFiltro2=document.getElementById("more-category");
                bottoneFiltro2.classList.remove("active-filter");
                }
            }else{
                var bottoneAll=document.getElementById("filtro-tutto");
                bottoneAll.classList.remove("active-filter");
                if(inputCheckedAmm.length >0 && (firstInputCheckedAmm.checked==0) ){
                    var bottoneFiltro=document.getElementById("more-category");
                    var bottoneFiltro2=document.getElementById("filtro-amministrazione");
                    bottoneFiltro2.classList.remove("active-filter");
                    bottoneFiltro.classList.add("active-filter");
                   
                   
                }
            }
        }
        
        if(inputCheckedSer.length>0){
            if((inputToverifySer.length == inputCheckedSer.length) || (firstInputCheckedSer.checked==1) || (firstInputCheckedSer.checked==0 && inputToverifySer.length-1 == inputCheckedSer.length)){  
            bottoneFiltroAll.classList.remove("active-filter");
            var bottoneFiltro=document.getElementById("filtro-servizi");
            bottoneFiltro.classList.add("active-filter");
            if((inputToverifySer.length == inputCheckedSer.length) ||
                    (firstInputCheckedSer.checked==1) ||
                    (firstInputCheckedSer.checked==0 && inputToverifySer.length-1 == inputCheckedSer.length) ||
                    (inputToverifyDoc.length == inputCheckedDoc.length) ||
                    (firstInputCheckedDoc.checked==1) ||
                    (firstInputCheckedDoc.checked==0 && inputToverifyDoc.length-1 == inputCheckedDoc.length) ||
                    (inputToverifyNov.length == inputCheckedNov.length) ||
                    (firstInputCheckedNov.checked==1) ||
                    (firstInputCheckedNov.checked==0 && inputToverifyNov.length-1 == inputCheckedNov.length)
                  ){
                    var bottoneFiltro2=document.getElementById("more-category");
                    bottoneFiltro2.classList.remove("active-filter");
                }
            }else{
                var bottoneAll=document.getElementById("filtro-tutto");
                bottoneAll.classList.remove("active-filter");
                if(inputCheckedSer.length >0 && (firstInputCheckedSer.checked==0) ){
                  
                    
                    var bottoneFiltro=document.getElementById("more-category");
                    bottoneFiltro.classList.add("active-filter");
                    var bottoneFiltro2=document.getElementById("filtro-servizi");
                    bottoneFiltro2.classList.remove("active-filter");
                }
            }
        }
        
        if(inputCheckedDoc.length>0){
            if((inputToverifyDoc.length == inputCheckedDoc.length) || (firstInputCheckedDoc.checked==1) || (firstInputCheckedDoc.checked==0 && inputToverifyDoc.length-1 == inputCheckedDoc.length)){  
            bottoneFiltroAll.classList.remove("active-filter");
            var bottoneFiltro=document.getElementById("filtro-documenti");
            bottoneFiltro.classList.add("active-filter");
            if((inputToverifySer.length == inputCheckedSer.length) ||
                    (firstInputCheckedSer.checked==1) ||
                    (firstInputCheckedSer.checked==0 && inputToverifySer.length-1 == inputCheckedSer.length) ||
                    (inputToverifyDoc.length == inputCheckedDoc.length) ||
                    (firstInputCheckedDoc.checked==1) ||
                    (firstInputCheckedDoc.checked==0 && inputToverifyDoc.length-1 == inputCheckedDoc.length) ||
                    (inputToverifyNov.length == inputCheckedNov.length) ||
                    (firstInputCheckedNov.checked==1) ||
                    (firstInputCheckedNov.checked==0 && inputToverifyNov.length-1 == inputCheckedNov.length)
                  ){
                    var bottoneFiltro2=document.getElementById("more-category");
                    bottoneFiltro2.classList.remove("active-filter");
                  }
            }else{
                var bottoneAll=document.getElementById("filtro-tutto");
                bottoneAll.classList.remove("active-filter");
                if(inputCheckedDoc.length >0 && (firstInputCheckedDoc.checked==0) ){
                    
                    var bottoneFiltro=document.getElementById("more-category");
                    bottoneFiltro.classList.add("active-filter");
                    var bottoneFiltro2=document.getElementById("filtro-documenti");
                    bottoneFiltro2.classList.remove("active-filter");
                }
            }
        }
        
        if(inputCheckedNov.length>0){
            if((inputToverifyNov.length == inputCheckedNov.length) || (firstInputCheckedNov.checked==1) || (firstInputCheckedNov.checked==0 && inputToverifyNov.length-1 == inputCheckedNov.length)){  
            bottoneFiltroAll.classList.remove("active-filter");
            var bottoneFiltro=document.getElementById("filtro-novità");
            bottoneFiltro.classList.add("active-filter");
            if((inputToverifySer.length == inputCheckedSer.length) ||
                    (firstInputCheckedSer.checked==1) ||
                    (firstInputCheckedSer.checked==0 && inputToverifySer.length-1 == inputCheckedSer.length) ||
                    (inputToverifyDoc.length == inputCheckedDoc.length) ||
                    (firstInputCheckedDoc.checked==1) ||
                    (firstInputCheckedDoc.checked==0 && inputToverifyDoc.length-1 == inputCheckedDoc.length) ||
                    (inputToverifyNov.length == inputCheckedNov.length) ||
                    (firstInputCheckedNov.checked==1) ||
                    (firstInputCheckedNov.checked==0 && inputToverifyNov.length-1 == inputCheckedNov.length)
                  ){
                    var bottoneFiltro2=document.getElementById("more-category");
                    bottoneFiltro2.classList.remove("active-filter");
                }
            }else{
                var bottoneAll=document.getElementById("filtro-tutto");
                bottoneAll.classList.remove("active-filter");
                if(inputCheckedNov.length >0 && (firstInputCheckedNov.checked==0) ){
                    
                    var bottoneFiltro=document.getElementById("more-category");
                    bottoneFiltro.classList.add("active-filter");
                    var bottoneFiltro2=document.getElementById("filtro-novità");
                    bottoneFiltro2.classList.remove("active-filter");
                }
            }
        }
        if(inputCheckedAmm.length==0 && inputCheckedSer.length==0 && inputCheckedNov.length==0 && inputCheckedDoc.length==0){
          
            bottoneFiltroAll.classList.add("active-filter");
            var bottoneFiltro=document.getElementById("filtro-amministrazione");
            var bottoneFiltro2=document.getElementById("more-category");
            bottoneFiltro2.classList.remove("active-filter");
            bottoneFiltro.classList.remove("active-filter");
        }

        if (bottoneFiltroAll.classList.contains("active-filter")){
            var inputAmm=$("#container-categoria-amministrazione .form-check input");
            inputAmm.prop('checked', true);
            var inputSer=$("#container-categoria-servizi .form-check input");
            inputSer.prop('checked', true);
            var inputDoc=$("#container-categoria-documenti .form-check input");
            inputDoc.prop('checked', true);
            var inputNov=$("#container-categoria-novità .form-check input");
            inputNov.prop('checked', true);

        }
        isButtonsToActiveTag('categ');
        


        
    };

    function isButtonsToActiveTag(tab){
        setActiveTab(tab);
        var bottoneFiltroTagAll=document.getElementById("all-tag");
        var moreTag=document.getElementById("more-tag");
      
      
       
        
        
        var inputTagToVerify=$("#tab2 .form-check input");
        var inputTagChecked=$("#tab2 .form-check input:checked");
        
        if(inputTagChecked.length>0){   
            
            if((inputTagToVerify.length == inputTagChecked.length)){
                bottoneFiltroTagAll.classList.add("active-filter");
                moreTag.classList.remove("active-filter");
            }else{
                bottoneFiltroTagAll.classList.remove("active-filter");
                moreTag.classList.add("active-filter");
            }

        }

        if (bottoneFiltroTagAll.classList.contains("active-filter")){
            var inputTag=$("#tab2 .form-check input");
            inputTag.prop('checked', true);
            
            

        }

      
    };

    function resetFilterTuttoTag(){
      
        var bottoneFiltroTagAll=document.getElementById("all-tag");
        if (bottoneFiltroTagAll.classList.contains("active-filter")){
            bottoneFiltroTagAll.classList.remove("active-filter");
        }else{
            bottoneFiltroTagAll.classList.add("active-filter");
        }
        
       
        var moreTag=document.getElementById("more-tag");
        moreTag.classList.remove("active-filter");
        var inputTag=$("#tab2 .form-check input");
        if (bottoneFiltroTagAll.classList.contains("active-filter")){
            
            
           
            inputTag.prop('checked', true);
            

        }else{
            inputTag.prop('checked', false);
        }

    };

    function setCheckChild(id){
        var divCheckToChange=document.getElementById(id);
        if(divCheckToChange){
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
        }
        
      
        

    };
    function setCheckParent(id){
        var divCheckToChange=document.getElementById(id);
        if(divCheckToChange){
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
        }
       
            
        

    };
    
    
    function setAutoComplete() {
		
        $("#EsempioInputRicerca").keyup(function() {
                 var name = $('#EsempioInputRicerca').val();
                 if (name === "" || name.length <= 3) {
                        $("#result").hide();
                 } else {
                    $.ajax({
                             type: "GET",
                             url: "/api/1/auto-complete",
                             data: {
                             "term": name.toLowerCase(),
                             "baseUrl": '<?=$agidAsset->baseUrl?>'
                             }, success: function(html) {
                                 if(html.length > 0)
                                 {
                                    $('#result').html(html).show();
                                    $("#result a").click(function(event) {
                                      event.preventDeafult;
                                      fill($(this).attr('href'),$(this).contents().not($(this).children()).text());
                                      return false;
                                    });
                                }else{
                                    $('#result').html('').hide();
                                }
                             }});
                  }
              });

  }
  
  function fill(href, Value) {
     $('#EsempioInputRicerca').val(Value);
     $('#result').hide();
  }

</script>






<?php
        $this->registerJs('setAutoComplete();', View::POS_READY);
        $this->registerJs('isButtonsToActive();', View::POS_READY);
        $this->registerJs("isButtonsToActiveTag('categ');", View::POS_READY);



        $form = ActiveForm::begin([
                    'action' => Url::toRoute(['/backendobjects']),
                    'method' => 'get',
                    'options' => [
                        'id' => 'element_form_' . $model->id,
                        'class' => 'form wrap-search',
                        'enctype' => 'multipart/form-data',
                    ]
        ]);
?>
<div class="fullsrc-section container my-4 ">
    <div class="uk-container">
        
        <div class="px-0 py-lg-2">
            <div class="d-flex align-items-center">
                    <a href="#" class="go-back" title="Torna indietro">
                        <svg class="icon icon-primary mr-5" role="img" >
                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#arrow-left"></use>
                        </svg>
                    </a>
                    
                    <h1 id="headline-746"> Cerca</h1>
            </div>

            <div class="fullwidth-src mt-4 d-flex flex-column">
                <div class="full-text-src">
                    <?=
                        $this->render(
                            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-input-search',
                            [
                            'name'=>'searchtext',
                            'ariaDescribedBy'=>'Cerca',
                            'label' => 'Digita almeno 3 caratteri per effettuare la ricerca',
                            'inputId' => 'EsempioInputRicerca',
                            'type' => 'search',
                            'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('searchtext'),
                            'htmlOptions' => ['autocomplete' => "off"]
                            ]
                        );
                    ?>
                    <div class="form-group">
                        <div class="dropdown">
                            <div id="result" class="dropdown-menu dropdown-menu-left" ></div>
                        </div>
                    </div>
                </div>
                <div class="categorie-src d-flex flex-wrap mt-4">
                    <a id="filtro-tutto" class="active-filter btn btn-outline-primary mb-2 mr-2 d-flex align-items-center" onclick="resetFilterTutto()">
                        Tutto
                    </a>
                    <a id="filtro-amministrazione" class="text-primary  btn btn-outline-primary mb-2 mr-2 d-flex align-items-center" onclick="resetFilterAmministrazione()">
                        <svg class="icon icon-sm icon-primary mr-1" role="img" >
                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#bank"></use>
                        </svg>
                        Amministrazione
                    </a>
                    <a id="filtro-servizi" class="text-primary btn btn-outline-primary mb-2 mr-2 d-flex align-items-center"  onclick="resetFilterServizi()">
                            
                        <svg class="icon icon-sm icon-primary mr-1" role="img" >
                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#cog"></use>
                        </svg>
                        Servizi
                    </a>
                    <a id="filtro-novità" class="text-primary btn btn-outline-primary mb-2 mr-2 d-flex align-items-center" onclick="resetFilterNovità()">
                        <svg class="icon icon-sm icon-primary mr-1" role="img" >
                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#calendar"></use>
                        </svg>
                        Novità
                    </a>
                    <a  id="filtro-documenti" class="text-primary btn btn-outline-primary mb-2 mr-2 d-flex align-items-center" onclick="resetFilterDocumenti()">
                        <svg class="icon icon-sm icon-primary mr-1" role="img" >
                                        <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#file-document-outline"></use>
                        </svg>
                        Documenti e dati
                    </a>
                    <button id="more-category" type="button" class="btn btn-outline-primary mb-2 " data-toggle="modal" data-target=".more-option-modal" onclick="isButtonsToActive()">
                        <svg class="icon icon-sm icon-primary" role="img" >
                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#dots-horizontal"></use>
                        </svg>
                    </button>

                </div>
                <div class="argomenti-src mt-4">
                    <h2 class="h6 font-weight-bold text-uppercase">Argomenti</h2>
                    <div class="d-flex align-items-center mt-1">
                        <a id="all-tag"  class="badge border border-primary text-decoration-none badge-pill active mr-2 d-flex align-items-center justify-content-center " onclick="resetFilterTuttoTag()">
                            Tutti gli argomenti
                        </a>
                        <div class="modal-filter-to-inject d-flex align-items-center">
            
                        </div>
                        <a id="more-tag" class="badge badge-pill border border-primary text-decoration-none mr-2 align-items-center justify-content-center " data-toggle="modal" data-target=".more-option-modal" onclick="isButtonsToActiveTag('arg')">
                            <svg class="icon icon-sm icon-primary" role="img" >
                                <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#dots-horizontal"></use>
                            </svg>
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!--dataprovider-->
<div class="modulo-backend-ricerca uk-container">
    <div class="card-ricerca-container mt-5">
        <?php
        if ($dataProvider->getTotalCount() > 0) {
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_itemCardSearch',
                'viewParams' => [
                    'detailPage' => $detailPage,
                    'viewFields' => $viewFields,
                    'blockItemId' => $blockItemId,
                ],
                'summary' => '',
                'itemOptions' => [
                    'tag' => false
                ],
                'options' => [
                    'class' => 'list-view w-100 row d-flex flex-wrap'
                ]
            ]);
        }else{ ?>
            <div class="no-result">
                <p >Non sono presenti contenuti</p>
            </div>
        <?php } ?>
    </div>
</div>






<!--modale more-option-->
<!-- Large modal -->

<div class="modal fade more-option-modal" tabindex="-1" role="dialog" aria-label="myLargeModalLabel" aria-hidden="true">
    <div class="modale-fullscreen-ricerca modal-dialog h-100 mw-100 w-100 m-0">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between uk-container">
                <div class="d-flex">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="isButtonsToActive()">
                        <svg class="icon icon-primary mr-5" role="img" >
                            <use xlink:href=" <?= $bootstrapItaliaAsset->baseUrl ?>/sprite/material-sprite.svg#arrow-left"></use>
                        </svg>
                    </button>
                    <h2 class="h1">Filtri</h2>
                </div>
                <button class="btn btn-primary" type="button" data-dismiss="modal" aria-label="Close" onclick="isButtonsToActive()">
                    Conferma
                </button>           
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
                        <div class="advanced-subnav right-subnav">
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
                                                        'name' => 'CATEGORY_Amministrativa',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Amministrativa')
                                                    ]
                                                );
                                            ?>
                                            <?=
                                                $this->render(
                                                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                    [
                                                        'label' => 'Politici',
                                                        'inputId' => 'Politici',
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
                                                        'inputId' => 'Ambiente1',
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
                                                        'label' => 'Cultura e tempo libero',
                                                        'inputId' => 'Cultura_e_tempo_libero',
                                                        'name' => 'CATEGORY_Cultura_e_tempo_libero',
                                                        'value' => \app\modules\cms\helpers\CmsHelper::itemQueryStringValue('CATEGORY_Cultura_e_tempo_libero')
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
                                                        'inputId' => 'Salute,_benessere_e_assistenza',
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
                                                        'inputId' => 'CatTurismo',
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
                                <a href="#altre-categ" id="menu-lista-button" role="button" aria-expanded="false" aria-controls="altre-categ" data-toggle="collapse" class="collapsed link-altre-voci d-flex align-items-center text-decoration-none">
                                
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
                                    if($showTag)
                                    {
                            ?>
                                            
                                                <!--checkbox per argomenti-->
                                                <?=

                                                    $this->render(
                                                        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                                                        [
                                                            'label' => $tag->nome,
                                                            'inputId' => str_replace(" ", "_", $tag->nome),
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
                                                            'inputId' => str_replace(" ", "_", $tag->nome),
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

<?php ActiveForm::end(); ?>

