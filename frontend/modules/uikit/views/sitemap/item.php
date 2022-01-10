<?php
   
    if($item->hasChildren)
    {
        echo "<li><a href=\"$item->link\">$item->title</a>";
        echo "<ul>";
        foreach (Yii::$app->menu->getLevelContainer($item->depth
                                + 1, $item) as $child) {
            echo $this->render('item', ['item' => $child, 'data' => $data]); 
        }
        echo "</ul>";
        echo "</li>";
        
    }else
    {
        echo "<li><a href=\"$item->link\">$item->title</a></li>";
    }
?>


