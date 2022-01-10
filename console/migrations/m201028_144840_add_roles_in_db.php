<?php

use open20\amos\core\migration\AmosMigrationPermissions;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

class m201028_144840_add_roles_in_db extends AmosMigrationPermissions
{

    protected function setRBACConfigurations()
    {
        return [

            [
                'name' => 'ADMIN_FE',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruolo Referente scuola',
            ],
        ];
    }

}