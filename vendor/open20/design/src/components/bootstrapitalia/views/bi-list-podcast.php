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
?>

<div class="podcast-list-container col-12">
    <div class=" row flex-wrap">
        
            <?= 
                $this->render(
                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-podcast',
                        [
                            'lastEpisodeDate' => '25 Settembre 2020',
                            'podcastDescription' => 'Lorem ipsum dolor sit amet',
                            'podcastName' => 'La comunicazione green ',
                            'podcastCategory' => 'Categoria',
                            'podcastCover' => 'https://picsum.photos/1600/900?random=25',
                            
                        ]
                    );
            ?>

            <?= 
                $this->render(
                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-podcast',
                        [
                            'lastEpisodeDate' => '25 Settembre 2020',
                            
                            'podcastName' => 'io sono una stringa cortina ',
                            'podcastCategory' => 'informatica',
                            'podcastCover' => 'https://picsum.photos/1600/900?random=55',
                            
                        ]
                    );
            ?>


            <?= 
                $this->render(
                    '@vendor/open20/design/src/components/bootstrapitalia/views/bi-podcast',
                        [
                            'lastEpisodeDate' => '25 Luglio 2020',
                            'podcastDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dui eros, feugiat at scelerisque sed, ultrices eget ex.  ',
                            'podcastName' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
                            'podcastCategory' => 'innovazione',
                            'podcastCover' => 'https://picsum.photos/1600/900?random=15',
                            
                        ]
                    );
            ?>
            
        
    </div>
    
</div>