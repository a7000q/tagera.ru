<?php

namespace console\controllers;

use yii\console\Controller;
use yii;
use common\models\products\UProductsUnchecked;

class CronController extends Controller
{
    public function actionAdsActivate()
    {
        $uncheckeds = UProductsUnchecked::find()->joinWith("product")->where(["<=", "u_products_unchecked.date", time() - 60])->andWhere(['status' => 1])->all();

        foreach ($uncheckeds as $unchecked)
        {
            $unchecked->product->status = 10;
            $unchecked->product->save();

            $unchecked->delete();
        }
    }
}