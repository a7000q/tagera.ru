<?php

namespace frontend\models\category;


use common\models\category\SPropertyField;
use yii\helpers\ArrayHelper;
use common\models\category\SSelectFieldValue;

class PropertyFields extends SPropertyField
{
    public function getFormName()
    {
        return "field__".$this->id;
    }

    public function getFieldValues()
    {
        $array = $this->selectValues;
        return ArrayHelper::map($array, 'id', 'value');
    }

    public function getSelectValues()
    {
        return $this->hasMany(SSelectFieldValue::className(), ['id_field' => 'id'])->where(['<>', 'value', '']);
    }
}