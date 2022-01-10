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
if($theme=='dark'){
    $bgClass='bg-primary';
    $textColor='white';
    $textTitleColor='white';
}else{
    $bgClass='white';
    $textColor='black';
    $textTitleColor='primary';
}
?>

<div class="event-list-container <?= $bgClass ?>">
    <div class=" row flex-wrap">
        
            

            <?= 
                $this->render(
                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-podcast-puntata',
                        [
                            'podcastCover' => 'https://picsum.photos/1600/900?random=45',
                            'podcastName' => 'io sono una stringa cortina ',
                            'podcastDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dui eros, feugiat at scelerisque sed, ultrices eget ex. Nunc a tortor et eros iaculis tincidunt at hendrerit dolor. ',
                            'episodeDate' => '25 Settembre 2020',
                            'episodeDuration' => '35',
                        ]
                    );
            ?>

<?= 
                $this->render(
                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-podcast-puntata',
                        [
                            'podcastCover' => 'https://picsum.photos/1600/900?random=46',
                            'podcastName' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
                            'podcastDescription' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
                            'episodeDate' => '25 Settembre 2020',
                            
                        ]
                    );
            ?>
            
        
    </div>
    
</div>