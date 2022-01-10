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

class m201204_200800_add_permissions extends AmosMigrationPermissions
{
    protected function setRBACConfigurations()
    {
        return [

            [
                'name' => 'AGID_ORGANIZATIONAL_UNIT_ADMIN',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'UO'
                    ]
                ]
            ],

            [
                'name' => 'AMMINISTRATORE_DOCUMENTI',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'DOCUMENTI'
                    ]
                ]
            ],

            [
                'name' => 'AMMINISTRATORE_NEWS',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'NOTIZIE'
                    ]
                ]
            ],

            [
                'name' => 'EVENTS_ADMINISTRATOR',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'EVENTI'
                    ]
                ]
            ],

            [
                'name' => 'AMMINISTRATORE_TAG',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ARGOMENTI'
                    ]
                ]
            ],
 
        ];
    }
}
