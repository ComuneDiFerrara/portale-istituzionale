<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    [NAMESPACE_HERE]
 * @category   CategoryName
 */

use open20\design\assets\BootstrapItaliaDesignAsset;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
if ($theme == 'dark') {
    $bgClass = 'bg-primary';
    $textColor = 'white';
    $textTitleColor = 'white';
} else {
    $bgClass = 'white';
    $textColor = 'black';
    $textTitleColor = 'primary';
}
?>

<div class="event-list-container">
    <div class=" row flex-wrap">

        <?=
            $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-event-item',
                [
                    'dateHourStart' => '2012-12-12 12:00:00',
                    'dateHourEnd' => '2012-12-13 15:00:00',
                    'title' => 'La comunicazione green ai tempi del covid',
                    'type' => 'Tipo evento',
                    'newPubblication' => true,
                ]
            );
        ?>

        <?=
            $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-event-item',
                [
                    'dateHourStart' => '2012-12-12 12:00:00',
                    'dateHourEnd' => '2012-12-12 15:00:00',
                    'title' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
                    'type' => 'Tipo evento',
                    'isPaid' => false,
                    'availableSeats' => '48',
                    'newPubblication' => true,
                ]
            );
        ?>

        <?=
            $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-event-item',
                [
                    'dateHourStart' => '2012-12-12 12:00:00',
                    'title' => 'io sono una stringa da pochi caratteri',
                    'type' => 'Tipo evento',
                    'isPaid' => true,
                    'availableSeats' => '48',
                ]
            );
        ?>


    </div>

</div>