<?php

use yii\db\Migration;

class m160919_013642_type_field_foregin extends Migration
{
    public function safeUp()
    {
        $this->createIndex("type_field_pk", "s_property_field", "id_type");
        $this->addForeignKey("type_field_pk", "s_property_field", "id_type", "a_type_field", "id");
    }

    public function safeDown()
    {
        $this->dropForeignKey("type_field_pk", "s_property_field");
        $this->dropIndex("type_field_pk", "s_property_field");
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
