<?php

namespace frontend\models\ads;


use common\models\products\UProductFields;
use frontend\models\category\PropertyFields;
use yii\helpers\ArrayHelper;

class AdsFields extends UProductFields
{
    public function getVisibleValue()
    {
        $field = $this->field;

        switch ($field->typeField->name)
        {
            case "text":
                $result = $this->getTextValue();
                break;
            case "select":
                $result = $this->getSelectValue($field->selectValues);
                break;
            case "radio":
                $result = $this->getSelectValue($field->selectValues);
                break;
            case "checkbox":
                $result = $this->getSelectValue($field->selectValues);
                break;
            case "textarea":
                $result = $this->getTextValue();
                break;
        }

        return $result;
    }

    public function getField()
    {
        return $this->hasOne(PropertyFields::className(), ['id' => 'id_field']);
    }

    private function getTextValue()
    {
        return $this->value;
    }

    private function getSelectValue($select_values)
    {
        $data = ArrayHelper::map($select_values, "id", "value");
        return ArrayHelper::getValue($data, $this->value);
    }
}