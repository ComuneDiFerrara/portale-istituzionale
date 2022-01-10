<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\layout\views\layouts\parts
 * @category   CategoryName
 */

use open20\amos\community\models\Community;
use open20\amos\community\models\CommunityType;
use open20\amos\core\forms\ContextMenuWidget;
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\helpers\Html;
use open20\amos\layout\assets\BaseAsset;
use open20\amos\layout\Module;
use open20\amos\core\utilities\StringUtils;
use yii\helpers\Url;

$asset = BaseAsset::register($this);

$jsReadMore = <<< JS

$("#moreTextJs .changeContentJs > .actionChangeContentJs").click(function(){
    $("#moreTextJs .changeContentJs").toggle();
    $('html, body').animate({scrollTop: $('#moreTextJs').offset().top - 120},1000);
});
JS;
$this->registerJs($jsReadMore);


$moduleCommunity = Yii::$app->getModule('community');

?>
<?php if (isset($community)) : ?>

    <?php
    open20\amos\community\assets\AmosCommunityAsset::register($this);
    // $viewUrl            = ['/community/join/open-join?id=' . $community->id];
    // $exitUrl            = (!empty(\Yii::$app->homeUrl) ? \Yii::$app->homeUrl : ['/dashboard']);
    // $unsubscribeUrl     = '/community/community/elimina-m2m?' . $community->id . '&targetId=' . \Yii::$app->user->id;
    $fixedCommunityType = (!is_null($moduleCommunity->communityType));
    ?>
    <?php if (!$isLayoutInScope) : ?>

        <div class="network-scope-wrapper scope-community-wrapper">
            <div class="container border-dashed">
                <div class="scope-title-container">
                    <div>
                        <div class="scope-title">
                            <h1><?= $community->name ?>
                                <small class="control-community">
                                    <?php if (!$fixedCommunityType) : ?>
                                        <?php
                                        switch ($community->community_type_id):
                                            case CommunityType::COMMUNITY_TYPE_CLOSED:
                                                $classType            = 'closed';
                                                $textCommunityType    = Module::t('amoslayout', 'Community riservata');
                                                $iconCommunityType    = AmosIcons::show('eye-off');
                                                $tooltipCommunityType = Module::t(
                                                    'amoslayout',
                                                    'Community visibile ai soli partecipanti'
                                                );
                                                break;
                                            case CommunityType::COMMUNITY_TYPE_OPEN:
                                                $classType            = 'open';
                                                $textCommunityType    = Module::t('amoslayout', 'Community aperta');
                                                $iconCommunityType    = AmosIcons::show('lock-open');
                                                $tooltipCommunityType = Module::t(
                                                    'amoslayout',
                                                    'Contenuti disponibili a tutti gli utenti della piattaforma'
                                                );
                                                break;
                                            case CommunityType::COMMUNITY_TYPE_PRIVATE:
                                                $classType            = 'private';
                                                $textCommunityType    = Module::t('amoslayout', 'Community privata');
                                                $iconCommunityType    = AmosIcons::show('lock-outline');
                                                $tooltipCommunityType = Module::t(
                                                    'amoslayout',
                                                    'Contenuti disponibili ai soli partecipanti alla community'
                                                );
                                                break;
                                            default:
                                                $classType            = '';
                                        endswitch;
                                        ?>
                                        <span class="community-status <?= $classType ?>">
                                            <?=
                                                Html::a(
                                                    $iconCommunityType,
                                                    'javascript::void(0)',
                                                    [
                                                        'title' => $tooltipCommunityType,
                                                        'data-toggle' => 'tooltip'
                                                    ]
                                                );
                                            ?>
                                            <?= $textCommunityType ?>
                                        </span>
                                    <?php endif; ?>
                                </small>
                            </h1>

                        </div>

                    </div>
                    <div class="actions-scope">
                        <div class="wrap-icons">
                            <?php
                            echo ContextMenuWidget::widget([
                                'model' => $model,
                                'actionModify' => "/community/community/update?id=" . $community->id,
                                'actionDelete' => "/community/community/delete?id=" . $community->id,
                                'layout' => '@vendor/open20/amos-layout/src/views/widgets/context_menu_widget_network_scope.php'
                            ])
                            ?>
                        </div>
                    </div>
                </div>
                <div class="cta-network-scope flexbox">
                    <a href="/site/to-menu-url?url=/it/community/community/index" class="link-all flexbox align-items-center" title="Visualizza la lista delle community">
                        <span class="am am-arrow-left"></span>
                        <span><?= Module::t('amoscommunity', 'Tutte le community') ?></span>
                    </a>
                    <?php if ($model instanceof Community && Yii::$app->getUser()->can('VALIDATED_BASIC_USER')) : ?>
                        <div class="cta-community">
                            <?php
                            $myUserCommunityMm = $model->myCommunityUser();
                            if (!empty($myUserCommunityMm)) :
                            ?>
                                <small><?= Module::t('amoscommunity', 'Sei iscritto alla community come') . ' ' . $model->getRoleByUser() ?>
                                    <a class="text-danger" href="<?= Url::to(['/community/community/elimina-m2m', 'id' => $model->id, 'targetId' => \Yii::$app->user->id, 'redirectAction' => \Yii::$app->request->url]) ?>" title="<?= Module::t('amoscommunity', 'Disiscriviti dalla community') . $model->title ?>">
                                        <?= Module::t('amoscommunity', 'disiscriviti') ?>
                                    </a>
                                </small>
                            <?php else : ?>
                                <a class="btn btn-primary btn-xs my-3 align-self-start" href="<?= Url::to(['/community/community/join-community', 'communityId' => $model->id, 'redirectAction' => Yii::$app->request->url]) ?>" title="<?= Module::t('amoscommunity', 'Iscriviti alla community') ?> <?= $model->title ?>">
                                    <?= Module::t('amoscommunity', 'Iscriviti alla community') ?>
                                </a>
                            <?php endif ?>
                        </div>

                    <?php endif ?>

                </div>
                <div class="row p-t-15">
                    <div class="col-md-4">
                        <?php
                        $url = '/img/img_default.jpg';
                        if (!empty($community->communityLogo)) {
                            $url = $community->communityLogo->getUrl('scope_community', false, true);
                        }

                        echo $logo    = Html::img(
                            $url,
                            [
                                'alt' => $community->getAttributeLabel('communityLogo'),
                                'class' => 'img-responsive'
                            ]
                        );
                        ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        $desclen = 350;
                        ?>
                        <?php if (strlen($model->description) <= $desclen) : ?>
                            <?= $model->description ?>
                        <?php else : ?>
                            <div id="moreTextJs">
                                <?php
                                $moreContentTextLink  = Module::t('amoslayout', 'espandi descrizione') . ' ' . AmosIcons::show("chevron-down");
                                $moreContentTitleLink = Module::t('amoslayout', 'Leggi la descrizione completa');

                                $lessContentTextLink  = Module::t('amoslayout', 'riduci descrizione') . ' ' . AmosIcons::show("chevron-up");
                                $lessContentTitleLink = Module::t('amoslayout', 'Riduci testo');
                                ?>
                                <div class="changeContentJs partialContent">
                                    <?=
                                        StringUtils::truncateHTML($community->description, $desclen)
                                    ?>
                                    <a class="actionChangeContentJs" href="javascript:void(0)" title="<?= $moreContentTitleLink ?>"><?= $moreContentTextLink ?></a>
                                </div>
                                <div class="changeContentJs totalContent" style="display:none">
                                    <?= $community->description ?>
                                    <a class="actionChangeContentJs" href="javascript:void(0)" title="<?= $lessContentTitleLink ?>"><?= $lessContentTextLink ?></a>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>

                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="network-scope-wrapper scope-community-wrapper scope-small">
            <div>
                <div class="scope-title-container">
                    <div class="row">
                        <div class="col-md-10 scope-title">
                            <p class="h5">
                                <?= Html::a(
                                    Html::tag('small','',['class' => 'am am-arrow-left m-r-10']) . 
                                    $community->name,
                                    '/community/join/open-join?id=' . $community->id,
                                    [
                                        'class' => 'link-list-title'
                                    ]
                                );
                                ?>
                                <small class="control-community">
                                    <?php if (!$fixedCommunityType) : ?>
                                        <?php
                                        switch ($community->community_type_id):
                                            case CommunityType::COMMUNITY_TYPE_CLOSED:
                                                $classType            = 'closed';
                                                $textCommunityType    = Module::t('amoslayout', 'Community riservata');
                                                $iconCommunityType    = AmosIcons::show('eye-off');
                                                $tooltipCommunityType = Module::t(
                                                    'amoslayout',
                                                    'Community visibile ai soli partecipanti'
                                                );
                                                break;
                                            case CommunityType::COMMUNITY_TYPE_OPEN:
                                                $classType            = 'open';
                                                $textCommunityType    = Module::t('amoslayout', 'Community aperta');
                                                $iconCommunityType    = AmosIcons::show('lock-open');
                                                $tooltipCommunityType = Module::t(
                                                    'amoslayout',
                                                    'Contenuti disponibili a tutti gli utenti della piattaforma'
                                                );
                                                break;
                                            case CommunityType::COMMUNITY_TYPE_PRIVATE:
                                                $classType            = 'private';
                                                $textCommunityType    = Module::t('amoslayout', 'Community privata');
                                                $iconCommunityType    = AmosIcons::show('lock-outline');
                                                $tooltipCommunityType = Module::t(
                                                    'amoslayout',
                                                    'Contenuti disponibili ai soli partecipanti alla community'
                                                );
                                                break;
                                            default:
                                                $classType            = '';
                                        endswitch;
                                        ?>
                                        <span class="community-status <?= $classType ?>">
                                            <?=
                                                Html::a(
                                                    $iconCommunityType,
                                                    'javascript::void(0)',
                                                    [
                                                        'title' => $tooltipCommunityType,
                                                        'data-toggle' => 'tooltip'
                                                    ]
                                                );
                                            ?>
                                            <small><?= $textCommunityType ?></small>
                                        </span>
                                    <?php endif; ?>
                                </small>
                            </p>
                        </div>
                        <div class="col-md-2">
                            <?php
                            $url = '/img/img_default.jpg';
                            if (!empty($community->communityLogo)) {
                                $url = $community->communityLogo->getUrl('scope_community', false, true);
                            }

                            echo $logo    = Html::img(
                                $url,
                                [
                                    'alt' => $community->getAttributeLabel('communityLogo'),
                                    'class' => 'img-responsive'
                                ]
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php endif ?>