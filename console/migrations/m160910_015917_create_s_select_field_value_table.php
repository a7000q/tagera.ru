<?php

use yii\db\Migration;

/**
 * Handles the creation for table `s_select_field_value`.
 */
class m160910_015917_create_s_select_field_value_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('s_select_field_value', [
            'id' => $this->primaryKey(),
            'id_field' => $this->integer(),
            'value' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('s_select_field_value');
    }
}
