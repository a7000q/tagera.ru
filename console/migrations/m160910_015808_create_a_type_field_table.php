<?php

use yii\db\Migration;

/**
 * Handles the creation for table `a_type_field`.
 */
class m160910_015808_create_a_type_field_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('a_type_field', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('a_type_field');
    }
}
