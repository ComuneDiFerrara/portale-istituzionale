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
<div class="it-carousel-wrapper it-carousel-landscape-abstract-four-cols owl-carousel-preference-centre">
  <div class="it-carousel-all owl-carousel">
    <div class="it-single-slide-wrapper">
      <!--start card-->
      <?php
        echo $this->render(
          '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
          [
            'cardLabel' => 'Card Label',
            'cardIcon' => [
              'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
              'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
            ],
            'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
          ]
        );
        ?>
      <!--end card-->
    </div>
    <div class="it-single-slide-wrapper">
      <!--start card-->
      <?php
        echo $this->render(
          '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
          [
            'cardLabel' => 'Card Label',
            'cardIcon' => [
              'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
              'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
            ],
            'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
          ]
        );
        ?>
      <!--end card-->
    </div>
    <div class="it-single-slide-wrapper">
      <!--start card-->
      <?php
        echo $this->render(
          '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
          [
            'cardLabel' => 'Card Label',
            'cardIcon' => [
              'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
              'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
            ],
            'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
          ]
        );
        ?>
      <!--end card-->
    </div>
    <div class="it-single-slide-wrapper">
      <!--start card-->
      <?php
        echo $this->render(
          '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
          [
            'cardLabel' => 'Card Label',
            'cardIcon' => [
              'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
              'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
            ],
            'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
          ]
        );
        ?>
      <!--end card-->
    </div>
    <div class="it-single-slide-wrapper">
      <!--start card-->
      <?php
        echo $this->render(
          '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
          [
            'cardLabel' => 'Card Label',
            'cardIcon' => [
              'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
              'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
            ],
            'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
          ]
        );
        ?>
      <!--end card-->
    </div>
    <div class="it-single-slide-wrapper">
      <!--start card-->
      <?php
        echo $this->render(
          '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
          [
            'cardLabel' => 'Card Label',
            'cardIcon' => [
              'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
              'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
            ],
            'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
          ]
        );
        ?>
      <!--end card-->
    </div>
    <div class="it-single-slide-wrapper">
      <!--start card-->
      <?php
        echo $this->render(
          '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
          [
            'cardLabel' => 'Card Label',
            'cardIcon' => [
              'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
              'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
            ],
            'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
          ]
        );
        ?>
      <!--end card-->
    </div>
  </div>
</div>