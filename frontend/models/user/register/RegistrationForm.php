<?php

namespace frontend\models\user\register;

use dektrium\user\models\User;
use dektrium\user\models\Profile;
use yii\helpers\ArrayHelper;

class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
    public $reCaptcha;
    public $name;
    public $site;
    public $city;
    public $info;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['captcha', 'required'],
            ['reCaptcha', \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LfZswoUAAAAAHIT-Zz8pzqcf4NngFIi2G3S35pz'],
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