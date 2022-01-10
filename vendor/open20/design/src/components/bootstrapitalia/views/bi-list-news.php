<?php

    $widthColumn = 12 / $elementsForRow;

?>

<div class="list-news-container row variable-gutters">
    <?=
        $this->render(
        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-news',
        [
            'category' => 'ULTIME DALLA P.A.',
            'image' => 'https://picsum.photos/1600/900?random=2',
            'nameSurname' => 'Paolo Bianchi',
            'newPubblication' => true,
            'showAvatar' => true,
            'widthColumn' => 'col-lg-' . $widthColumn . ' col-md-6' . ' col-sm-12',
            //classi per la dimensione font/avatar
            'avatarWrapperSize' => 'md',

            'descriptionSize' => 'small',
            'title' =>'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'date' => '2020-12-12'

        ]
        );
    ?>
    <?=
        $this->render(
        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-news',
        [
            'category' => 'ULTIME DALLA P.A.',
            'image' => 'https://picsum.photos/1600/900?random=3',
            'nameSurname' => 'Paolo Bianchi',
            
            'showAvatar' => true,
            'widthColumn' => 'col-lg-' . $widthColumn . ' col-md-6' . ' col-sm-12',
            'avatarWrapperSize' => 'md',
            'descriptionSize' => 'small',
            'title' =>'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'date' => '2020-12-12'
            ]
        );
    ?>
    <?=
        $this->render(
        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-news',
        [
            'category' => 'ULTIME DALLA P.A.',
            'image' => 'https://picsum.photos/1600/900?random=4',
            'nameSurname' => 'Paolo Bianchi',
            'newPubblication' => true,
            'showAvatar' => true,
            'widthColumn' => 'col-lg-' . $widthColumn . ' col-md-6' . ' col-sm-12',
            'avatarWrapperSize' => 'md',
            'descriptionSize' => 'small',
            'title' =>'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'date' => '2020-12-12'
            ]
        );
    ?>
    <?=
        $this->render(
        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-news',
        [
            'category' => 'ULTIME DALLA P.A.',
            'image' => 'https://picsum.photos/1600/900?random=44',
            'nameSurname' => 'Paolo Bianchi',
            
            'showAvatar' => true,
            'widthColumn' => 'col-lg-' . $widthColumn . ' col-md-6' . ' col-sm-12',
            //classi per la dimensione font/avatar
            'avatarWrapperSize' => 'md',
            'descriptionSize' => 'small',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'title' =>'Lorem ipsum dolor sit amet',
            'date' => '2020-12-12'
            ]
        );
    ?>
    <?=
        $this->render(
        '@vendor/open20/design/src/components/bootstrapitalia/views/bi-news',
        [
            'category' => 'ULTIME DALLA P.A.',
            'image' => 'https://picsum.photos/1600/900?random=55',
            'nameSurname' => 'Paolo Bianchi',
            
            'showAvatar' => true,
            'widthColumn' => 'col-lg-' . $widthColumn . ' col-md-6' . ' col-sm-12',
            'avatarWrapperSize' => 'md',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'descriptionSize' => 'small',
            'title' =>'Lorem ipsum dolor sit amet',
            'date' => '2020-12-12'
            ]
        );
    ?>
</div>