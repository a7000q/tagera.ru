<?php

namespace frontend\models\user;

use yii\helpers\ArrayHelper;


class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
    public $captcha;
    public $name;
    public $site;
    public $city;
    public $info;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['captcha', 'required'],
            ['captcha', 'captcha'],
            [['name', 'site'], 'string'],
            ['info', 'string'],
            ['city', 'integer']
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'captcha' => 'Символы с картинки',
            'username' => 'Логин',
            'name' => 'Имя',
            'site' => 'Сайт',
            'city' => 'Город',
            'info' => 'О себе'
        ]);
    }

    public function loadAttributes(User $user)
    {
        // here is the magic happens
        $user->setAttributes([
            'email'    => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ]);
        /** @var Profile $profile */
        $profile = \Yii::createObject(Profile::className());
        $profile->setAttributes([
            'name' => $this->name,
            'website' => $this->site,
            'id_city' => $this->city,
            'bio' => $this->info
        ]);
        $user->setProfile($profile);
    }
}