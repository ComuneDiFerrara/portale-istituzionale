<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    sito-comune-ferrara\console\migrations
 * @category   CategoryName
 */

use open20\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m201126_155005_update_admin_fe_role_description
 */
class m201126_155005_update_admin_fe_role_description extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            
            [
                'name' => 'ADMIN_FE',
                'update' => true,
                'newValues' => [
                    'description' => 'Referente Comune Fe'
                ],
                'oldValues' => [
                    'description' => 'Ruolo Referente scuola'
                ]
            ]
        ];
    }
}
