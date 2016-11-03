<?php

use yii\db\Migration;

class m161102_144550_add_price extends Migration
{
    public function up()
    {
        $this->addColumn("u_products", "price", $this->decimal(10,2));
    }

    public function down()
    {
        $this->dropColumn("u_products", "price");
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
