<?php

namespace frontend\models\user;

use common\models\geo\City;
use yii\helpers\ArrayHelper;


class Profile extends \dektrium\user\models\Profile
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['id_city', 'integer']
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id_city' => 'Город'
        ]);
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'id_city']);
    }
}