<?php

namespace frontend\components\Geo;


use common\models\geo\City;
use yii\bootstrap\Widget;
use Yii;
use yii\helpers\ArrayHelper;

class Geo extends Widget
{
    public $id_city;

    public function init()
    {
        parent::init();
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;
        $session->open();

        $this->id_city = $session->get('geo');

        if (isset($post['setGeo']))
        {
            $id_city = ArrayHelper::getValue($post, 'geo_id_city');
            $session->set('geo', $id_city);
            Yii::$app->response->refresh();
        }
    }

    public function run()
    {
        parent::run();
        return $this->render('Modal');
    }

    public function getCityName()
    {
        $id_city = Yii::$app->session->get('geo');

        if ($id_city){
            $city = City::findOne($id_city);

            if ($city)
                return $city->name;
        }

        return "Вся Россия";
    }
}