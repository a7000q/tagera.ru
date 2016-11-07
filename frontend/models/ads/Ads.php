<?php

namespace frontend\models\ads;


use common\models\products\UProducts;

class Ads extends UProducts
{
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
}