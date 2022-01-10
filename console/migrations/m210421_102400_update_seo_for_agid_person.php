<?php

use Exception;
use Throwable;
use yii\db\Migration;
use open20\agid\person\models\AgidPerson;

/**
 * Class m210421_102400_update_seo_for_agid_person
 */
class m210421_102400_update_seo_for_agid_person extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $connection = \Yii::$app->db;
        $connection->createCommand()->delete('seo_data', ['LIKE', 'classname', 'AgidPerson'])->execute();       

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
