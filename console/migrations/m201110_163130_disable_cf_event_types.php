<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    sito-comune-ferrara\console\migrations
 * @category   CategoryName
 */

use open20\amos\events\models\EventType;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m201110_163130_disable_cf_event_types
 */
class m201110_163130_disable_cf_event_types extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $eventTypeTable = EventType::tableName();
        $this->update($eventTypeTable, ['deleted_at' => new Expression('NOW()'), 'deleted_by' => 1], ['<>', 'event_type', EventType::TYPE_INFORMATIVE]);
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $eventTypeTable = EventType::tableName();
        $this->update($eventTypeTable, ['deleted_at' => null, 'deleted_by' => null], ['<>', 'event_type', EventType::TYPE_INFORMATIVE]);
        return true;
    }
}
