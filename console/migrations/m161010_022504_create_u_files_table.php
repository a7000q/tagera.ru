<?php

use yii\db\Migration;

/**
 * Handles the creation for table `u_files`.
 */
class m161010_022504_create_u_files_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('u_files', [
            'id' => $this->primaryKey(),
            'src' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('u_files');
    }
}
