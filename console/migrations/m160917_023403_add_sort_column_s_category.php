<?php

use yii\db\Migration;

class m160917_023403_add_sort_column_s_category extends Migration
{
    public function up()
    {
        $this->addColumn('s_category', 'sort', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('s_category', 'sort');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
