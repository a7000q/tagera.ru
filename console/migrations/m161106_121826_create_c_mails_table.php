<?php

use yii\db\Migration;

/**
 * Handles the creation of table `c_mails`.
 */
class m161106_121826_create_c_mails_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('c_mails', [
            'id' => $this->primaryKey(),
            'from' => $this->string(),
            'subject' => $this->string(),
            'message' => $this->string(),
            'date' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('c_mails');
    }
}
