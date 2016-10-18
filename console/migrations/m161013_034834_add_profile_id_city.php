<?php

use yii\db\Migration;

class m161013_034834_add_profile_id_city extends Migration
{
    public function safeUp()
    {
        $this->addColumn('profile', 'id_city', $this->integer(10)->unsigned());
        $this->createIndex('idx-profile-id_city', 'profile', 'id_city');
        $this->addForeignKey('fk-profile-id_city', 'profile', 'id_city', 'city', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-profile-id_city', 'profile');
        $this->dropIndex('idx-profile-id_city', 'profile');
        $this->dropColumn('profile', 'id_city');
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
