<?php

use yii\db\Migration;

/**
 * Handles the creation of table `s_category_image`.
 */
class m161109_063328_create_s_category_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('s_category_image', [
            'id' => $this->primaryKey(),
            'id_category' => $this->integer(),
            'id_file' => $this->integer(),
        ]);

        $this->createIndex('idx-s_category_image-id_category', "s_category_image", "id_category");
        $this->createIndex('idx-s_category_image-id_file', "s_category_image", "id_file");

        $this->addForeignKey('fk-s_category_image-id_category',  "s_category_image", "id_category", "s_category", "id", "CASCADE", "CASCADE");
        $this->addForeignKey('fk-s_category_image-id_file',  "s_category_image", "id_file", "u_files", "id", "CASCADE", "CASCADE");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('s_category_image');
    }
}
