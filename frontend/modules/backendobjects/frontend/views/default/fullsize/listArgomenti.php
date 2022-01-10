<?php

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
?>

<?php
$modelLabel = 'argomenti'; //strtolower($model->getGrammar()->getModelLabel());

use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$cssClass             = 'uk-container';
?>
<h2 id="ancora-argomenti" class="mb-5 h3 anchor-offset">Tutti gli argomenti</h2>

<div class="modulo-backend-<?= $modelLabel ?> <?= $cssClass ?>">

    <div class="card-<?= $modelLabel ?>-container">

        <?php
        $query                = $dataProvider->query;
        $result               = \Yii::$app->db->createCommand("SELECT i.title
FROM `cms_nav_item_page` p inner join cms_nav_item i on p.nav_item_id = i.id
WHERE `nav_id` in (SELECT id
FROM `cms_nav`
WHERE `nav_container_id` = '2' and is_offline = 0)")->queryAll();
        if (!empty($result)) {
            $subQuery = array_values(\yii\helpers\ArrayHelper::map($result, 'title', 'title'));
            $query    = $query->andWhere(['nome' => $subQuery]);
        }
        $dataProvider->query = $query;
        if(!is_null($dataProvider->pagination))
        {
            $dataProvider->pagination->route = \Yii::$app->request->url;
        }
            
        ?>


        <?php
        if ($dataProvider->getTotalCount() > 0) {
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_itemCardArgomenti',
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
                    'class' => 'list-view w-100 d-flex flex-wrap anchor-offset',
                    //'id' => 'ancora-argomenti'
                ]
            ]);
        } else {
            ?>
            <div class="no-result">
                <p >Non sono presenti contenuti</p>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    var elToAppendAnchor = document.getElementsByClassName("pagination")[0].getElementsByTagName("LI");
    for ($i = 0; $i < elToAppendAnchor.length; $i++) {
        if (elToAppendAnchor[$i].getElementsByTagName("a")[0]) {
            var linkToChange = elToAppendAnchor[$i].getElementsByTagName("a")[0];
            var oldHref = linkToChange.getAttribute("href");
            var newHref = oldHref + '#ancora-argomenti';
            linkToChange.setAttribute('href', newHref);
        }
    }
</script>