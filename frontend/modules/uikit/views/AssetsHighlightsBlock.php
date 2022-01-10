<?php

$form = "highlights/graphic";

switch ($data['layout'])
{
    case "1":
        $form = "highlights/graphic";?>
        <?php if(!is_null($dataProvider)):?>
            <div class="notizie-layoutsection evidenza-section position-relative pb-5 mt-5">
                <div class="uk-container">
                        <div class="novità-majory row" uk-grid>
                            <?php foreach ($dataProvider->getModels() as $i => $item) : ?>
                                
                                <?php if($i%4==0 || $i%4==1): //metto div esterno ?>
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <?= $this->render($form, compact('item', 'i', 'data','dataProvider')) ?>
                                    </div>
                                <?php else: ?>
                                    <?php if($i%4==2)://apro il 3 container?>
                                        <div class="col-md-4 col-sm-6 mb-3">
                                        <?= $this->render($form, compact('item', 'i', 'data','dataProvider')) ?>

                                        <?php if(count($data['items'])==$i+1): ?><!--//se c'è ne sono solo 3n lo chiudo anche-->

                                        </div>
                                        <?php endif; ?>
                                    
                                    <?php endif; ?>
                                    <?php if($i%4==3): ?>
                                        <?= $this->render($form, compact('item', 'i', 'data','dataProvider')) ?>
                                        </div>
                                    <?php endif; ?>

                                <?php endif; ?>
                                
                            

                            <?php endforeach ?>
                        </div>
                
                </div>
            </div>
        <?php endif; ?>
        <?php break;
    case "2":
        $form = "highlights/text";?>
       
        <div class="notizie-layoutsection evidenza-section position-relative py-5 ">
            <div class="uk-container">
                <div class="notizie-block-layoutsection row" uk-grid>
                    <?php foreach ($dataProvider->getModels() as $i => $item) : ?>
                        
                        <?= $this->render($form, compact('item', 'i', 'data','dataProvider')) ?>


                    <?php endforeach ?>
                </div>
            </div>
        </div>
        
                                
            
                    
                   
            
        

    <?php break;
}
?>