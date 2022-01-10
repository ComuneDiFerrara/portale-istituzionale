<?php

    $tags = isset($tags) ? $tags : null;

    if ( $tags ) {

        // get model list Tag
        $tags = \yii\helpers\ArrayHelper::getColumn($tags, 
                                                        function ($element){
                                                            return $element['nome'];
                                                        }
                                                    );
        
        // get list enabled Argomenti
        $argomenti = \Yii::$app->db->createCommand("SELECT i.title
                                                    FROM `cms_nav_item_page` p inner join cms_nav_item i on p.nav_item_id = i.id
                                                    WHERE `nav_id` in (SELECT id 
                                                                        FROM `cms_nav`
                                                                        WHERE `nav_container_id` = '2' and is_offline = 0)
                                                ")
                                ->queryAll();

        $argomenti = \yii\helpers\ArrayHelper::getColumn($argomenti, 
                                                        function($element){
                                                            return trim($element['title']);
                                                        }
                                                    );

        // Computes the intersection of arrays
        $tags = array_intersect($tags, $argomenti);
    }

?>

<?php if ($tags): ?>

    <h2 class="mt-3 mt-lg-0 h4"><small>Argomenti</small></h2>

    <div class="argomenti-sezione-elenco">

        <?php foreach ($tags as $key => $tag): ?>
            
            <a href="/it/<?= strtolower(str_replace(' ', '-', $tag)) ?>" class="chip chip-simple chip-primary text-decoration-none">
                <span class="chip-label"><?=$tag?></span>
            </a>

        <?php endforeach; ?>

    </div>

<?php endif;?>
