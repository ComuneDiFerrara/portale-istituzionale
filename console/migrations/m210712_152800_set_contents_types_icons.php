<?php


use yii\db\Migration;
use open20\agid\person\models\AgidPersonContentType;
use open20\agid\organizationalunit\models\AgidOrganizationalUnitContentType;
use open20\agid\service\models\AgidServiceContentType;


/**
 * Class m210712_152800_set_contents_types_icons
 */
class m210712_152800_set_contents_types_icons extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update(AgidPersonContentType::tableName(), ['content_type_icon'=>'account-tie'],['id'=>1]);
        $this->update(AgidPersonContentType::tableName(), ['content_type_icon'=>'card-account-details-outline'],['id'=>2]);

        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'card-account-details-outline'],['id'=>1]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'head-snowflake-outline'],['id'=>2]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'account-hard-hat'],['id'=>3]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'factory'],['id'=>4]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'wrench-outline'],['id'=>5]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'domain'],['id'=>6]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'city-variant-outline'],['id'=>7]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'train-car'],['id'=>8]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'school-outline'],['id'=>9]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'shield-account-outline'],['id'=>10]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'finance'],['id'=>11]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'sprout-outline'],['id'=>12]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'bottle-tonic-plus-outline'],['id'=>13]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>'lock-outline'],['id'=>14]);
        $this->update(AgidServiceContentType::tableName(), ['content_type_icon'=>' flower-outline'],['id'=>15]);

        $this->update(AgidOrganizationalUnitContentType::tableName(), ['content_type_icon'=>'bank-outline'],['id'=>1]);
        $this->update(AgidOrganizationalUnitContentType::tableName(), ['content_type_icon'=>'book-account-outline'],['id'=>2]);
        $this->update(AgidOrganizationalUnitContentType::tableName(), ['content_type_icon'=>'domain'],['id'=>3]);
        $this->update(AgidOrganizationalUnitContentType::tableName(), ['content_type_icon'=>'account-group-outline'],['id'=>4]);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete(AgidPersonContentType::tableName(), ['id'=>[1,2]]);
        $this->delete(AgidServiceContentType::tableName(), ['id'=>[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]]);
        $this->delete(AgidOrganizationalUnitContentType::tableName(), ['id'=>[1,2,3,4]]);

        return true;
    }

}
