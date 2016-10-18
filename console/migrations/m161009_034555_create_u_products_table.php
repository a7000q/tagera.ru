<?php

use yii\db\Migration;

/**
 * Handles the creation for table `u_products`.
 */
class m161009_034555_create_u_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('u_products', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'id_user' => $this->integer(),
            'id_category' => $this->integer(),
            'date' => $this->integer(),
        ]);

        $this->createIndex('idx-u_products-id_user', 'u_products', 'id_user');
        $this->addForeignKey('fk-u_products-id_user', 'u_products', 'id_user', 'user', 'id');

        $this->createIndex('idx-u_products-id_category', 'u_products', 'id_category');
        $this->addForeignKey('fk-u_products-id_category', 'u_products', 'id_category', 's_category', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('u_products');
    }
}
