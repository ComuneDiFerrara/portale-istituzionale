<?php


use yii\db\Migration;
use open20\amos\admin\models\UserProfile;

/**
 * Class m210129_163515_notify_from_editorial_default
 */
class m210129_163515_notify_from_editorial_default extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn(
            UserProfile::tableName(),
            'notify_from_editorial_staff',
            $this->boolean()->defaultValue(0)
        );

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;
    }

}