<?php

use yii\db\Migration;

class m160920_023022_s_select_field_foregin extends Migration
{
    public function safeUp()
    {
        $this->createIndex("s_select_field_pk", "s_select_field_value", "id_field");
        $this->addForeignKey("s_select_field_pk", "s_select_field_value", "id_field", "s_property_field", "id", "CASCADE", "CASCADE");
    }

    public function safeDown()
    {
        $this->dropForeignKey("s_select_field_pk", "s_select_field_value");
        $this->dropIndex("s_select_field_pk", "s_select_field_value");
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
