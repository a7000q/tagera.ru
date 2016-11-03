<?php

use yii\db\Migration;

class m161103_132114_add_column_username_phone_city extends Migration
{
    public function safeUp()
    {
        $this->addColumn("u_products");
    }

    public function safeDown()
    {

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
