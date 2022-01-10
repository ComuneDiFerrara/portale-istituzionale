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
 * Class m201201_105800_remove_permission_news_categorie
 */
class m201201_105800_remove_permission_news_categorie extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'AMMINISTRATORE_CATEGORIE_NEWS',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['ADMIN_FE']
                ]
            ],
        ];
    }
}
