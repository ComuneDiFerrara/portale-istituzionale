<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\basic\template
 * @category   CategoryName
 */
return [
    'schema' => [
        'class' => 'simialbi\yii2\schemaorg\Module',
    //'autoCreate' => false,
    //'autoRender' => false
    ],
    'dashboard' => [
        'class' => 'open20\amos\dashboard\AmosDashboard',
    ],
    'amosadmin' => [
        'class' => 'open20\amos\admin\AmosAdmin',
        'moduleName' => 'amosadmin',
        'defaultUserRole' => 'BASIC_USER',
        'enableRegister' => false,
        'disableFirstAccesWizard' => true,
        'bypassWorkflow' => true,
        'disableUpdateChangeStatus' => true,
        'dontCheckOneTagPresent' => true,
        'profileRequiredFields' => [
            'status',
        ],
        'fieldsConfigurations' => [
            'boxes' => [
                'box_account_data' => ['form' => true, 'view' => true],
                'box_dati_accesso' => ['form' => true, 'view' => true],
                'box_dati_contatto' => ['form' => true, 'view' => true],
                'box_dati_fiscali_amministrativi' => ['form' => false, 'view' => false],
                'box_dati_nascita' => ['form' => true, 'view' => true],
                'box_email_frequency' => ['form' => true, 'view' => true],
                'box_facilitatori' => ['form' => false, 'view' => false],
                'box_foto' => ['form' => true, 'view' => true],
                'box_informazioni_base' => ['form' => true, 'view' => true],
                'box_presentazione_personale' => ['form' => true, 'view' => true],
                'box_privacy' => ['form' => true, 'view' => true],
                'box_questio' => ['form' => false, 'view' => false],
                'box_role_and_area' => ['form' => true, 'view' => true],
                'box_social_account' => ['form' => true, 'view' => true],
            ],
            'fields' => [
                'attivo' => ['form' => true, 'view' => true, 'referToBox' => 'box_account_data'],
                'codice_fiscale' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_fiscali_amministrativi'],
                'cognome' => ['form' => true, 'view' => true, 'referToBox' => 'box_informazioni_base'],
                'default_facilitatore' => ['form' => true, 'view' => true],
                'email' => ['form' => true, 'view' => false, 'referToBox' => 'box_dati_contatto'],
                'email_pec' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_contatto'],
                'facebook' => ['form' => true, 'view' => true, 'referToBox' => 'box_social_account'],
                'facilitatore_id' => ['form' => true, 'view' => true, 'referToBox' => 'box_facilitatori'],
                'googleplus' => ['form' => true, 'view' => true, 'referToBox' => 'box_social_account'],
                'linkedin' => ['form' => true, 'view' => true, 'referToBox' => 'box_social_account'],
                'nascita_comuni_id' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_nascita'],
                'nascita_data' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_nascita'],
                'nascita_nazioni_id' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_nascita'],
                'nascita_province_id' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_nascita'],
                'nome' => ['form' => true, 'view' => true, 'referToBox' => 'box_informazioni_base'],
                'note' => ['form' => true, 'view' => false, 'referToBox' => 'box_informazioni_base'],
                'presentazione_breve' => ['form' => true, 'view' => true, 'referToBox' => 'box_informazioni_base'],
                'presentazione_personale' => ['form' => true, 'view' => true, 'referToBox' => 'box_presentazione_personale'],
                'privacy' => ['form' => true, 'view' => true, 'referToBox' => 'box_privacy'],
                'sesso' => ['form' => true, 'view' => false, 'referToBox' => 'box_informazioni_base'],
                'telefono' => ['form' => true, 'view' => false, 'referToBox' => 'box_dati_contatto'],
                'twitter' => ['form' => true, 'view' => true, 'referToBox' => 'box_social_account'],
                'ultimo_accesso' => ['form' => true, 'view' => true, 'referToBox' => 'box_account_data'],
                'ultimo_logout' => ['form' => true, 'view' => true, 'referToBox' => 'box_account_data'],
                'username' => ['form' => true, 'view' => false, 'referToBox' => 'box_dati_accesso'],
                'user_profile_age_group_id' => ['form' => true, 'view' => true, 'referToBox' => 'box_informazioni_base'],
                'user_profile_area_id' => ['form' => true, 'view' => false, 'referToBox' => 'box_role_and_area'],
                'userProfileImage' => ['form' => true, 'view' => true, 'referToBox' => 'box_foto'],
                'user_profile_role_id' => ['form' => true, 'view' => false, 'referToBox' => 'box_role_and_area'],
            ]
        ]
    ],
    'privileges' => [
        'class' => 'open20\amos\privileges\AmosPrivileges',
        'enableAgid' => true,
    ],
    'cwh' => [
        'class' => 'open20\amos\cwh\AmosCwh',
        'cached' => false,
        'regolaPubblicazioneFilter' => true
    ],
    'email' => [
        'class' => 'open20\amos\emailmanager\AmosEmail',
        'templatePath' => '@common/mail/emails',
    ],
    'events' => [
        'class' => 'open20\amos\events\AmosEvents',
        'enableAgid' => true,
        'enableContentDuplication' => true,
        'enableCommunitySections' => false,
        'enableGdpr' => false,
        'enableSeatsManagement' => false,
        'enableInvitationManagement' => false,
        'params' => [
            'site_featured_enabled' => true,
            'site_publish_enabled' => true,
            'orderParams' => [
                'event' => [
                    'default_field' => ['id'],
                    'order_type' => SORT_DESC
                ]
            ],
        ],
        'defaultListViews' => ['calendar', 'grid'],
        'defaultView' => 'grid',
        'controllerMap' => [
            'event' => [
                'class' => 'open20\amos\events\controllers\override\EventController',
            ],
        ],
        'useFrontendView' => true,
    ],
    'attachments' => [
        'class' => 'open20\amos\attachments\FileModule',
        'webDir' => 'files',
        'tempPath' => '@common/uploads/temp',
        'storePath' => '@common/uploads/store',
        'cache_age' => '2592000',
        'disableGallery' => true,
        'checkParentRecordForDownload' => true,
    ],
    'comuni' => [
        'class' => 'open20\amos\comuni\AmosComuni',
    ],
    'community' => [
        'class' => 'open20\amos\community\AmosCommunity',
        'enableUserNetworkWidget' => false,
    ],
    'tag' => [
        'class' => 'open20\amos\tag\AmosTag',
        'modelsEnabled' => [
            'open20\amos\documenti\models\Documenti',
            'open20\amos\events\models\Event',
            'open20\amos\news\models\News',
            'open20\agid\service\models\AgidService',
            'open20\agid\organizationalunit\models\AgidOrganizationalUnit',
            'open20\agid\person\models\AgidPerson',
            'open20\agid\dataset\models\AgidDataset'
        ],
    ],
    'documenti' => [
        'class' => 'open20\amos\documenti\AmosDocumenti',
        'defaultListViews' => ['grid'],
        'defaultView' => 'grid',
        'cmsSync' => true,
        'enableAgid' => true,
        'params' => [
            'site_featured_enabled' => true,
            'site_publish_enabled' => true,
            'containerFullWidth' => true
        ],
        'enableCategories' => false,
        'enableDocumentVersioning' => true,
        'requireModalMoveFile' => false,
        'useFrontendView' => true,
    ],
    'translation' => [
        'class' => 'open20\amos\translation\AmosTranslation',
        'queryCache' => 'translateCache',
        'cached' => true,
        'translationBootstrap' => [
            'configuration' => [
                'translationLabels' => [
                    'classBehavior' => \lajax\translatemanager\behaviors\TranslateBehavior::className(),
                    'models' => [
                        [
                            'namespace' => 'cornernote\workflow\manager\models\Status',
                            //'connection' => 'db', //if not set it use 'db'
                            //'classBehavior' => NULL,//if not set it use default classBehavior 'lajax\translatemanager\behaviors\TranslateBehavior'
                            'attributes' => ['label'],
                        ],
                    ],
                ],
                'translationContents' => [
                    'classBehavior' => \open20\amos\translation\behaviors\TranslateableBehavior::className(),
                    'models' => [
                        /* [
                          'namespace' => 'cornernote\workflow\manager\models\Status',
                          //'connection' => 'db', //if not set it use 'db'
                          //'classBehavior' => NULL,//if not set it use default classBehavior 'lajax\translatemanager\behaviors\TranslateBehavior'
                          'enableWorkflow' => FALSE,
                          'attributes' => ['label'],
                          'plugin' => 'workflow-manager',
                          ], */
                        ['namespace' => 'open20\amos\tag\models\Tag',
                            //'connection' => 'db', //if not set it use 'db'
                            //'classBehavior' => NULL,//if not set it use default classBehavior 'open20\amos\translation\behaviors\TranslateableBehavior'
                            'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                            'attributes' => ['nome', 'descrizione'],
                            'plugin' => 'tag'
                        ],
                        ['namespace' => 'open20\amos\news\models\NewsCategorie',
                            //'connection' => 'db', //if not set it use 'db'
                            //'classBehavior' => NULL,//if not set it use default classBehavior 'open20\amos\translation\behaviors\TranslateableBehavior'
                            'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                            'attributes' => ['titolo', 'sottotitolo'],
                            'plugin' => 'news'
                        ],
                        ['namespace' => 'open20\amos\documenti\models\DocumentiCategorie',
                            //'connection' => 'db', //if not set it use 'db'
                            //'classBehavior' => NULL,//if not set it use default classBehavior 'open20\amos\translation\behaviors\TranslateableBehavior'
                            'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                            'attributes' => ['titolo', 'descrizione'],
                            'plugin' => 'documenti'
                        ],
                        ['namespace' => 'open20\amos\community\models\CommunityType',
                            //'connection' => 'db', //if not set it use 'db'
                            //'classBehavior' => NULL,//if not set it use default classBehavior 'open20\amos\translation\behaviors\TranslateableBehavior'
                            'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                            'attributes' => ['name', 'description'],
                            'plugin' => 'community'
                        ],
                    ],
                ],
            ],
        ],
        'module_translation_labels' => 'translatemanager',
        'module_translation_labels_options' => ['roles' => ['ADMIN', 'CONTENT_TRANSLATOR'],
            'root' => [
                '@vendor/amos/',
                '@vendor/openinnovation/',
                '@vendor/',
                '@app',
                '@backend',
                '@frontend',
                '@vendor/open20/',
            ],
        ], //all the options of the translatemanager
        'components' => [
            'translatemanager' => [
                'class' => 'lajax\translatemanager\Component'
            ],
        ],
        'defaultLanguage' => 'it-IT',
        'defaultUserLanguage' => 'it-IT',
        'pathsForceTranslation' => ['*'],
    ],
    'elasticsearch' => [
        'class' => '\open20\elasticsearch\Module',
        'modelMap' => [
            'ElasticModelSearch' => 'common\modules\transformermanagers\ElasticModelSearch',
        ],
        'modelsEnabled' => [
            'open20\amos\news\models\News' => 'common\modules\transformermanagers\NewsTransformerManager',
            'open20\amos\documenti\models\Documenti' => 'common\modules\transformermanagers\DocumentiTransformerManager',
            'open20\amos\events\models\Event' => 'common\modules\transformermanagers\EventTransformerManager',
            'open20\agid\organizationalunit\models\AgidOrganizationalUnit' => 'common\modules\transformermanagers\AgidOrganizationalUnitTransformerManager',
            'open20\agid\person\models\AgidPerson' => 'common\modules\transformermanagers\AgidPersonTransformerManager',
            'open20\agid\service\models\AgidService' => 'common\modules\transformermanagers\AgidServiceTransformerManager',
            'open20\agid\dataset\models\AgidDataset' => 'common\modules\transformermanagers\AgidDatasetTransformerManager',
        ],
        "foldingClass" => 'open20\elasticsearch\models\folding\ItalianFolding',
        'indexes_mapping' =>[
            'all' => [
                "properties" => [
                    'start_publication' => ['type' => 'date',],
                    'end_publication' => ['type' => 'date',]
                ]
            ]
        ],
        'indexes_setting' => [
            'comunefe' => [
                "analysis" => [
                    "analyzer" => [
                        "ope20_analyzer" => [
                            "type" => "custom",
                            "tokenizer" => "standard",
                            "char_filter" => [
                                "html_strip"
                            ],
                            "filter" => [
                                "lowercase",
                                "asciifolding"
                            ]
                        ]
                    ]
                ]
            ],
            'italian' => [
                "analysis" => [
                    "filter" => [
                        "italian_elision" => [
                            "type" => "elision",
                            "articles" => [
                                "c", "l", "all", "dall", "dell",
                                "nell", "sull", "coll", "pell",
                                "gl", "agl", "dagl", "degl", "negl",
                                "sugl", "un", "m", "t", "s", "v", "d"
                            ],
                            "articles_case" => true
                        ],
                        "italian_stop" => [
                            "type" => "stop",
                            "stopwords" => "_italian_"
                        ],
                        "italian_keywords" => [
                            "type" => "keyword_marker",
                            "keywords" => ["esempio"]
                        ],
                        "italian_stemmer" => [
                            "type" => "stemmer",
                            "language" => "light_italian"
                        ]
                    ],
                    "analyzer" => [
                        "open20_italian" => [
                            "tokenizer" => "standard",
                            "char_filter" => [
                                "html_strip"
                            ],
                            "filter" => [
                                "_ascii_folding" => [
                                    "type" => "asciifolding",
                                    "preserve_original" => true
                                ],
                                "italian_elision",
                                "lowercase",
                                "italian_stop",
                                "italian_keywords",
                                "italian_stemmer"
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],


];
