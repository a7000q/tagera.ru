<?php
/**
 * Created by PhpStorm.
 * User: Раиль
 * Date: 13.10.2016
 * Time: 6:00
 */

namespace frontend\models\user;


class User extends \common\models\user\User
{
    public function getMainUsername()
    {
        if ($this->profile && $this->profile->name != "")
            return $this->profile->name;

        return $this->username;
    }
}