<?php


/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\community\migrations
 * @category   CategoryName
 */

use open20\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class m201125_081544_add_admin_fe_permissions extends AmosMigrationPermissions
{
    protected function setRBACConfigurations()
    {
        return [

            [
                'name' => 'AMMINISTRATORE_CATEGORIE_DOCUMENTI',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_CATEGORIE_NEWS',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_CHAT',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_COMMUNITY',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_COMUNI_ISTAT',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_CWH',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_DISCUSSIONI',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_DOCUMENTI',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_EMAIL_MANAGER',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_NEWS',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AMMINISTRATORE_TAG',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'EVENTS_ADMINISTRATOR',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'AGID_ORGANIZATIONAL_UNIT_ADMIN',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'COMMENTS_ADMINISTRATOR',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'SITE_MANAGEMENT_ADMINISTRATOR',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
            [
                'name' => 'ADMINISTRATOR_TOKEN',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ],
        ];
    }
}
