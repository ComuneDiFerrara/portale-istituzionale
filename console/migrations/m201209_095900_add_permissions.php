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

class m201209_095900_add_permissions extends AmosMigrationPermissions
{
    protected function setRBACConfigurations()
    {
        return [

            [
                'name' => 'AGID_SERVICE_ADMIN',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'SERVIZI'
                    ]
                ]
            ],

            [
                'name' => 'AGID_DATASET_ADMIN',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'DATASET'
                    ]
                ]
            ],
            
            [
                'name' => 'AGID_PERSON_ADMIN',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'PERSONE'
                    ]
                ]
            ]
        ];
    }
}
