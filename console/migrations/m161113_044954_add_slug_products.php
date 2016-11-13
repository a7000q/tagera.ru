<?php

use yii\db\Migration;

class m161113_044954_add_slug_products extends Migration
{
    public function up()
    {
        $this->addColumn("u_products", "slug", $this->string());
    }

    public function down()
    {
        $this->dropColumn("u_products", "slug");
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
