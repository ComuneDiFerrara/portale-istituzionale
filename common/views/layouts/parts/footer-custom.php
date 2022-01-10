<?php

use yii\web\View;
use app\assets\CustomAsset;
use app\components\CmsHelper;

?>

<script async="" src="//cse.google.com/adsense/search/async-ads.js"></script>
<script async="" src="//www.google-analytics.com/analytics.js"></script>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '', 'auto');
  ga('set', 'anonymizeIp', true);  
  ga('send', 'pageview');
</script> 

<!-- Matomo -->
<script type="text/javascript">
var _paq = window._paq = window._paq || [];
/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function() {
var u="https://ingestion.webanalytics.italia.it/";
_paq.push(['setTrackerUrl', u+'matomo.php']);
_paq.push(['setSiteId', '']);
var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
})();
</script>
<!-- End Matomo Code -->

<footer id="footerContent" class="it-footer-comune position-absolute">
    <div class="it-footer-main py-5 bg-tertiary" style="background-color:#000000;">
        <div class="container noprint pt-4">
            <!--parte dinamica-->
            <div class="row variable-gutters">
                <?php
                    $numItems = count(Yii::$app->menu->findAll(['depth' => 1, 'container' => 'prefooter']));
                    $i = 0;
                    foreach (Yii::$app->menu->findAll(['depth' => 1, 'container' => 'prefooter']) as $item) : /* @var $item \luya\cms\menu\Item */ ?>    
                        <div class="col-md-3">
                            <div class="link-list-wrapper">                                                  
                                <p class="title font-weight-bold text-uppercase"><a class="nav-link p-0 text-decoration-none" href="<?= $item->link; ?>" title="<?= $item->title ?>"><?= $item->title; ?></a></p>                            
                                <?php if(count(Yii::$app->menu->findAll(['parent_nav_id' =>  $item->navId,'depth' => 2, 'container' => 'prefooter']))>0){ ?>                            
                                    <ul class="footer-list link-list clearfix">
                                        <?php foreach (Yii::$app->menu->findAll(['parent_nav_id' =>  $item->navId,'depth' => 2, 'container' => 'prefooter']) as $item2) : /* @var $item \luya\cms\menu\Item */ ?>    
                                            <li>
                                                <a class="list-item" href="<?= $item2->link;?>" title="<?= $item2->title;?>"><?= $item2->title;?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div> 
                    <?php endforeach; ?>           
            </div>
            <!--<div class="row variable-gutters">
                <div class="col-md-3">
                    <div class="link-list-wrapper">
                      
                        <ul class="footer-list link-list clearfix">
                            <li>
                                <a class="list-item" href="/amministrazione/organi-di-governo" title="Organi di governo">Organi di governo</a>
                            </li>

                            <li>
                                <a class="list-item" href="/amministrazione/politici" title="Politici">Politici</a>
                            </li>
                            <li>
                                <a class="list-item" href="/amministrazione/enti-e-fondazioni" title="Enti e fondazioni">Enti e fondazioni</a>
                            </li>
                            <li>
                                <a class="list-item" href="/amministrazione/uffici" title="Uffici">Uffici</a>
                            </li>
                            <li>
                                <a class="list-item" href="/amministrazione/aree-amministrative" title="Aree amministrative">Aree amministrative</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="link-list-wrapper">
                     
                        <ul class="footer-list link-list clearfix">
                            <li>
                                <a class="list-item" href="/servizi/ambiente" title="Ambiente">Ambiente</a>
                            </li>
                            <li>
                                <a class="list-item" href="/servizi/anagrafe-e-stato-civile" title="Anagrafe e stato civile">Anagrafe e stato civile</a>
                            </li>
                            <li>
                                <a class="list-item" href="/servizi/appalti-pubblici" title="Appalti pubblici">Appalti pubblici</a>
                            </li>
                            <li>
                                <a class="list-item" href="/servizi/attività-produttive-e-del-commercio" title="Attività produttive e del commercio">Attività produttive e del commercio</a>
                            </li>
                            <li>
                                <a class="list-item" href="/servizi/autorizzazioni" title="Autorizzazioni">Autorizzazioni</a>
                            </li>
                            <li>
                                <a class="list-item" href="/servizi/urbanistica-e-edilizia" title="Urbanistica e edilizia">Urbanistica e edilizia</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="link-list-wrapper">
                        
                        <ul class="footer-list link-list clearfix">
                            <li>
                                <a class="list-item" href="/novità/news" title="Notizie">Notizie</a>
                            </li>
                            <li>
                                <a class="list-item" href="/novità/eventi" title="Eventi">Eventi</a>
                            </li>
                          
                            <li>
                                <a class="list-item" href="/novità/avvisi" title="Avvisi">Avvisi</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="link-list-wrapper">
                        
                        <ul class="footer-list link-list clearfix">
                            <li>
                                <a class="list-item" href="documenti-e-dati/bandi" title="Bandi">Bandi</a>
                            </li>
                            <li>
                                <a class="list-item" href="documenti-e-dati/modulistica" title="Modulistica">Modulistica</a>
                            </li>
                            <li>
                                <a class="list-item" href="documenti-e-dati/ordinanze" title="Ordinanze">Ordinanze</a>
                            </li>
                            <li>
                                <a class="list-item" href="documenti-e-dati/atti-normativi" title="Atti normativi">Atti normativi</a>
                            </li>
                            <li>
                                <a class="list-item" href="documenti-e-dati/documenti-tecnici-e-di-supporto" title="Documenti tecnici e di supporto">Documenti tecnici e di supporto</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>-->


            <div role="contentinfo" class="py-1 py-md-4">
                <hr class="border-top mb-5">
                <div class="row">
                    <div class="col-md-3">
                        <p class="title font-weight-bold text-uppercase">Contatti</p>
                        <p>Piazza del Municipio, 2<br>- 44121 Ferrara</p>
                        <p>Centralino: +39 0532 419111</p>
                        <p>Fax: +39 0532 419389</p>
                        <p>Codice fiscale: 00297110389</p>
                        
                       
                    </div>
                    <div class="col-md-3">
                        <div class="link-list-wrapper">
                            <p class="title font-weight-bold text-uppercase">URP</p>
                            <ul class="footer-list link-list clearfix">
                                <li>
                                    <a class="list-item" href="https://servizi.comune.fe.it/1608/urp-ufficio-relazioni-con-il-pubblico" title="Ufficio Relazioni con il Pubblico">Ufficio Relazioni con il Pubblico</a>
                                </li>
                                <li>
                                    <a class="mail" href="mailto:example@example.com" title="Invia una mail a example@example.com">example@example.com</a>
                                </li>
                            </ul>
                        </div>
                        <div class="link-list-wrapper">
                            <p class="title font-weight-bold text-uppercase">PEC - Posta elettronica certificata</p>
                            <ul class="footer-list link-list clearfix">
                                <li>
                                <a class="mail" href="mailto:example@example.com" title="Invia una mail a example@example.com">example@example.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="link-list-wrapper">
                            
                            <ul class="footer-list link-list clearfix" style="padding-top:42px">
                                
                                <li>
                                    <a class="list-item" target="_blank" href="https://form.agid.gov.it/view/1855ac7a-f252-4377-85b8-32e906f61a08/" title="Dichiarazione di Accessibilità">Dichiarazione di Accessibilità</a>
                                </li>
                                <li>
                                    <a class="list-item" href="/mappa-del-sito" title="Mappa del sito">Mappa del sito</a>
                                </li>
                                <li>
                                    <a class="list-item" target="_blank" href="https://old.comune.fe.it/2687/dati-monitoraggio" title="Statistiche dei Siti web">Statistiche dei Siti web</a>
                                </li>
                                <li>
                                    <a class="list-item" target="_blank" href="http://intranet.ssi.fe/" title="Intranet - accesso riservato">Intranet - accesso riservato</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <?php if (isset(Yii::$app->params['socialConfigurations']) && is_array(Yii::$app->params['socialConfigurations']) && !empty(Yii::$app->params['socialConfigurations'])) : ?>
                            <?php
                            $socialConfigurations = Yii::$app->params['socialConfigurations'];
                            ?>
                            <p class="title font-weight-bold text-uppercase">Seguici su</p>
                            <div class="link-list-wrapper footer-social">
                                <ul class="footer-list link-list d-flex flex-wrap clearfix">
                                    <?php foreach ($socialConfigurations as $k => $socialConf) : ?>
                                        <li>
                                            <a href="<?= $socialConf ?>" class="social-icon" aria-label="<?= 'Seguici su' . ' ' . $k ?>" target="_blank" title="<?= 'Seguici su' . ' ' . $k ?>">
                                                <svg class="icon">
                                                    <use xlink:href="/svg/sprite.svg#it-<?= $k ?>"></use>
                                                </svg>

                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <br>
                        <?php endif; ?>
                        <div class="link-list-wrapper">
                            <p class="title font-weight-bold text-uppercase">Newsletter</p>
                            <ul class="footer-list link-list clearfix">
                                <li>
                                    <a class="list-item" href="/it/b/26624/newsletter"  title="Informazioni">Informazioni</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="it-footer-small bg-tertiary py-4 clearfix">
        <div class="container d-flex justify-content-between">
            <p class="sr-only">Sezione Link Utili</p>
            <ul class="it-footer-small-list list-inline mb-0">
           
                <li class="list-inline-item">
                    <a href="/note-legali" title="Note Legali">Note legali</a>
                </li>
                <li class="list-inline-item">
                    <a href="/privacy-policy" title="Privacy-Cookies">Privacy policy</a>
                </li>
                <!--<li class="list-inline-item float-right">
                    <  ?php if (\Yii::$app->user->isGuest) : ?>
                        <a href="< ?= \Yii::$app->params['linkConfigurations']['loginLinkCommon'] ?>" class="btn btn-xs text-black btn-secondary d-flex" title="Area amministrativa">Area amministrativa</a>
                    < ?php else : ?>
                        <a href="< ?= \Yii::$app->params['linkConfigurations']['logoutLinkCommon'] ?>" class="btn btn-xs text-black btn-secondary d-flex" title="Esci dall'Area Amministrativa">Esci</a>
                    < ?php endif ?>
                </li>-->
            </ul>
            <?php if (Yii::$app->user->isGuest) : ?>

                <a href="<?= \Yii::$app->params['linkConfigurations']['loginLinkCommon'] ?>" class="btn btn-xs text-black btn-secondary d-flex" title="Accedi all'area personale">
                    <span>Accedi</span><span class="d-none d-sm-flex ml-1">all'area personale</span>
                </a>
            <?php endif ?>
        </div>
    </div>
</footer>

<?php

$breadcrumbJs = <<< JS
/*pezza per nascondere breadcrumb con chiamate ad /app 
        */
var breadcrumbs = $('.breadcrumb-container .breadcrumb-item');
    breadcrumbs.each(function () {
        var link = '';
        link = $(this).children('a').attr('href');
        if (link == '/app') {
            $(this).hide();
        }
    });
JS;

$this->registerJs($breadcrumbJs, View::POS_READY);
