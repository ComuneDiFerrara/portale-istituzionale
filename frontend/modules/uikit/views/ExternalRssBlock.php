<?php

use frontend\modules\backendobjects\frontend\widgets\graphics\WidgetGraphicsCronacaComune;

$content_cronaca_comune = new WidgetGraphicsCronacaComune();

$number_content_items= $data['number_content_elements'];
$rss_feed_url = $data['url'];

if(is_null($number_content_items))
{
    $number_content_items = 9;
}
echo $content_cronaca_comune->renderViewWidget($number_content_items, $rss_feed_url);


?>
