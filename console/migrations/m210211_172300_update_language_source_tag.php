<?php

use yii\db\Migration;

/**
 * Class m210211_172300_update_language_source_tag
 */
class m210211_172300_update_language_source_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $language_source = (new \yii\db\Query())
        ->select(['id'])
        ->from('language_source')
        ->where(['message' => 'Nessun tag selezionato'])
        ->andWhere(['category' => 'amostag'])
        ->one();


        $this->update('language_translate',
            [
                'translation' => 'Nessun tag selezionato, obbligatorio selezionare almeno 1 tag'
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
