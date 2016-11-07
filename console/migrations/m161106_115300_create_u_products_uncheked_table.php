<?php

use yii\db\Migration;

/**
 * Handles the creation of table `u_products_uncheked`.
 */
class m161106_115300_create_u_products_uncheked_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('u_products_unchecked', [
            'id' => $this->primaryKey(),
            'id_product' => $this->integer(),
            'date' => $this->integer(),
        ]);

        $this->createIndex('idx-u_products_unchecked-id_product', "u_products_unchecked", "id_product");
        $this->addForeignKey('fk-u_products_unchecked-id_product', "u_products_unchecked", "id_product", "u_products", "id", "CASCADE", "CASCADE");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('u_products_uncheked');
    }
}
