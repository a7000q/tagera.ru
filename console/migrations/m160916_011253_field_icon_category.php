<?php

use yii\db\Migration;

class m160916_011253_field_icon_category extends Migration
{
    public function up()
    {
        $this->addColumn("s_category", "icon", "string");
    }

    public function down()
    {
       $this->dropColumn("s_category", "icon");
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
