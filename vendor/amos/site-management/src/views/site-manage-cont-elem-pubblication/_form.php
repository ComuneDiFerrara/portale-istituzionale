<?php

use amos\sitemanagement\Module;
use open20\amos\core\forms\ActiveForm;
use open20\amos\core\forms\CloseSaveButtonWidget;
use open20\amos\core\forms\Tabs;

/**
 * @var yii\web\View $this
 * @var amos\sitemanagement\models\SiteManageContElemPubblication $model
 * @var yii\widgets\ActiveForm $form
 */


?>

<div class="site-manage-cont-elem-pubblication-form col-xs-12 nop">

    <?php $form = ActiveForm::begin(); ?>




    <?php $this->beginBlock('generale'); ?>

    <div class="col-lg-6 col-sm-6">

        <?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
        $form->field($model, 'container_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(amos\sitemanagement\models\SiteManagementContainer::find()->all(), 'id', 'title'),
            [
                'prompt' => Module::t('amossitemanagement', 'Select'),
                'disabled' => (isset($relAttributes) && isset($relAttributes['container_id'])),
            ]
        ); ?>
    </div>

    <div class="col-lg-6 col-sm-6">

        <?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
        $form->field($model, 'container_elem_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(amos\sitemanagement\models\SiteManagementContainerElem::find()->all(), 'id', 'title'),
            [
                'prompt' => Module::t('amossitemanagement', 'Select'),
                'disabled' => (isset($relAttributes) && isset($relAttributes['container_elem_id'])),
            ]
        ); ?>
    </div>

    <div class="col-lg-6 col-sm-6">

        <?= $form->field($model, 'pubblication_type_id')->textInput() ?>
    </div>

    <div class="col-lg-6 col-sm-6">

        <?= $form->field($model, 'start_date')->textInput() ?>
    </div>

    <div class="col-lg-6 col-sm-6">

        <?= $form->field($model, 'end_date')->textInput() ?>
    </div>

    <div class="col-lg-6 col-sm-6">

        <?= $form->field($model, 'start_time')->textInput() ?>
    </div>

    <div class="col-lg-6 col-sm-6">

        <?= $form->field($model, 'end_time')->textInput() ?>
    </div>
    <div class="clearfix"></div>
    <?php $this->endBlock('generale'); ?>

    <?php $itemsTab[] = [
        'label' => Module::t('amossitemanagement', 'generale'),
        'content' => $this->blocks['generale'],
    ];
    ?>

    <?= Tabs::widget(
        [
            'encodeLabels' => false,
            'items' => $itemsTab
        ]
    );
    ?>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>
