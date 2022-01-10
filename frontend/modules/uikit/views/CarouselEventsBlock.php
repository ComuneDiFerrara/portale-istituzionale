<?php

$carousel_events = new open20\amos\events\widgets\graphics\WidgetGraphicsCarouselEvents();

$number_of_events = null;
$current_mounth  = true;
echo $carousel_events ->getHtml($number_of_events);

?>
