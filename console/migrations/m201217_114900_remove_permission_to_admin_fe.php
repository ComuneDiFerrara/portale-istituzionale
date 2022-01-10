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

class m201217_114900_remove_permission_to_admin_fe extends AmosMigrationPermissions
{
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'AMMINISTRATORE_CATEGORIE_NEWS',
                'update' => true,
                'newValues' => [
                    'removeParents' => [
                        'AMMINISTRATORE_NEWS'
                    ]
                ]
            ],
        ];
    }
}
