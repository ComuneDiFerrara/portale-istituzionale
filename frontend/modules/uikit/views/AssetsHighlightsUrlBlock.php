<?php
use open20\design\assets\BootstrapItaliaDesignAsset;
use yii\web\View;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

$autoplay = $data['autoplay'] ? true : false;
$loop = $data['loop'] ? "true" : "false";
$autoplayTimeout = empty($data['autoplayTimeout']) ? "0" : $data['autoplayTimeout'];

$form = "highlightsurl/slider";

switch ($data['layout'])
{
    case "1":
        $js = <<<JS
    $('#carouselNews').owlCarousel({
        items: 1,
        autoplay: $autoplay,
        loop: $loop,
        autoplayTimeout: $autoplayTimeout,
    });
    function playVid() {
        $('#carouselNews').trigger('play.owl.autoplay',[$autoplayTimeout]);
        $('.carouselPause').removeClass("active");
        $('.carouselPlay').addClass("active");
    }
    function pauseVid() {
        $('#carouselNews').trigger('stop.owl.autoplay');
        $('.carouselPlay').removeClass("active");
        $('.carouselPause').addClass("active");

    }
    $(document).on("scroll", function () {
  if
    ($(document).scrollTop() > 200) {
  }
  else {
    $('#carouselNews').trigger('refresh.owl.carousel');
    $('.carouselPause').removeClass("active");
    $('.carouselPlay').addClass("active");
  }
});

JS;

$this->registerJs($js, View::POS_END);
        $form = "highlightsurl/slider"; ?>
            <div class="notizia-principale it-bottom-overlapping-content bg-white it-hero-small-size it-hero-wrapper position-relative modulo-cms mb-0 mb-md-5">
                <div class="uk-container">
                    <div class="it-carousel-wrapper it-carousel-landscape-abstract carousel-autoplay uk-section-default uk-section h-100">
                        <div id="carouselNews" class="it-carousel-all owl-carousel uk-section-default uk-section owl-loaded owl-drag">
                        <?php foreach ($data['items'] as $i => $item) : ?>
                        
                            <?= $this->render($form, compact('item', 'i', 'data')) ?>

                        <?php endforeach ?>
                        
                        </div>
                    </div>
                    <?php if ($autoplay) : ?>
                        <div class="action-video">
                            <a onclick="playVid()" type="button" title="Play" class="h4 carouselPlay active"><span class="mdi mdi-play-circle"></span></a>
                            <a onclick="pauseVid()" type="button" title="Pausa" class="h4 carouselPause"><span class="mdi mdi-pause-circle"></span></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php break;
    case "2":
        $form = "highlightsurl/graphic"; ?>
        <div class="notizie-layoutsection evidenza-section position-relative pb-5 mt-5">
            <div class="uk-container">
                    <div class="novità-majory row" uk-grid>
                        <?php foreach ($data['items'] as $i => $item) : ?>
                            
                            <?php if($i%4==0 || $i%4==1): //metto div esterno ?>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <?= $this->render($form, compact('item', 'i', 'data')) ?>
                                </div>
                            <?php else: ?>
                                <?php if($i%4==2)://apro il 3 container?>
                                    <div class="col-md-4 col-sm-6 mb-3">
                                    <?= $this->render($form, compact('item', 'i', 'data')) ?>

                                    <?php if(count($data['items'])==$i+1): ?><!--//se c'è ne sono solo 3n lo chiudo anche-->

                                    </div>
                                    <?php endif; ?>
                                
                                <?php endif; ?>
                                <?php if($i%4==3): ?>
                                    <?= $this->render($form, compact('item', 'i', 'data')) ?>
                                    </div>
                                <?php endif; ?>

                            <?php endif; ?>
                            
                        

                        <?php endforeach ?>
                    </div>
               
            </div>
        </div>
        <?php break;
    case "3":
        $form = "highlightsurl/text";?>
        <div class="notizie-layoutsection evidenza-section position-relative pb-5 ">
            <div class="uk-container">
                <div class="notizie-block-layoutsection row" uk-grid>
                    <?php foreach ($data['items'] as $i => $item) : ?>
                        
                        <?= $this->render($form, compact('item', 'i', 'data')) ?>

                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php break;
}
?>







 

    
