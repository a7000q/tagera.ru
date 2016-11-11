<?php

use yii\db\Migration;

class m161110_082706_add_translit_column extends Migration
{
    public function up()
    {
        $this->addColumn("s_category", "slug", $this->string());
    }

    public function down()
    {
        $this->dropColumn("s_category", "slug");
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
