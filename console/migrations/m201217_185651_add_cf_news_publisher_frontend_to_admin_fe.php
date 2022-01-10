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
 * Class m201217_185651_add_cf_news_publisher_frontend_to_admin_fe
 */
class m201217_185651_add_cf_news_publisher_frontend_to_admin_fe extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'NEWS_PUBLISHER_FRONTEND',
                'update' => true,
                'newValues' => [
                    'addParents' => ['ADMIN_FE']
                ]
            ]
        ];
    }
}
