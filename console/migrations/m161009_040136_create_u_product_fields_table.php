<?php

use yii\db\Migration;

/**
 * Handles the creation for table `u_product_fields`.
 */
class m161009_040136_create_u_product_fields_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('u_product_fields', [
            'id' => $this->primaryKey(),
            'id_product' => $this->integer(),
            'id_field' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->createIndex('idx-u_product_fields-id_product', 'u_product_fields', 'id_product');
        $this->addForeignKey('fk-u_product_fields-id_product', 'u_product_fields', 'id_product', 'u_products', 'id', "CASCADE", "CASCADE");

        $this->createIndex('idx-u_product_fields-id_field', 'u_product_fields', 'id_field');
        $this->addForeignKey('fk-u_product_fields-id_field', 'u_product_fields', 'id_field', 's_property_field', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('u_product_fields');
    }
}
