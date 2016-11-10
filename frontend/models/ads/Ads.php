<?php

namespace frontend\models\ads;


use common\models\products\UProducts;
use frontend\models\category\Category;
use yii\helpers\ArrayHelper;
use Yii;

class Ads extends UProducts
{
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'dateText' => 'Дата '
        ]);
    }

    public function setUnchecked()
    {
        $uncheked = $this->adsUnchecked;

        if (!$uncheked)
            $uncheked = new AdsUnchecked(['id_product' => $this->id]);


        $uncheked->date = time() + 60*20;
        $uncheked->save();
    }

    public function getAdsUnchecked()
    {
        return $this->hasOne(AdsUnchecked::className(), ['id_product' => 'id']);
    }

    public function getFields()
    {
        return $this->hasMany(AdsFields::className(), ['id_product' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(AdsImages::className(), ['id_product' => "id"]);
    }

    public function getDateText()
    {
        return date("d.m.Y H:i", $this->date);
    }

    public function getGeneralImageSrc()
    {
        if ($this->images)
            return $this->images[0]->image->src;

        return "img/no-photo.jpg";
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    public function getStatusText()
    {
        switch ($this->status)
        {
            case 1:
                return "Отправлено на проверку";
                break;
            case 2:
                return "Заблокированно";
                break;
            case 10:
                return "Активно";
                break;
        }
    }

    public function recheck()
    {
        $this->status = 1;
        $this->save();

        $message = Yii::$app->mailer->compose('add-form/admin', ['product' => $this]);
        $message->setFrom('rail555@yandex.ru');
        $message->setTo("a7000q@gmail.com");
        $message->setSubject("update объявление");
        $message->send();
    }

    public function activate()
    {
        $this->status = 10;
        $this->save();
    }
}