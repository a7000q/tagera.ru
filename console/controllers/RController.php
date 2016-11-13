<?php

namespace console\controllers;


use backend\models\user\User;
use common\models\category\SCategory;
use common\models\products\UProducts;
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
        $products = UProducts::find()->all();
        foreach ($products as $product)
            $product->save();

        $cats = SCategory::find()->all();
        foreach ($cats as $cat)
            $cat->save();

    }
}