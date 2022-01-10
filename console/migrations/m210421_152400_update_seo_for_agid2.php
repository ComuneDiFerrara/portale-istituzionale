<?php

use open20\agid\person\models\AgidPerson;
use yii\db\Migration;

/**
 * Class m210421_152400_update_seo_for_agid2
 */
class m210421_152400_update_seo_for_agid2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $agid_persons = AgidPerson::find()->all();
        // $agid_persons = $connection->createCommand('SELECT * FROM agid_person')->queryAll();

        foreach ($agid_persons as $key => $agid_person) {

            // $agid_person->detachBehavior(['workflow', 'workflowLog', 'fileBehavior', 'SeoContentBehavior']);
            $agid_person->detachBehaviors();

            $text = $agid_person->getNomecognome();

            // var_dump($text);
            $text = str_replace("\n", " ", $text); // textarea

            $text = str_replace("&nbsp;", " ", $text);
            $text = str_replace(array("'", '"'), "", $text); //remove single quote and dash
            $text = mb_convert_case($text, MB_CASE_LOWER, "UTF-8"); //convert to lowercase
            $text = preg_replace("#[^a-zA-Z0-9]+#", "-", $text); //replace everything non an with dashes
            $text = preg_replace("#(-){2,}#", "$1", $text); //replace multiple dashes with one
            $text = trim($text, "-"); //trim dashes from beginning and end of string if any
            $newValue['pretty_url'] = $text;
            $seo = new \open20\amos\seo\models\SeoData();
            $seo->pretty_url = $text;
            $seo->aggiornaSeoData($agid_person, $newValue);

        }

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
