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


class m210225_102700_add_fk_agid_service_organizational_unit_mm extends Migration
{

    public function up()
    {
  
        // addForeignKey
        $this->addForeignKey(
            'fk-agid_service_uo_mm-agid-service-id',
            'agid_service_organizational_unit_mm',
            'agid_service_id',
            'agid_service',
            'id',
            'SET NULL'
        );

        // addForeignKey
        $this->addForeignKey(
            'fk-agid_service_uo_mm-agid-organizational-unit-id',
            'agid_service_organizational_unit_mm',
            'agid_organizational_unit_id',
            'agid_organizational_unit',
            'id',
            'SET NULL'
        );

    }

    public function down()
    {
        // dropForeignKey
        $this->dropForeignKey ( 'fk-agid_service_uo_mm-agid-service-id', 'agid_service_organizational_unit_mm' );

        // dropForeignKey
        $this->dropForeignKey ( 'fk-agid_service_uo_mm-agid-organizational-unit-id', 'agid_service_organizational_unit_mm' );
    }

}