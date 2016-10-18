<?php

namespace frontend\controllers\user;


class SettingsController extends \dektrium\user\controllers\SettingsController
{
    public function behaviors()
    {
        $result = parent::behaviors();

        $result['access']['rules'][] = [
            'allow' => true,
            'actions' => ['ads'],
            'roles' => ['@']
        ];

        return $result;
    }

    public function actionAds()
    {
        return 123;
    }
}