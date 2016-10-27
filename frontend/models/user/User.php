<?php

namespace frontend\models\user;


use yii\helpers\ArrayHelper;

class User extends \common\models\user\User
{
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'username' => 'Логин'
        ]);
    }

    public function getMainUsername()
    {
        if ($this->profile && $this->profile->name != "")
            return $this->profile->name;

        return $this->username;
    }
}