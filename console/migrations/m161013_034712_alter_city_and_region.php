<?php

use yii\db\Migration;

class m161013_034712_alter_city_and_region extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE city engine=InnoDB;");
        $this->execute("ALTER TABLE region engine=InnoDB;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE city engine=MyIsam;");
        $this->execute("ALTER TABLE region engine=MyIsam;");
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
