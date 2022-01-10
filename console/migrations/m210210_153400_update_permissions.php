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

class m210210_153400_update_permissions extends AmosMigrationPermissions
{
    protected function setRBACConfigurations()
    {
        return [

            [
                'name' => 'AGID_ORGANIZATIONAL_UNIT_ADMIN',
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
