<?php

use open20\design\assets\BootstrapItaliaDesignAsset;
use open20\design\assets\PrismJSAsset;
use open20\design\components\bootstrapitalia\CheckBoxListTopicsIcon;
use open20\design\components\bootstrapitalia\CheckBoxListTags;

$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);
$PrismJSAsset = PrismJSAsset::register($this);
?>

<style>
  h2[id]:before {
    content: "";
    display: block;
    height: 120px;
    margin: -120px 0 0;
  }

  h3[id]:before {
    content: "";
    display: block;
    height: 120px;
    margin: -120px 0 0;
  }

  .square {
    width: 100px;
    height: 100px;
  }
</style>

<?php
$date = new DateTime();
$date = $date->format('php:d/m/Y');
?>


<?php
echo $this->render('parts/devs-tools');
?>

<div class="container-fluid mt-5">
  <div class="row justify-content-between">
    <div id="jsMenu" class="col-lg-3" style="position: sticky; top: 6rem; height: calc(100vh - 6rem); overflow-y: auto;">
      <nav class="inline-menu">
        <div class="link-list-wrapper">
          <ul class="link-list">
            <li><a class="list-item large medium right-icon" href="<?= Yii::$app->params['platform']['frontendUrl'] ?>/design/design-base/configurations" target="_blank"><span>Configurazioni</span><svg class="icon icon-sm icon-primary">
                  <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-external-link"></use>
                </svg></a>

            </li>
            <li>
              <a class="list-item large medium" href="#colori"><span>Colori</span></a>
            </li>
            <li><a class="list-item large medium right-icon" href="#collapseOne" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne"><span>Componenti</span><svg class="icon icon-xs icon-primary right">
                  <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-expand"></use>
                </svg></a>
              <ul class="link-sublist collapse " id="collapseOne">

                <li>
                  <a class="list-item" href="#avatar"><span>Avatar</span></a>
                </li>

                <li>
                  <a class="list-item" href="#avatar-sovrapposti"><span>Avatar sovrapposti</span></a>
                </li>

                <li>
                  <a class="list-item" href="#bottoni"><span>Bottoni</span></a>
                </li>

                <li>
                  <a class="list-item" href="#card-preference"><span>Cards Preference</span></a>
                </li>

                <li>
                  <a class="list-item" href="#carousel"><span>Carousel</span></a>
                </li>

                <li>
                  <a class="list-item" href="#carousel-news"><span>Carousel news</span></a>
                </li>

                <li>
                  <a class="list-item" href="#photogallery"><span>Gallery immagini</span></a>
                </li>

                <li>
                  <a class="list-item" href="#calendar-carousel"><span>Carousel calendario</span></a>
                </li>

                <li>
                  <a class="list-item" href="#card-checkbox"><span>Checkbox Cards Preference</span></a>
                </li>

                <li>
                  <a class="list-item" href="#Checkbox-link"><span>Checkbox con link alla privacy</span></a>
                </li>

                <li>
                  <a class="list-item" href="#checkbox-collapse"><span>Checkbox collapse</span></a>
                </li>

                <li>
                  <a class="list-item" href="#collapse"><span>Collapse</span></a>
                </li>

                <li>
                  <a class="list-item" href="#Community"><span>Community</span></a>
                </li>


                <li>
                  <a class="list-item" href="#discussioni"><span>Discussioni</span></a>
                </li>
                <li>
                  <a class="list-item" href="#discussioni-card"><span>Discussioni card</span></a>
                </li>

                <li>
                  <a class="list-item" href="#documents-card"><span>Documenti card</span></a>
                </li>
                <li>
                  <a class="list-item" href="#document-list"><span>Documenti lista</span></a>
                </li>

                <li>
                  <a class="list-item" href="#events"><span>Eventi</span></a>
                </li>

                <li>
                  <a class="list-item" href="#list-avatar"><span>Lista di avatar</span></a>
                </li>
                <li>
                  <a class="list-item" href="#view-list-avatar"><span>Lista utenti</span></a>
                </li>
                <li>
                  <a class="list-item" href="#Community-list"><span>Lista di community</span></a>
                </li>

                <li>
                  <a class="list-item" href="#events-list"><span>Lista eventi</span></a>
                </li>

                <li>
                  <a class="list-item" href="#news-list"><span>Lista News card</span></a>
                </li>
                <li>
                  <a class="list-item" href="#news-list-item"><span>Listato News</span></a>
                </li>
                <li>
                  <a class="list-item" href="#organization-list"><span>Lista organizzazioni</span></a>
                </li>

                <li>
                  <a class="list-item" href="#podcast-list"><span>Lista podcast</span></a>
                </li>

                <li>
                  <a class="list-item" href="#podcast-puntate-list"><span>Lista puntate podcast</span></a>
                </li>

                <li>
                  <a class="list-item" href="#modal"><span>Modali</span></a>
                </li>

                <li>
                  <a class="list-item" href="#modal-preference"><span>Modali preferenze</span></a>
                </li>

                <li>
                  <a class="list-item" href="#news"><span>News</span></a>
                </li>

                <li>
                  <a class="list-item" href="#organization"><span>Organizzazioni</span></a>
                </li>

                <li>
                  <a class="list-item" href="#events-scope"><span>Scope eventi</span></a>
                </li>

                <li>
                  <a class="list-item" href="#scope-organizzazioni"><span>Scope organizzazioni</span></a>
                </li>

                <li>
                  <a class="list-item" href="#back-button"><span>Torna indietro</span></a>
                </li>

                <li>
                  <a class="list-item" href="#wizard"><span>Wizard Steps</span></a>
                </li>
              </ul>
            </li>

            <li><a class="list-item large medium right-icon" href="#collapseTwo" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo"><span>Form</span><svg class="icon icon-xs icon-primary right">
                  <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-expand"></use>
                </svg></a>
              <ul class="link-sublist collapse" id="collapseTwo">

                <li><a class="list-item" href="#formExample"><span>Singoli componenti</span></a>
                </li>
                <li><a class="list-item" href="#vari-input"><span>Vari input</span></a>
                </li>
                <li><a class="list-item" href="#form-rounded"><span>Stile rounded</span></a>
                </li>
                <li><a class="list-item" href="#toggle"><span>Toggles</span></a>
                </li>
              </ul>
            </li>
            <li>
              <a class="list-item large medium right-icon" href="#icone"><span>Icone</span></a>
            </li>
            <li><a class="list-item large medium right-icon" href="https://italia.github.io/bootstrap-italia/docs/come-iniziare/introduzione/" target="_blank"><span>Sito Bootstrap Italia</span><svg class="icon icon-sm icon-primary">
                  <use xlink:href="<?= $bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-external-link"></use>
                </svg></a>

            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div id="jsMain" class="col-lg-9 px-5">

      <h1 class="no_toc">Componenti Bootstrap Italia Custom</h1>
      <p class="lead mb-0">Componenti personalizzati per plugin Design</p>

      <!--colori-->
      <section class="py-5 border-bottom">
        <h2 id="colori">Colori</h2>
        <p>Colori usati nella piattaforma</p>
        <p><strong class="h3">Brandbook colors:</strong></p>
        <div class="row mb-4">
          <div class="col-md-3 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 brandbook-theme-bg-brandbook-primary">#2a7a38</div>
            <span>$brandbook-primary</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 brandbook-theme-bg-brandbook-secondary">#003354</div>
            <span>$brandboook-secondary</span>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-3 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 brandbook-theme-bg-brandbook-neutral-1">#e6e9f2</div>
            <span>$brandbook-neutral-1</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 border brandbook-theme-bg-brandbook-neutral-2">#fcfcff</div>
            <span>$brandbook-neutral-2</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 brandbook-theme-bg-brandbook-neutral-3">#003354</div>
            <span>$brandbook-neutral-3</span>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-3 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 brandbook-theme-bg-brandbook-triadic-2">#008758</div>
            <span>$brandbook-triadic-2</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 brandbook-theme-bg-brandbook-triadic-1">#a66300</div>
            <span>$brandbook-triadic-1</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 brandbook-theme-bg-brandbook-triadic-3">#d92828</div>
            <span>$brandbook-triadic-3</span>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-3 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 brandbook-theme-bg-brandbook-btn-primary">#2a7a38</div>
            <span>$brandbook-btn-primary</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square border p-3 brandbook-theme-bg-brandbook-btn-secondary">#ffffff</div>
            <span>$brandbook-btn-secondary</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 brandbook-theme-bg-brandbook-btn-tertiary">#5E7887</div>
            <span>$brandbook-btn-tertiary</span>
          </div>
        </div>
        <hr>
        <p><strong class="h3">Theme colors:</strong></p>
        <div class="row mb-4">
          <div class="col-md-3 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-primary">#2a7a38</div>
            <span>$primary</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-secondary">#5E7887</div>
            <span>$secondary</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-tertiary">#003354</div>
            <span>$tertiary</span>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-3 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-success">#008758</div>
            <span>$green-accessible</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-warning">#a66300</div>
            <span>$orange-accessible</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-danger">#d92828</div>
            <span>$red-accessible</span>
          </div>
        </div>
        <hr>
        <p><strong class="h3">Social colors:</strong></p>
        <div class="row mb-4">
          <div class="col-md-2 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-linkedin">#0177b5</div>
            <span>$linkedin</span>
          </div>
          <div class="col-md-2 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-facebook">#4867aa</div>
            <span>$facebook</span>
          </div>
          <div class="col-md-2 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-google">#ea4335</div>
            <span>$google</span>
          </div>
          <div class="col-md-2 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-twitter">#32ccfe</div>
            <span>$twitter</span>
          </div>
          <div class="col-md-2 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-youtube">#be1b1e</div>
            <span>$youtube</span>
          </div>
          <div class="col-md-2 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-spid">#0066cc</div>
            <span>$spid</span>
          </div>
        </div>
        <hr>
        <p><strong class="h3">Components colors:</strong></p>
        <div class="row mb-4">
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-card-preference-bg">#eaf1eb</div>
            <span>$card-preference-bg</span>
          </div>
          <div class="col-md-3 mt-4 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-tooltip-bg">#5e7887</div>
            <span>$tooltip-bg</span>
          </div>
        </div>
        <hr>
        <p><strong class="h3">Text colors:</strong></p>
        <div class="row mb-4">
          <div class="col-md-3 d-flex flex-column align-items-md-start align-items-center">
            <div class="square p-3 design-theme-bg-text-muted">#435960</div>
            <span>$text-muted-custom</span>
          </div>
        </div>
      </section>

      <section class="py-5 border-bottom">
        <div>
          <!-- BUTTONS -->
          <h2 id="bottoni" class="pb-2">Bottoni</h2>
          <div class="mb-3">
            <button type="button" class="btn btn-primary">Primary</button>
            <button type="button" class="btn btn-outline-primary">Primary outline</button>
            <button type="button" class="btn btn-secondary">Secondary</button>
            <button type="button" class="btn btn-outline-secondary">Secondary outline</button>
            <button type="button" class="btn btn-tertiary">Tertiary</button>
            <button type="button" class="btn btn-outline-tertiary">Tertiary outline</button>
            <button type="button" class="btn btn-primary disabled">Button disabled</button>
            <button type="button" class="btn btn-link">Link</button>
          </div>

        </div>
      </section>

      <section class="py-5 border-bottom">
        <div>
          <h2 id="modal" class="pb-2">Modali</h2>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Bottone per modale generica
          </button>

          <?php
          echo $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/modal_validation'
          );
          ?>
        </div>
      </section>

      <section class="py-5 border-bottom">
        <div>
          <h2 id="modal-preference" class="pb-2">Modali preferenze</h2>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#preferenceActivationSuccessModal">
            Modale preferenza attivata
          </button>

          <?php
          echo $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/modal_activation_success'
          );
          ?>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#preferenceActivationFailedModal">
            Modale preferenza non attivata
          </button>

          <?php
          echo $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/modal_activation_failed'
          );
          ?>
        </div>
      </section>

      <!--torna indietro-->
      <section class="py-5 border-bottom">
        <h2 id="back-button">Torna Indietro</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-back-button'
          );
        ?>
      </section>


      <!-- CARD PREFERENCE -->
      <section class="py-5 border-bottom">

        <h2 id="card-preference" class="pb-2">Cards Preference</h2>

        <div class="row align-items-end">
          <div class=" d-flex flex-column col-md-6 px-3">
            <div>
              <h3 id="card-preference-default">Card di default</h3>
            </div>

            <?php
            echo $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
              [
                'cardIcon' => [
                  'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
                  'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
                ],
                'cardLabel' => 'Card Label',
                'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
              ]
            );
            ?>

          </div>
          <div class=" d-flex flex-column col-md-6 px-3">
            <div>
              <h3 id="card-preference-actve">Card attiva <br> param 'isActive'=> true</h3>
            </div>
            <div>
              <?php
              echo $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
                [
                  'cardIcon' => [
                    'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
                    'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
                  ],
                  'cardLabel' => 'Card Label',
                  'isActive' => true,
                  'cardId' => 'idProva',
                  'baseId' => 'prima-parte-per-',
                  'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
                ]
              );
              ?>
            </div>
          </div>
          <div class=" d-flex flex-column col-md-6 px-3">
            <div>
              <h3 id="card-preference-disabled">Card disattiva <br> param 'isActionDisabled' => true</h3>
            </div>
            <div>
              <?php
              echo $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
                [
                  'isActionDisabled' => true,
                  'cardLabel' => 'Card Label',
                  'cardIcon' => [
                    'baseIconUrl' => $bootstrapItaliaAsset->baseUrl,
                    'iconUrl' => '/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-telephone',
                  ],
                  'cardDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'
                ]
              );
              ?>
            </div>
          </div>
          <div class=" d-flex flex-column col-md-6 px-3">
            <div>
              <h3 id="card-preference-empty">Card Vuota <br> param 'emptyCard[]'</h3>
              <p>emptyCard['emptyTitleMessage']: Titolo messaggio card vuota</p>
              <p>emptyCard['emptyMessage']: Messaggio card vuota</p>
            </div>
            <div>
              <?php
              echo $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/card_preference',
                [
                  'emptyCard' => [
                    'emptyTitleMessage' => 'Titolo messaggio card vuota',
                    'emptyMessage' => 'Messaggio card vuota:<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                  ]
                ]
              );
              ?>
            </div>
          </div>
        </div>

      </section>

      <!--Checkbox Cards Preference-->
      <section class="py-5 border-bottom">
        <div>
          <h2 id="card-checkbox" class="pb-2">Checkbox Cards Preference</h2>

          <?php

          echo CheckBoxListTopicsIcon::widget([
            'model' => $model,
            'attribute' => 'attribute',
            'choices' => $choices,
            'classContainer' => 'col-lg-3 col-md-6',

          ]);

          ?>
        </div>
      </section>

      <section class="py-5 border-bottom">
        <div>
          <h2 id="card-checkbox" class="pb-2">Checkbox Tags List </h2>
          <h4>Size sm</h4>
          <div class="d-flex flex-wrap">
            <?php

            echo CheckBoxListTags::widget([
              'model' => $model,
              'attribute' => 'attribute',
              'choices' => $tags,
              'tagWrapperSize' => 'sm',

            ]);


            ?>
          </div>
          <h4>Size md</h4>
          <div class="d-flex flex-wrap">
            <?php

            echo CheckBoxListTags::widget([
              'model' => $model,
              'attribute' => 'attribute',
              'choices' => $tags,
              'tagWrapperSize' => 'md',

            ]);


            ?>
          </div>
        </div>
      </section>

      <section class="py-5 border-bottom">
        <div>
          <h2 id="carousel" class="pb-2">Carousel</h2>
        </div>
        <div>
          <?php
          echo $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/carousel'
          );
          ?>
        </div>
      </section>


      <section class="py-5 border-bottom">
        <div>
          <h2 id="wizard" class="pb-2">Wizard steps </h2>
        </div>

        <div class=" py-5">
          <div class="container">



            <?php
            echo $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/wizard_steps'
            );
            ?>



          </div>
        </div>
      </section>




      <section class="py-5 border-bottom">
        <div>

          <h2 id="collapse" class="pb-2">Collapse</h2>
          <?php
          echo $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/collapse-preference'
          );
          ?>

        </div>
      </section>

      <section class="py-5 border-bottom">
        <div>

          <h2 id="checkbox-collapse">Checkbox collapse</h2>
          <?php
          echo $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/form-checkbox-collapse-preference'
          );
          ?>
        </div>
      </section>

      <!--checkbox link privacy-->
      <section class="py-5 border-bottom">
        <h2 id="Checkbox-link">Checkbox con link privacy</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/check-with-link',
            [
              'externalLink' => false,
              'linkText' => 'link esterno alla privacy',
              'privacyLink' => '/preferenceuser/contacts/contacts',
              'target' => '_blank',
            ]
          );
        ?>
      </section>

      <!--news-->
      <section class="py-5 border-bottom">
        <h2 id="news">News</h2>

        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-news',
            [
              'category' => 'ULTIME DALLA P.A.',
              'image' => 'https://picsum.photos/1600/900?random=6',
              'nameSurname' => 'Paolo Bianchi',
              'showAvatar' => true,
              'newPubblication' => true,
              'avatarWrapperSize' => 'lg',
              'categorySize' => 'lead',
              'titleSize' => 'h3',
              'descriptionSize' => 'lead',
              'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit…',
              'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
              'date' => '2020-12-12'
            ]
          );
        ?>
      </section>

      <!--lista news-->
      <section class="py-5 border-bottom">
        <h2 id="news-list">Lista News card</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-news',
            [
              'elementsForRow' => '3'
            ]
          );
        ?>
      </section>

      <section class="py-5 border-bottom">
        <h2 id="news-list-item">Listato News</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-news-item-list',
            [
              'category' => 'ULTIME DALLA P.A.',
              'image' => 'https://picsum.photos/1600/900?random=21',
              'nameSurname' => 'Paolo Bianchi',
              'showSignature' => true,
              'newPubblication' => true,
              'titleSize' => 'h5',
              'title' => 'Lorem ipsum dolor sit amet',
              'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
              'date' => '2020-12-12'

            ]
          );
        ?>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-news-item-list',
            [
              'category' => 'ULTIME DALLA P.A.',
              'image' => 'https://picsum.photos/1600/900?random=22',
              'nameSurname' => 'Paolo Bianchi',
              'showSignature' => true,
              'titleSize' => 'h5',
              'title' => 'Lorem ipsum dolor sit amet',
              'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
              'date' => '2020-12-12'

            ]
          );
        ?>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-news-item-list',
            [
              'category' => 'ULTIME DALLA P.A.',
              'image' => 'https://picsum.photos/1600/900?random=2',
              'nameSurname' => 'Paolo Bianchi',
              'showSignature' => true,
              'newPubblication' => true,
              'titleSize' => 'h5',
              'title' => 'Io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
              'description' => 'Io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare or incididunt ut laboree',
              'date' => '2020-12-12'

            ]
          );
        ?>
      </section>

      <!--Carousel News-->
      <section class="py-5 border-bottom">
        <h2 id="news-list-item">Listato News</h2>
        <?php
          echo $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/carousel-news'
          );
        ?>
      </section>       

      <!--carousel immagini-->
      <div class="py-5"> 
        <h2 id="photogallery">Listato News</h2>
            <?php
            echo $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-photogallery-carousel',[
                  
              ]
            );
            ?>

            
        </div>

      <!--Organizzazioni-->
      <section class="py-5 border-bottom">
        <h2 id="organization">Organizzazioni</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-organizzazioni',
            [
              'imageOrganizzatore' => 'https://picsum.photos/1600/900?random=4',
              'organizzatore' => 'Pesce Azzurro Cefalù',
              'removeLink' => true,
              'showCtaEsplora' => true,
              'showIcon' => true,
            ]
          );
        ?>
      </section>

      <!--lista organizzazioni-->
      <section class="py-5 ">
        <h2 id="organization-list">Lista di organizzazioni</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-organizzazioni',
            [
              'elementsForRow' => '3',
            ]
          );
        ?>
      </section>

      <!--Scope organizzazioni-->
      <section class="py-5 ">
        <h2 id="scope-organizzazioni">Scope organizzazioni</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-scope-organizzazioni',
            [
              'espositoreImage' => 'https://picsum.photos/1600/900?random=10',
              'espositoreTitle' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
              'espositoreSito' => 'www.dragoconserve.it',
              'espositorePIva' => '012345678912',
              'espositoreReferente' => 'Giuliano Bianco',
              'espositoreIndirizzo' => 'Via Stentiello 10/a Siracusa',
              'espositoreEmail' => 'info@dragoconserve.it',
              'espositoreTelefono' => '090 1234567',
            ]
          );
        ?>
      </section>

      <!--avatar-->
      <section class="py-5 border-bottom">
        <h2 id="avatar">Avatar</h2>
        <div class="row align-items-center">
          <div class="col-md-4 mb-4">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
                [
                  'nameSurname' => 'Paolo Bianchi',
                  'avatarWrapperSize' => 'xl'
                ]
              );
            ?>
          </div>
          <div class="col-md-4 mb-4">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
                [
                  'nameSurname' => 'Paolo Bianchi',
                  'avatarWrapperSize' => 'lg'
                ]
              );
            ?>
          </div>
          <div class="col-md-4 mb-4">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
                [
                  'nameSurname' => 'Paolo Bianchi',
                  'avatarWrapperSize' => 'md'
                ]
              );
            ?>
          </div>
          <div class="col-md-4 mb-4">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
                [
                  'nameSurname' => 'Paolo Bianchi',
                  'avatarWrapperSize' => 'sm'
                ]
              );
            ?>
          </div>
          <div class="col-md-4 mb-4">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar',
                [
                  'nameSurname' => 'Paolo Bianchi',
                  'avatarWrapperSize' => 'xs'
                ]
              );
            ?>
          </div>
        </div>
      </section>

      <!--lista avatar-->
      <section class="py-5 ">
        <h2 id="list-avatar">Lista di avatar card</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-avatar',
            [
              'avatarWrapperSize' => 'xl',
              'elementsForRow' => '3',
            ]
          );
        ?>
      </section>
      <!--lista avatar-->
      <section class="py-5 ">
        <h2 id="view-list-avatar">Listato utenti</h2>

        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-avatar-user',
            [
              'nameSurname' => 'Paolo Bianchi',
              'avatarWrapperSize' => 'md',
              'url' => '#',
              'additionalInfo' => 'Programmatore',
              'collaborazionePrevalente' => 'Unità di Ricerca INSTM presso Dipartimento di Scienza dei Materiali - Univ- Milano Bicocca',
              'facilitatore' => 'Redazione Open Innovation',
              'statoProfilo' => 'Validato',
              'showCtaMsg' => 'true',
              'ctaMsg' => 'Collegati',
            ]
          );
        ?>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-avatar-user',
            [
              'nameSurname' => 'Michelito La Fresca',
              'avatarWrapperSize' => 'md',
              'url' => '#',
              'additionalInfo' => 'Web Designer',
              'collaborazionePrevalente' => 'Elite Division srl',
              'facilitatore' => 'Marco Bianchi',
              'statoProfilo' => 'Modifica in corso',
              'showCtaMsg' => 'true',
              'ctaMsg' => 'Collegati',
            ]
          );
        ?>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-avatar-user',
            [
              'nameSurname' => 'Luca Lodiato',
              'avatarWrapperSize' => 'md',
              'url' => '#',
              'additionalInfo' => 'Presidentissimo',
              'collaborazionePrevalente' => 'Mads srl',
              'facilitatore' => 'Angelo Rocchi',
              'statoProfilo' => 'Non validato',
              'showCtaJoin' => 'true',
              'ctaJoinMsg' => 'Invia messaggio',
            ]
          );
        ?>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-avatar-user',
            [
              'nameSurname' => 'Marcello Aiello',
              'avatarWrapperSize' => 'md',
              'url' => '#',
              'additionalInfo' => 'maestro',
              'collaborazionePrevalente' => 'Divita snc',
              'facilitatore' => 'Andrea Fiori',
              'statoProfilo' => 'Da validare',
              'showCtaJoin' => 'true',
              'ctaJoinMsg' => 'Invia messaggio',
            ]
          );
        ?>

      </section>

      <!--lista avatar sovrapposti-->
      <section class="py-5 border-bottom">
        <h2 id="avatar-sovrapposti">Avatar sovrapposti</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-avatar-group-stacked',
            [

              'numberExpose' => 5,
              'usersNumber' => 7
            ]

          );
        ?>
      </section>

      <!--discussioni-->
      <section class="py-5 border-bottom">
        <h2 id="discussioni">Discussioni listato</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-discussions',
            [
              'title' => 'Io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
              'date' => '2020-12-12',
              'url' => '#',
              'numbersOfAnswer' => '3',
              'numbersOfVisits' => '4',
              'updatedAt' => '2012-12-12',
              'newPubblication' => true,

            ]
          );
        ?>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-discussions',
            [
              'title' => 'Discussione Planner',
              'communityTitle' => 'Planner 2.0 ma con nome più lungo',
              'date' => '2020-12-12',
              'url' => '#',
              'numbersOfAnswer' => '3',
              'numbersOfVisits' => '4',
              'updatedAt' => '2012-12-12',
              'newPubblication' => true,
            ]
          );
        ?>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-discussions',
            [
              'title' => 'Discussione Planner',
              'communityTitle' => 'Planner 2.0 ma con nome più lungo',
              'date' => '2020-12-12',
              'url' => '#',
              'numbersOfAnswer' => '3',
              'numbersOfVisits' => '4',
              'updatedAt' => '2012-12-12',

            ]
          );
        ?>
      </section>

      <section class="py-5 border-bottom">
        <h2 id="discussioni-card" class="mb-5">Discussioni card</h2>

        <div class="row variable-gutters">
          <div class="col-md-6">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-discussions-card',
                [
                  'title' => 'Io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
                  'communityTitle' => 'Planner 2.0',
                  'date' => '2020-12-12',
                  'url' => '#',
                  'numbersOfAnswer' => '3',
                  'numbersOfVisits' => '4',
                  'updatedAt' => '2012-12-12',
                  'image' => 'https://picsum.photos/1600/900?random=5',
                  'nameSurname' => 'Paolo Bianchi',
                  'newPubblication' => true,
                  'avatarWrapperSize' => 'md',
                  'description' => 'La perdita di biodiversità e il commercio delle specie selvatiche sono le cause della pandemia.',
                  'nameSurnameLastComment' => 'Marco Giusti',
                  'lastCommentDiscussion' => 'Ciao, mi sembra un ottimo spunto, in Commissione stiamo già lavorando da qualche mese ad una proposta per le imprese green, vi terremo aggiornati.',

                ]
              );
            ?>
          </div>
          <div class="col-md-6">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-discussions-card',
                [
                  'title' => 'Discussione Planner',
                  'date' => '2020-12-12',
                  'url' => '#',
                  'numbersOfAnswer' => '3',
                  'numbersOfVisits' => '4',
                  'updatedAt' => '2012-12-12',
                  'image' => 'https://picsum.photos/1600/900?random=4',
                  'nameSurname' => 'Paolo Bianchi',
                  'newPubblication' => true,
                  'avatarWrapperSize' => 'md',
                  'description' => 'La perdita di biodiversità e il commercio delle specie selvatiche sono le cause della pandemia.
              Il rischio che le malattie siano trasmesse all’uomo è in crescita come risultato dell’avanzamento della distruzione di habitat prima intatti e della crescita del commercio (spesso illegale) di specie selvatiche.
              Quali lezioni impariamo dalla crisi avviata dal Coronavirus per una nuova strategia a favore della biodiversità e per la riduzione del diffondersi delle epidemie?'



                ]
              );
            ?>
          </div>
          <div class="col-md-6">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-discussions-card',
                [
                  'title' => 'Discussione con nome un pò più lungo e complesso',
                  'communityTitle' => 'Planner 2.0 ma con nome più lungo',
                  'date' => '2020-12-12',
                  'url' => '#',
                  'numbersOfAnswer' => '3',
                  'numbersOfVisits' => '4',
                  'updatedAt' => '2012-12-12',
                  'image' => 'https://picsum.photos/1600/900?random=3',
                  'nameSurname' => 'Paolo Bianchi',
                  'avatarWrapperSize' => 'md',

                  'nameSurnameLastComment' => 'Giorgio Mariano',
                  'lastCommentDiscussion' => 'Wow! Mi sembra un ottimo spunto, in Commissione stiamo già lavorando da qualche mese ad una proposta per le imprese green, vi terremo aggiornati.',
                  'description' => 'La perdita di biodiversità e il commercio delle specie selvatiche sono le cause della pandemia.
              Il rischio che le malattie siano trasmesse all’uomo è in crescita come risultato dell’avanzamento della distruzione di habitat prima intatti e della crescita del commercio (spesso illegale) di specie selvatiche.
              Quali lezioni impariamo dalla crisi avviata dal Coronavirus per una nuova strategia a favore della biodiversità e per la riduzione del diffondersi delle epidemie?'

                ]
              );
            ?>
          </div>
          <div class="col-md-6">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-discussions-card',
                [
                  'title' => 'Discussione Planner',
                  'communityTitle' => 'Planner 2.0 ma con nome più lungo',
                  'date' => '2020-12-12',
                  'url' => '#',
                  'numbersOfAnswer' => '3',
                  'numbersOfVisits' => '4',
                  'updatedAt' => '2012-12-12',
                  'image' => 'https://picsum.photos/1600/900?random=2',
                  'nameSurname' => 'Paolo Bianchi',

                  'newPubblication' => true,
                  'avatarWrapperSize' => 'md',

                  'nameSurnameLastComment' => 'Luisa Recca',
                  'lastCommentDiscussion' => 'Grande! Mi sembra un ottimo spunto, in Commissione stiamo già lavorando da qualche mese ad una proposta per le imprese green, vi terremo aggiornati.',
                  'description' => 'Sono una descrizione... obbligatoria?'

                ]
              );
            ?>
          </div>
          <div class="col-md-6">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-discussions-card',
                [
                  'title' => 'Discussione Planner',
                  'communityTitle' => 'Planner 2.0',
                  'date' => '2020-12-12',
                  'url' => '#',
                  'numbersOfAnswer' => '3',
                  'numbersOfVisits' => '4',
                  'updatedAt' => '2012-12-12',
                  'image' => 'https://picsum.photos/1600/900?random=1',
                  'nameSurname' => 'Paolo Bianchi',

                  'newPubblication' => true,
                  'avatarWrapperSize' => 'md',

                  'nameSurnameLastComment' => 'Mario Franchi',
                  'lastCommentDiscussion' => 'Esatto! Mi sembra un ottimo spunto, in Commissione stiamo già lavorando da qualche mese ad una proposta per le imprese green, vi terremo aggiornati.',
                  'description' => 'La perdita di biodiversità e il commercio delle specie selvatiche sono le cause della pandemia.
              Il rischio che le malattie siano trasmesse all’uomo è in crescita come risultato dell’avanzamento della distruzione di habitat prima intatti e della crescita del commercio (spesso illegale) di specie selvatiche.
              Quali lezioni impariamo dalla crisi avviata dal Coronavirus per una nuova strategia a favore della biodiversità e per la riduzione del diffondersi delle epidemie?'

                ]
              );
            ?>
          </div>
        </div>

      </section>
      <!--community-->
      <section class="py-5 border-bottom">
        <h2 id="Community">Community</h2>

        <div class="row mt-4">
          <div class="col-md-4">
            <h3>Community Aperta</h3>
            <h3>isOpenCommunity => true</h3>
            <?php
            echo $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-community',
              [
                'image' => 'https://picsum.photos/800/450?random=1',
                'title' => 'Chiacchere',
                'isOpenCommunity' => true,
                'isSigned' => true,
              ]
            );
            ?>
          </div>
          <div class="col-md-4">
            <h3>Community Riservata</h3>
            <h3>isReservedCommunity => true</h3>
            <?php
            echo $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-community',
              [
                'image' => 'https://picsum.photos/1600/900?random=2',
                'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laborea',
                'isReservedCommunity' => true,
                'isSigned' => true,

              ]
            );
            ?>
          </div>
          <div class="col-md-4">
            <h3>Community Privata</h3>
            <h3>isPrivateCommunity => true</h3>
            <?php
            echo $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-community',
              [
                'image' => 'https://picsum.photos/1600/900?random=3',
                'title' => 'Chiacchere',
                'isPrivateCommunity' => true,
                'isSigned' => true,

              ]
            );
            ?>
          </div>
        </div>
      </section>

      <!--lista community-->
      <section class="py-5 border-bottom">
        <h2 id="Community-list">Lista di community</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-community',
            [
              'numberOfElements' => 4,
              'elementsForRow' => 3,
              
            ]
          );
        ?>
      </section>

      <!--eventi-->
      <section class="py-5 border-bottom">
        <h2 id="events">Eventi</h2>
        <div class="row">
          <div class="col-md-12">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-event',
                [
                  'dateHourStart' => '2012-12-27 12:30:00',
                  'title' => 'Titolo dell\'evento',
                  'summary'  => 'con Mario Rossi, Sandro Verdi e Nicoletta Bianchi',
                  'url' => '/url/di/test',
                  'urlCta' => '/url/di/event-signup',
                  'type' => 'Evento typeDefault',
                  'isPaid' => true,
                  'availableSeats' => '48',
                  
                ]
              );
            ?>
          </div>
        </div>
      </section>

      <!--lista eventi-->
      <section class="pt-5 ">
        <h2 id="events-list">Lista eventi</h2>

        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-event',
            [
              'numberOfElements'  => 3,
              
            ]
          );
        ?>
      </section>

      <!--card eventi-->
      <section class="pt-5 ">
        <h2 id="events-list">Card eventi</h2>

        <div class="row">
          <div class="col-md-6">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-event',
                [
                  'dateHourStart' => '2012-12-27 12:30:00',
                  'title' => 'Titolo dell\'evento',
                  'summary'  => 'con Mario Rossi, Sandro Verdi e Nicoletta Bianchi',
                  'url' => '/url/di/test',
                  'urlCta' => '/url/di/event-signup',
                  'type' => 'Evento typeDefault',
                  'isPaid' => false,
                  'availableSeats' => '48',
                  'newPubblication' => true,
                ]
              );
            ?>
          </div>
          <div class="col-md-6">
            <?=
              $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-event',
                [
                  'dateHourStart' => '2012-12-27 12:30:00',
                  'title' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
                  'summary'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                  'url' => '/url/di/test',
                  'urlCta' => '/url/di/view',
                  'type' => 'Evento typeDefault',
                ]
              );
            ?>
          </div>
        </div>
      </section>

      <!--scope eventi-->
      <section class="py-5 border-bottom">
        <h2 id="events-scope">Scope Eventi</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-scope-eventi',
            [
              'dateHourStart' => '2012-12-27 12:30:00',
              'dateHourEnd' => '2012-12-27 12:30:00',
              'title' => 'Tavola rotonda sull\'inquinamento nei mari',
              'summary'  => 'con Mario Rossi, Sandro Verdi e Nicoletta Bianchi',
              'description'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a tempor magna. Aliquam consectetur tellus et posuere vestibulum. Suspendisse euismod eros est, id rutrum felis cursus at. Duis turpis urna, laoreet quis malesuada rutrum, lobortis nec diam. Phasellus ut nisl enim.',
              'url' => '/url/di/test',
              'urlCta' => '/url/di/view',
              'type' => 'Evento typeDefault',
              'isPaid' => true,
              'availableSeats' => '48',
              'location' => 'Palazzo Roverella',
              'address' => 'via della pioppa, 30',
              'city' => 'Milano',
              'province' => 'MI',
            ]
          );
        ?>
      </section>

      <!--card documenti-->
      <section class="py-5 border-bottom">
        <h2 id="documents-card">Documenti card</h2>
        <div class="row variable-gutters">


          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-document-card',
              [
                'title' => '2020 Verso la Strategia Regionale per lo Sviluppo Sostenibile',
                'fileName' => 'nome_del_file.doc',
                'fileUrl' => 'url/di/esempio',
                'type' => 'doc',
                'description' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
                'nameSurname' => 'Mario Rossi',
                'size' => '300',
                'category' => 'Presentazioni e materiale illustrativo',
                'community' => 'Gruppo 6 UniBS Crescini',
                'dateSyncDrive' => '2012-12-27 12:30:00',
                'newPubblication' => true,
              ]
            );
          ?>
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-document-card',
              [
                'title' => 'ARIA S.p.A., genesi e orizzonti',
                'fileName' => 'nome_del_file.zip',
                'fileUrl' => 'url/di/esempio',
                'type' => 'zip',
                'description' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
                'nameSurname' => 'Mario Rossi',
                'size' => '300',
                'category' => 'Presentazioni e materiale illustrativo',
                'community' => 'Gruppo 6 UniBS Crescini',
                'versionFile' => '500',
                'newPubblication' => true,
              ]
            );
          ?>
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-document-card',
              [
                'title' => 'Io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
                'fileName' => 'nome_del_file.jpg',
                'fileUrl' => 'url/di/esempio',
                'type' => 'jpg',
                'description' => 'io sono una stringa',
                'nameSurname' => 'Mario Rossi',
                'size' => '300',
                'category' => 'Presentazioni e materiale illustrativo',
                'community' => 'Gruppo 6 UniBS Crescini',
                'versionFile' => '1',
              ]
            );


          ?>
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-document-card',
              [
                'title' => 'Documentazione (Rapporto Preliminare VAS, Documento di Orientamento del PPSSC, altro materiale)',
                'fileUrl' => 'url/di/esempio',
                'typeFolder' => 'folder',
                'nameSurname' => 'Mario Rossi',
                'community' => 'Gruppo 6 UniBS Crescini',
              ]
            );

          ?>
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-document-card',
              [
                'title' => 'Verbale seduta di insediamento',
                'fileName' => 'nome_del_file.xls',
                'fileUrl' => 'url/di/esempio',
                'type' => 'xls',
                'description' => 'io sono una stringa',
                'nameSurname' => 'Mario Rossi',
                'size' => '300',
                'category' => 'Presentazioni e materiale illustrativo',
                'community' => 'Gruppo 6 UniBS Crescini',
                // 'numberAttachments' => '4'
              ]
            );

          ?>
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-document-card',
              [
                'title' => 'Guida per i partecipanti - Community Primo Forum pubblico procedura di VAS',
                'fileUrl' => 'url/di/esempio',
                'description' => 'io sono una stringa',
                'nameSurname' => 'Mario Rossi',
                'category' => 'Presentazioni e materiale',
                'community' => 'Gruppo 6 UniBS Crescini',
              ]
            );

          ?>
        </div>
      </section>


      <!--lista documenti-->
      <section class="py-5 border-bottom">
        <h2 id="document-list">Lista documenti</h2>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-document-item',
            [
              'date' => '2012-12-12',
              'description' => 'Lorem ipsum dolor sit amet ipsum dolor sit amet ipsum dolor sit amet',
              'title' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
              'category' => 'Categoria di test',
              'image' => 'https://picsum.photos/1600/900?random=25',
              'type' => 'pdf',
              'size' => '350 kb',
              'nameSurname' => 'Mario Rossi',
              'community' => 'Community Common',
              'url' => 'url/del/dettaglio',
              'fileUrl' => 'url/del/documento',
              'fileName' => 'nome_del_documento.pdf',
              'newPubblication' => true,
            ]
          );
        ?>
        <?=
          $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/bi-document-item',
            [
              'date' => '2012-12-12',
              'description' => 'Lorem ipsum dolor sit amet ipsum dolor sit amet ipsum dolor sit amet',
              'title' => 'io sono una stringa da 75 caratteri totali e da qui in poi non so cosa fare',
              'category' => 'Categoria di test',
              'image' => 'https://picsum.photos/1600/900?random=25',
              'type' => 'pdf',
              'size' => '350 kb',
              'nameSurname' => 'Mario Rossi',
              'community' => 'Community Common',
              'url' => 'url/del/dettaglio',
              'fileUrl' => 'url/del/documento',
              'fileName' => 'nome_del_documento.pdf',
            ]
          );
        ?>
      </section>

      <!--lista podcast-->
      <section class="py-5 border-bottom">
        <h2 id="podcast-list">Lista podcast</h2>
        <div class="d-flex">
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-podcast'
            );
          ?>
        </div>
      </section>

      <!--lista puntate-->
      <section class="py-5 border-bottom">
        <h2 id="podcast-puntate-list">Lista puntate </h2>
        <div class="d-flex">
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-list-podcast-puntata'
            );
          ?>
        </div>
      </section>

      <section class="py-5 border-bottom">
        <h2 id="calendar-carousel" class="mb-5">Carousel Calendario</h2>
        <div>
          <!-- 2 variabili: ognuna per dire quale è la label attivo/disattivo -->
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-calendar-carousel',
              [
                //array con i filtri che voglio impostare
                'filterList' => ['Tutto', 'Consigli-comunali', 'Eventi', 'Scadenze'],
              ]
            );
          ?>
        </div>
      </section>




      <!--form-->
      <section class="py-5 border-bottom">
        <div>
          <h1 id="formExample" class="no_toc">Form</h1>

          <h2 class="mb-2">Singoli componenti</h2>
          <p> Elenco dei singoli componenti che possono essere inseriti in un form.
            Ogni volta che si istanzia uno di questi elementi è possibile passare al componente renderizzato i parametri di cui si hanno bisogno
            (per esempio il valore del placeholder, il valore dell'id dell'input..).
          </p>
          <p>Per fare questo passaggio viene passato un array chiave valore mentre viene chiamato il render del componente, nel seguente modo:
          </p>
          <pre>
          <code class="language-php">
          echo $this->render(
            '@vendor/open20/design/src/components/bootstrapitalia/views/nome-vista-componente', 
            [ //array chiave-valore con i parametri 
            'nome-variabile' => 'valore variabile', 
            ... 
            ]
          );
          </code>
          </pre>
          <p class="mb-4">In seguito poi nella vista verranno visualizzati i valori delle variabili passate.
          </p>
          <p class="mb-4">Elenco options custom (da implementare nei componenti che ancora non le prevedono)
            <ul>
              <li>ariaDescribedBy: testo aggiuntivo di supporto alla compilazione del campo (nominato anche hint)</li>
              <li>helperTooltip: testo aggiuntivo di supporto alla label per la comprensione del campo</li>
              <li>infoTooltip: testo aggiuntivo di supporto per la compilazione corretta del campo (dipende dalla presenza di ariaDescribedBy)</li>
            </ul>
          </p>
          <div class="my-3">
            <h2 class="mb-2">Checkbox</h2>
            <!--checkbox-->
            <div>
              <div class="form-group">


                <?php
                echo $this->render(
                  '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-checkbox',
                  [
                    'label' => 'Checkbox',
                    'inputId' => 'EsempioCheckbox'
                  ]
                );
                ?>
              </div>
            </div>
            <!--radio button -->
            <div>
              <h2 class="mt-4">Radio button</h2>
              <div class="form-group">
                <?php
                echo $this->render(
                  '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-radio-button',
                  [
                    'label' => 'Checkbox',
                    'inputId' => 'EsempioRadioButton'
                  ]
                );
                ?>
              </div>
            </div>
            <!--datepicker-->
            <h2 class="my-5">Date picker</h2>
            <div class="form-group">
              <?php
              echo $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-datepicker',
                [
                  'label' => 'Checkbox',
                  'inputId' => 'EsempioCalendar'
                ]
              );
              ?>
            </div>
            <!--select-->
            <h2 class="my-5">Select con campo cerca</h2>
            <div class="form-group">
              <?php
              echo $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-select-live-search',
                [
                  'label' => 'Input campo select',
                  'inputId' => 'EsempioSelect'
                ]
              );
              ?>
            </div>

            <!--input textarea-->
            <h2 class="my-5">Text area</h2>
            <div class="form-group">
              <?php
              echo $this->render(
                '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-input-textarea',
                [
                  'label' => 'Input campo textarea',
                  'inputId' => 'EsempioTextArea'

                ]
              );
              ?>
            </div>

            <!--input email e pwd-->
            <h2 id="vari-input" class="my-5">Vari input</h2>
            <div>
              <div class="form-group">
                <?php
                echo $this->render(
                  '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-input-email',
                  [
                    'label' => 'Input campo Email',
                    'inputId' => 'EsempioEmail',
                    'type' => 'email'
                  ]
                );
                ?>
              </div>
              <div class="form-group">
                <?php
                echo $this->render(
                  '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-input-password',
                  [
                    'label' => 'Input campo Password',
                    'inputId' => 'EsempioPassword',
                    'type' => 'password'
                  ]
                );
                ?>
              </div>
              <div class="form-group">
                <?php
                echo $this->render(
                  '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-input-text',
                  [
                    'label' => 'Input campo testo generico',
                    'inputId' => 'EsempioTestoGenerico',
                    'type' => 'text',
                    'options' => [
                      'aria-describedby' => 'aria-describedby options',
                      'infoTooltip' => 'tooltip info text'
                    ]
                  ]
                );
                ?>
              </div>
              <div class="form-group">
                <?php
                echo $this->render(
                  '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-input-search',
                  [
                    'label' => 'Input campo ricerca',
                    'inputId' => 'EsempioInputRicerca',
                    'type' => 'search'
                  ]
                );
                ?>
              </div>
            </div>

          </div>

          <h2 id="form-rounded" class="mb-2">Form rounded</h2>
          <p>Classi tag form:<p>
              <ul>
                <li>needs-validation: per i campi obbligatori del form richiede l'inserimento dei dati tramite avviso in caso di non avvenuta compilazione; </li>
                <li>form-rounded: classe che inserisce bordo agli input del form, sovrascrivendo gli input senza bordi di Bootstrap Italia. Nell'esempio sotto il form contiene la classe form-rounded.</li>
              </ul>
              <div class="my-4">
                <?php
                echo $this->render(
                  '@vendor/open20/design/src/components/bootstrapitalia/views/form',
                  [
                    'label' => 'Checkbox',
                    'inputId' => 'EsempioCheckbox'
                  ]
                );
                ?>
              </div>
      </section>


      <section class="py-5 border-bottom">
        <h2 id="toggle" class="mb-5">Toggles</h2>
        <div>

          <!-- 2 variabili: ognuna per dire quale è la label attivo/disattivo -->
          <?=
            $this->render(
              '@vendor/open20/design/src/components/bootstrapitalia/views/bi-form-toggle',
              [
                'labelOn' => 'Attivo',
                'labelOff' => 'Disattivo',
              ]
            );
          ?>
        </div>
      </section>

      <!--icone-->
      <section class="py-5 border-bottom">
        <h1 id="icone">Icone</h1>
        <p class="lead">Informazioni e suggerimenti per l’utilizzo di icone con <a href="https://italia.github.io/bootstrap-italia/docs/utilities/icone/" target="_blank"><strong>Bootstrap Italia</strong></a> e <a href="https://materialdesignicons.com/" target="_blank"><strong>Material Design</strong></a>.</p>
      </section>

      <section class="py-5 border-bottom">
        <h2 id="icone">Toolbar plugin</h2>
        <p class="lead">Attivabile con \Yii::$app->view->params['enablePLuginToolbar'] = TRUE</p>
        <div>

          <!-- 2 variabili: ognuna per dire quale è la label attivo/disattivo -->
          <?=
            $this->render(
              '@vendor/open20/design/src/views/layouts/parts/bi-plugin-toolbar',
              []
            );
          ?>
        </div>
      </section>

    </div>
  </div>
</div>