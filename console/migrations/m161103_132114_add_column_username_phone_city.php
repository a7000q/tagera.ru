<?php

use yii\db\Migration;

class m161103_132114_add_column_username_phone_city extends Migration
{
    public function safeUp()
    {
        $this->addColumn("u_products", "username", $this->text()->notNull());
        $this->addColumn("u_products", "phone", $this->text()->notNull());
        $this->addColumn("u_products", "id_city", $this->integer(10)->unsigned()->notNull());

        $this->createIndex("idx-u_products-id_city", "u_products", "id_city");
        $this->addForeignKey('fk-u_products_id_city', "u_products", "id_city",  "city", "id");
    }

    public function safeDown()
    {
        $this->dropColumn("u_products", "username");
        $this->dropColumn("u_products", "phone");
        $this->dropColumn("u_products", "id_city");
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
