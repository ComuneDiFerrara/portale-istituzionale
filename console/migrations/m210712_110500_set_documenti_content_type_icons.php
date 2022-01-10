<?php


use yii\db\Migration;
use open20\amos\documenti\models\DocumentiAgidContentType;


/**
 * Class m210712_110500_set_documenti_content_type_icons
 */
class m210712_110500_set_documenti_content_type_icons extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update(DocumentiAgidContentType::tableName(), ['content_type_icon'=>'file-document-outline'],['id'=>1]);
        $this->update(DocumentiAgidContentType::tableName(), ['content_type_icon'=>'clipboard-alert-outline'],['id'=>4]);
        $this->update(DocumentiAgidContentType::tableName(), ['content_type_icon'=>'pencil-plus-outline'],['id'=>5]);
        $this->update(DocumentiAgidContentType::tableName(), ['content_type_icon'=>'file-check-outline'],['id'=>6]);
        $this->update(DocumentiAgidContentType::tableName(), ['content_type_icon'=>'android-studio'],['id'=>3]);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable(DocumentiAgidContentType::tableName());
        return true;
    }

}
