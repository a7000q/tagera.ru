<?php

use yii\db\Migration;

class m160916_021628_parent_category_field extends Migration
{
    public function safeUp()
    {
        $this->createIndex("category_parent_field_pk", "s_category", "id_parent");
        $this->addForeignKey("category_parent_field_pk", "s_category", "id_parent", "s_category", "id", "CASCADE", "CASCADE");
    }

    public function safeDown()
    {
        $this->dropForeignKey("category_parent_field_pk", "s_category");
        $this->dropIndex("category_parent_field_pk", "s_category");
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
