<?php

use yii\db\Migration;

/**
 * Handles the creation for table `u_product_images`.
 */
class m161010_022755_create_u_product_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('u_product_images', [
            'id' => $this->primaryKey(),
            'id_product' => $this->integer(),
            'id_file' => $this->integer(),
            'date' => $this->integer(),
        ]);

        $this->createIndex('idx-u_product_images-id_product', 'u_product_images', 'id_product');
        $this->addForeignKey('fk-u_product_images-id_product', 'u_product_images', 'id_product', 'u_products', 'id', "CASCADE", "CASCADE");

        $this->createIndex('idx-u_product_images-id_file', 'u_product_images', 'id_file');
        $this->addForeignKey('fk-u_product_images-id_file', 'u_product_images', 'id_file', 'u_files', 'id', "CASCADE", "CASCADE");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('u_product_images');
    }
}
