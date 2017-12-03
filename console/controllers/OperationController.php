<?php

namespace console\controllers;


use console\models\UploadGeo;
use yii\console\Controller;

class OperationController extends Controller
{
    public function actionGeo()
    {
        $model = new UploadGeo([
            'file' => \Yii::getAlias('console').'/geo.xlsx'
        ]);

        $model->run();
    }
}