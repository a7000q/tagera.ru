<?php

use yii\db\Migration;

class m160915_014521_update_s_property_field extends Migration
{
    public function safeUp()
    {
        $this->createIndex("category_field_pk", "s_property_field", "id_category");
        $this->addForeignKey("category_field_pk", "s_property_field", "id_category", "s_category", "id", "CASCADE", "CASCADE");
    }

    public function safeDown()
    {
        $this->dropForeignKey("category_field_pk", "s_property_field");
        $this->dropIndex("category_field_pk", "s_property_field");
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
