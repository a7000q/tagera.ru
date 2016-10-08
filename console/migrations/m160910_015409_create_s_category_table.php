<?php

use yii\db\Migration;

/**
 * Handles the creation for table `s_category`.
 */
class m160910_015409_create_s_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('s_category', [
            'id' => $this->primaryKey(),
            'id_parent' => $this->integer(),
            'name' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('s_category');
    }
}
