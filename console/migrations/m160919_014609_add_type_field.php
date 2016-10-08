<?php

use yii\db\Migration;

class m160919_014609_add_type_field extends Migration
{
    public function safeUp()
    {
        $this->insert("a_type_field", ["name" => "text"]);
        $this->insert("a_type_field", ["name" => "select"]);
        $this->insert("a_type_field", ["name" => "radio"]);
        $this->insert("a_type_field", ["name" => "checkbox"]);
        $this->insert("a_type_field", ["name" => "textarea"]);
    }

    public function safeDown()
    {
        $this->truncateTable("a_type_field");
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
