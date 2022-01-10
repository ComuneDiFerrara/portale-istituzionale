<?php
/* versione piattaforma */
$versione = Yii::t('amoscore', 'Versione') . ' ' . ((isset(\Yii::$app->params['versione'])) ? \Yii::$app->params['versione'] : '1.0');
use yii\helpers\Html;
?>

<footer id="footerContent" class="it-footer w-100 position-absolute fixed-bottom z-index-1">
    <div class="it-footer-main py-4 bg-tertiary">
        <div class="container noprint">
            <div class="row">
                <div class="col-md-11">
                    <div class="noprint container-title">
                        <div role="contentinfo" aria-label="Titolo del footer" class="py-1 pt-3 py-md-4">
                            <p dir="ltr" class="equal-font-size-h5 footer-title"><strong><?= Html::encode(Yii::$app->name)?></strong></p>
                        </div>
                    </div>
                    <div class="py-1 py-md-4">
                        <div class="row">
                            <?php if(isset($cmsDefaultMenu)) {?>
                                <div class="col-lg-3 col-md-3">
                                    <div class="link-list-wrapper">
                                        <ul class="footer-list link-list clearfix">
                                            <?= $cmsDefaultMenu?>
                                        </ul>
                                    </div>
                                </div>
                            <?php }?>
                            <?php if(isset($cmsFooterMenu)) {?>
                                <div class="col-lg-3 col-md-3">
                                    <div class="link-list-wrapper">
                                        <ul class="footer-list link-list clearfix">
                                            <?= $cmsFooterMenu ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php }?>
                            <div class="col-lg-3 col-md-3 d-none">
                                <div class="link-list-wrapper">
                                    <ul class="footer-list link-list clearfix">
                                        <li>
                                            <a class="list-item disabled" title="">lorem ipsum</a>
                                        </li>
                                        <li>
                                            <a class="list-item second-level" href="#" title="">lorem ipsum</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 justify-content-md-center align-self-end d-none"> <!-- per veder le icone con i social cambiare d-none in d-flex -->
                    <div class="py-1 py-md-4">
                        <div class="d-flex link-list-wrapper footer-social">
                            <ul class="footer-list link-list clearfix">
                                <li>
                                    <a href="#" class="social-icon" title="Vai alla pagina Facebook" aria-label="Vai alla pagina Facebook">
                                        <svg class="bg-white icon icon-tertiary icon-padded rounded-circle">
                                            <use xlink:href="<?= $currentAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-facebook"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="social-icon" title="Vai alla pagina Twitter" aria-label="Vai alla pagina Twitter">
                                        <svg class="bg-white icon icon-tertiary icon-padded rounded-circle">
                                            <use xlink:href="<?= $currentAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-twitter"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="social-icon" title="Vai alla pagina Linkedin" aria-label="Vai alla pagina Linkedin">
                                        <svg class="bg-white icon icon-tertiary icon-padded rounded-circle">
                                            <use xlink:href="<?= $currentAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-linkedin"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="social-icon" title="Vai alla pagina YouTube" aria-label="Vai alla pagina YouTube">
                                        <svg class="bg-white icon icon-tertiary icon-padded rounded-circle">
                                            <use xlink:href="<?= $currentAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-youtube"></use>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div role="contentinfo" aria-label="Copyleft" class="py-1 py-md-4">
                <hr class="border-white">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="d-none" dir="ltr"><small>© Copyleft Regione Lombardia tutti i diritti Riservati CF 80050050154 - Piazza Città di Lombardia, 1 20124 Milano v.8.3.04-278156-06052019</small></p>
                            <p class="white-color" dir="ltr"><small>Powered by Open 2.0</small></p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</footer>