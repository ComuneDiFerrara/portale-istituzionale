<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    sito-comune-ferrara\console\migrations
 * @category   CategoryName
 */

use open20\amos\core\migration\libs\common\MigrationCommon;
use open20\amos\tag\models\Tag;
use frontend\modules\cftag\utility\CfTagUtility;
use yii\db\Migration;

/**
 * Class m201116_115127_add_cf_argomenti_tree
 */
class m201116_115127_add_cf_argomenti_tree extends Migration
{
    private $tags = [
        "Anziano" => [],
        "Fanciullo" => [],
        "Giovane" => [],
        "Famiglia" => [],
        "Studente" => [],
        "Associazione" => [],
        "Istruzione" => [],
        "Abitazione" => [],
        "Animale domestico" => [],
        "Integrazione sociale" => [],
        "Protezione sociale" => [],
        "Programma d'azione" => [],
        "Comunicazione" => [],
        "Edificio urbano" => [],
        "Urbanistica ed edilizia" => [],
        "Formazione professionale" => [],
        "Acquisizione di conoscenza" => [],
        "Condizioni e organizzazione del lavoro" => [],
        "Trasporto" => [],
        "Matrimonio" => [],
        "Procedura elettorale e voto" => [],
        "Tempo libero" => [],
        "Cultura" => [],
        "Immigrazione" => [],
        "Inquinamento" => [],
        "Area di parcheggio" => [],
        "Traffico urbano" => [],
        "Acqua" => [],
        "Gestione dei rifiuti" => [],
        "Salute" => [],
        "Sicurezza pubblica" => [],
        "Sicurezza internazionale" => [],
        "Spazio verde" => [],
        "Sport" => [],
        "Trasporto stradale" => [],
        "Turismo" => [],
        "Energia" => [],
        "Informatica e trattamento dei dati" => [],
    ];
    
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert(Tag::tableName(), ['id', 'root', 'lft', 'rgt', 'lvl', 'nome', 'codice', 'descrizione', 'limit_selected_tag', 'icon', 'icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all', 'frequency', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'version'],
            [
                [CfTagUtility::ARGUMENTS_TREE_ROOT_ID, 1, 1, 2, 0, 'Argomenti', '', '', NULL, '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL],
            ]);
        
        
        $argumentsRootTag = CfTagUtility::getArgumentsTreeRootTag();
        if (is_null($argumentsRootTag)) {
            MigrationCommon::printConsoleMessage('Radice argomenti non trovata');
            return false;
        }
        
        $ok = CfTagUtility::insertTagsToRootByArray($argumentsRootTag, $this->tags);
        if (!$ok) {
            MigrationCommon::printConsoleMessage('Errore aggiunta tag argomenti');
            return false;
        }
        
        return $ok;
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        if ($this->db->driverName === 'mysql') {
            $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
        }
        $this->delete(Tag::tableName(), ['id' => CfTagUtility::ARGUMENTS_TREE_ROOT_ID]);
        if ($this->db->driverName === 'mysql') {
            $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
        }
        return true;
    }
}
