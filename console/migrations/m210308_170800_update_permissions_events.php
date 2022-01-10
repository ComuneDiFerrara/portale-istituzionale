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

class m210308_170800_update_permissions_events extends AmosMigrationPermissions
{
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'EVENTS_READER',
                'update' => true,
                'newValues' => [
                    'removeParents' => [
                        'BASIC_USER',
                    ]
                ]
            ],

        ];
    }
}
