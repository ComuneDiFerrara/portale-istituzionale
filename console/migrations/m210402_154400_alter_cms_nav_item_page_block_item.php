<?php

use yii\db\Migration;

/**
 * Class m210402_154400_alter_cms_nav_item_page_block_item
 */
class m210402_154400_alter_cms_nav_item_page_block_item extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->execute("
    ALTER TABLE `cms_nav_item_page_block_item`
CHANGE `json_config_values` `json_config_values` longtext COLLATE 'utf8_unicode_ci' NULL AFTER `prev_id`,
CHANGE `json_config_cfg_values` `json_config_cfg_values` longtext COLLATE 'utf8_unicode_ci' NULL AFTER `json_config_values`;
        ");

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}