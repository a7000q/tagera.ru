<?php

namespace console\controllers;


use backend\models\user\User;
use yii\console\Controller;
use yii;

class RController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        
        $role = $auth->createRole('admin');
        $auth->add($role);

        $user = User::findOne(['username' => 'admin']);

        $auth->assign($role, $user->id);
    }

    public function actionIndex()
    {

    }
}