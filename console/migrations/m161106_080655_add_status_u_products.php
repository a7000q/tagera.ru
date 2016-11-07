<?php

use yii\db\Migration;

class m161106_080655_add_status_u_products extends Migration
{
    public function up()
    {
        $this->addColumn("u_products", "status", $this->integer()->defaultValue(1));
        $this->addColumn("u_products", "date_update", $this->integer());
    }

    public function down()
    {
        $this->dropColumn("u_products", "status");
        $this->dropColumn("u_products", "date_update");
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
