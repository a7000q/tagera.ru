<?php

use yii\db\Migration;

/**
 * Handles the creation for table `s_property_field`.
 */
class m160910_015714_create_s_property_field_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('s_property_field', [
            'id' => $this->primaryKey(),
            'id_category' => $this->integer(),
            'id_type' => $this->integer(),
            'name' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('s_property_field');
    }
}
