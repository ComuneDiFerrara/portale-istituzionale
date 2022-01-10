<?php

use yii\db\Migration;

/**
 * Class m210208_112300_update_language_source_message_document_title_limit
 */
class m210208_112300_update_language_source_message_document_title_limit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $language_source = (new \yii\db\Query())
        ->select(['id'])
        ->from('language_source')
        ->where(['message' => '#documents_title_field_hint'])
        ->one();


        $this->update('language_translate',
            [
                'translation' => 'Limite max: 255 caratteri'
            ],
            [
                'id' => $language_source['id'], 
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
