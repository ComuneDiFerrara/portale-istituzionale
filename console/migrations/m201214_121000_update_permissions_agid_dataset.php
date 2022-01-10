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

class m201214_121000_update_permissions_agid_dataset extends AmosMigrationPermissions
{
    protected function setRBACConfigurations()
    {
        return [

            //
            [
                'name' => 'DATASET',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'ADMIN_FE'
                    ]
                ]
            ]
            
        ];
    }
}
