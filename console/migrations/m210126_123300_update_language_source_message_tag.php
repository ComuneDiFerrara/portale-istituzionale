<?php

use yii\db\Migration;

/**
 * Class m210126_123300_update_language_source_message_tag
 */
class m210126_123300_update_language_source_message_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->update('language_translate',
            [
                'translation' => 'Tassonomia argomenti'
            ],
            [
                'translation' => 'Tag aree di interesse',
                'language' => 'it-IT'
            ]);

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
