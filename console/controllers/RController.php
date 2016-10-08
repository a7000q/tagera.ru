<?php

namespace console\controllers;


use yii\console\Controller;
use yii;

class RController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        
        $role = $auth->createRole('admin');
        $auth->add($role);
        $auth->assign($role, 1);
    }

    public function actionIndex()
    {

    }
}