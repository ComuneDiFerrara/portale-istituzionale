<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    svilupposostenibile\enti
 * @category   CategoryName
 */

use yii\db\Migration;


class m210121_170500_add_fk_to_agid_organizational_unit_service_mm extends Migration
{
    public function up()
    {
        // addForeignKey
        $this->addForeignKey(
            'fk-agid-organizational-unit-service-mm-organizational-id',
            'agid_organizational_unit_service_mm',
            'agid_organizational_unit_id',
            'agid_organizational_unit',
            'id',
            'SET NULL'
        );

        // addForeignKey
        $this->addForeignKey(
            'fk-agid-organizational-unit-service-mm-service-id',
            'agid_organizational_unit_service_mm',
            'agid_service_id',
            'agid_service',
            'id',
            'SET NULL'
        );
    }

    public function down()
    {
        // dropForeignKey
        $this->dropForeignKey ('fk-agid-organizational-unit-service-mm-organizational-id', 'agid_organizational_unit_service_mm');
        $this->dropForeignKey ('fk-agid-organizational-unit-service-mm-service-id', 'agid_organizational_unit_service_mm');
    }

}