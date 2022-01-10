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

class m201211_190300_update_permisions extends AmosMigrationPermissions
{
    protected function setRBACConfigurations()
    {
        return [

            //
            [
                'name' => 'UO',
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
