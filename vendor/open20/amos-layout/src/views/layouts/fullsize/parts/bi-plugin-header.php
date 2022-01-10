<?php

use open20\amos\layout\Module;

$isGuest            = \Yii::$app->user->isGuest;
$canCreate          = !$isGuest;
//$hideCreate         = (isset($hideCreate)) ? $hideCreate : false;
$canManage          = (isset($canManage)) ? $canManage : !$isGuest;
$titlePreventCreate = (isset($titlePreventCreate)) ? $titlePreventCreate : Module::t(
    'amoslayout',
    'Accedi o registrati alla piattaforma {platformName} per creare un contenuto',
    ['platformName' => \Yii::$app->name]
);

$moduleCwh = \Yii::$app->getModule('cwh');
if (isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
    $scope      = $moduleCwh->getCwhScope();
    $isSetScope = (!empty($scope)) ? true : false;
    if (isset($scope['community'])) {
        $community = \open20\amos\community\models\Community::findOne($scope['community']);
        if (!empty($community)) {
            $canCreate               = \open20\amos\community\utilities\CommunityUtil::loggedUserIsParticipant($community->id);
            $canManage               = \open20\amos\community\utilities\CommunityUtil::loggedUserIsCommunityManager($community->id);
            $communityName           = $community->name;
            $titleScopePreventCreate = (isset($titleScopePreventCreate)) ? $titleScopePreventCreate : Module::t(
                'amoslayout',
                'Per creare un contenuto iscriviti alla community {communityName}',
                ['communityName' => $communityName]
            );
        }
    }
}
$manageLinks = [];
if (method_exists(\Yii::$app->controller, 'getManageLinks')) {
    $manageLinks = \Yii::$app->controller->getManageLinks();
}
if(empty($manageLinks) ){
    
$canManage=false;
}

if(empty($urlCreate) ){
    
    $canCreate=false;
}

?>

<div class="row">
    <div class="col-sm-8">
        <div class="flexbox title-heading-plugin">
            <div class="m-r-10">
                <div class="h2 text-uppercase text-secondary mb-0 no-margin"><?= $titleSection ?></div>
            </div>
            <?php if (!empty($urlLinkAll)) : ?>
                <a href="<?= $urlLinkAll ?>" class="link-all-<?= $modelLabel ?> text-uppercase flexbox align-items-center small" title="<?= $titleLinkAll ?>">
                    <span><?= $labelLinkAll ?></span>
                    <span class="am am-arrow-right"></span>
                </a>
            <?php endif ?>
        </div>
    </div>
    <div class="col-sm-4 cta-wrapper">
        <?php if (!$isGuest) : ?>
            <?php if ($isSetScope) : ?>
                <div class="flexbox manage-cta-container">
                    <?php if ($canCreate) : ?>
                        <a href="<?= $urlCreate ?>" class="cta link-my-<?= $modelLabel ?> flexbox align-items-center btn btn-xs btn-primary" title="<?= $titleCreate ?>">
                            <span class="am am-plus-circle-o"></span>
                            <span><?= $labelCreate ?></span>
                        </a>
                    <?php else : ?>
                        <?php if(!$hideCreate) : ?>
                            <button class="cta link-my-<?= $modelLabel ?> flexbox align-items-center btn btn-xs btn-primary disabled disabled-with-pointer-events" data-toggle="tooltip" title="<?= $titleScopePreventCreate ?>">
                                <span class="am am-plus-circle-o"></span>
                                <span><?= $labelCreate ?></span>
                            </button>
                        <?php endif ?>
                        
                    <?php endif ?>
                    <?php if ($canCreate && $canManage) : ?>
                        <a href="<?= $urlManage ?>" class="cta link-my-<?= $modelLabel ?> flexbox align-items-center btn btn-xs btn-outline-tertiary" title="<?= $titleManage ?>">
                            <span class="am am-settings"></span>
                            <span><?= $labelManage ?></span>
                        </a>

                        <div class="dropdown">
                            <button class="cta link-my-<?= $modelLabel ?> flexbox align-items-center btn btn-xs btn-outline-tertiary dropdown-toggle" type="button" data-toggle="dropdown">
                                <span class="am am-settings"></span>
                                <span><?= $labelManage ?></span>
                                <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <?php foreach ($manageLinks as $singleManage) : ?>
                                    <li>
                                        <a href="<?= $singleManage['url'] ?>" title="<?= $singleManage['title'] ?>"><?= $singleManage['label'] ?></a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>

                    <?php endif ?>
                </div>
            <?php else : ?>
                <div class="flexbox manage-cta-container">
                    <?php if ($canCreate) : ?>
                        <a href="<?= $urlCreate ?>" class="cta link-my-<?= $modelLabel ?> flexbox align-items-center btn btn-xs btn-primary" title="<?= $titleCreate ?>">
                            <span class="am am-plus-circle-o"></span>
                            <span><?= $labelCreate ?></span>
                        </a>
                    <?php endif ?>
                    <?php if ($canCreate && $canManage) : ?>



                        <div class="dropdown">
                            <button class="cta link-my-<?= $modelLabel ?> flexbox align-items-center btn btn-xs btn-outline-tertiary dropdown-toggle" type="button" data-toggle="dropdown">
                                <span class="am am-settings"></span>
                                <span><?= $labelManage ?></span>
                                <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <?php foreach ($manageLinks as $singleManage) : ?>
                                    <li>
                                        <a href="<?= $singleManage['url'] ?>" title="<?= $singleManage['title'] ?>"><?= $singleManage['label'] ?></a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>


                    <?php endif ?>
                </div>
            <?php endif ?>
        <?php else : ?>
            <div class="flexbox manage-cta-container">
                <a href="<?= \Yii::$app->params['linkConfigurations']['loginLinkCommon'] ?>" class="cta link-my-<?= $modelLabel ?> flexbox align-items-center btn btn-xs btn-primary disabled  disabled-with-pointer-events" data-toggle="tooltip" title="<?= $titlePreventCreate ?>">
                    <span class="am am-plus-circle-o"></span>
                    <span><?= $labelCreate ?></span>
                </a>
            </div>
        <?php endif ?>
    </div>
    <?php if (isset($subTitleSection)) : ?>
        <div class="col-xs-12 subtitle-<?= $modelLabel ?>"><?= $subTitleSection ?></div>
    <?php endif ?>
</div>