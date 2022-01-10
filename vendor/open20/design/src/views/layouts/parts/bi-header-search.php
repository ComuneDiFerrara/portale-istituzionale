<div class="it-modal">
    <div class="modal fade" tabindex="-1" role="dialog" id="searchModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <svg class="icon icon-lg">
                                <use xlink:href="<?= $currentAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-close"></use>
                            </svg>
                        </button>
                        <div class="modal-title h2">Cerca</div>
                    </div>


                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="h5">Inserisci una o più parole chiave per affinare ulteriormente la ricerca</div>
                        <div class="form-group autocomplete-wrapper-big mt-5">
                            <input type="search" class="autocomplete" placeholder="Testo da cercare" id="autocomplete-two" name="autocomplete-two" data-autocomplete="[]">
                            <span class="autocomplete-icon" aria-hidden="true">
                                <svg class="icon icon-sm">
                                    <use xlink:href="<?= $currentAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-search"></use>
                                </svg>
                            </span>
                            <!-- <ul class="autocomplete-list" id="testAutocomplete2">
                                <li>
                                    <a href="#">
                                        <svg class="icon icon-sm">
                                            <use xlink:href="< ?= $currentAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-pa"></use>
                                        </svg>
                                        <span class="autocomplete-list-text">
                                            <span>Comune di <mark>Pi</mark>sa</span><em>Amministrazione</em>
                                        </span>
                                    </a>
                                </li>
                            </ul> -->
                            <label for="autocomplete-two" class="sr-only">Cerca nel sito</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>