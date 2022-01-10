<?php
$widthColumn = 12 / $elementsForRow;
?>

<div class="list-community-container container">
    <div class="row">


        <?php for ($i = 0; $i < $numberOfElements; $i++) { ?>
            <?php if ($i == 1) { ?>
                <?=
                    $this->render(
                        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-community',
                        [
                            'image' => 'https://picsum.photos/1600/900?random=' . $i,
                            'isOpenCommunity' => true,

                            'title' => 'Nome community',
                            'isSigned' => true,
                            'widthColumn' => 'col-lg-' . $widthColumn . ' col-md-6' . ' col-sm-12'
                        ]
                    );
                ?>
                <?=
                    $this->render(
                        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-community',
                        [
                            'image' => 'https://picsum.photos/1600/900?random=' . $i,
                            'isOpenCommunity' => true,

                            'title' => 'Nome community lungo lunghisssimissimo lunghisssimissimo lunghisssimissimo lunghisssimissimo ',
                            'isSigned' => true,
                            'widthColumn' => 'col-lg-' . $widthColumn . ' col-md-6' . ' col-sm-12'
                        ]
                    );
                ?>
            <?php } else { ?>
                <?=
                    $this->render(
                        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-community',
                        [
                            'image' => 'https://picsum.photos/1600/900?random=' . $i,
                            'isPrivateCommunity' => true,
                            'title' => 'Nome community',
                            'isSigned' => false,
                            'widthColumn' => 'col-lg-' . $widthColumn . ' col-md-6' . ' col-sm-12'
                        ]
                    );
                ?>
            <?php } ?>
        <?php } ?>
    </div>

</div>