<?php

namespace frontend\models\ads;


use common\models\products\UProductImages;
use frontend\models\files\Files;

class AdsImages extends UProductImages
{
    public function getImage()
    {
        return $this->hasOne(Files::className(), ['id' => 'id_file']);
    }
}