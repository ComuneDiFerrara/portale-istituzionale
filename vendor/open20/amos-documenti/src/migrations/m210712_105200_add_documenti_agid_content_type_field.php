<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\documenti\migrations
 * @category   CategoryName
 */

use yii\db\Migration;
use open20\amos\documenti\models\DocumentiAgidContentType;


/**
 * Class m210712_105200_add_documenti_agid_content_type_field
 */
class m210712_105200_add_documenti_agid_content_type_field extends Migration
{
    public function safeUp() {
        $this->addColumn(DocumentiAgidContentType::tableName(),'content_type_icon', $this->string(255)->null()->defaultValue(null)->after('description'));
        return true;
    }

    public function safeDown() {
        $this->dropColumn(DocumentiAgidContentType::tableName(),'content_type_icon');
        return true;
    }

}

