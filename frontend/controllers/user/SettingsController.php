<?php

namespace frontend\controllers\user;


use frontend\models\ads\Ads;
use Yii;
use yii\data\ActiveDataProvider;

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
        $ads = Ads::find()->where(['id_user' => Yii::$app->user->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $ads
        ]);
        return $this->render('ads', ['dataProvider' => $dataProvider]);
    }


}