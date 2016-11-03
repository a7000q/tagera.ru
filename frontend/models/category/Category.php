<?php

namespace frontend\models\category;


use common\models\category\SCategory;
use yii\helpers\ArrayHelper;

class Category extends SCategory
{
    public function getChildrens()
    {
        return $this->hasMany(Category::className(), ['id_parent' => 'id']);
    }

    public function getFieldsAll()
    {
        $result = [];
        $category = $this->parent;
        while ($category)
        {
            $result = ArrayHelper::merge($result, $category->propertyFields);
            $category = $category->parent;
        }

        $result = ArrayHelper::merge($result, $this->propertyFields);
        $result = array_reverse($result);

        return $result;
    }

    public function getPropertyFields()
    {
        return $this->hasMany(PropertyFields::className(), ['id_category' => 'id'])->where(['<>', 'name', '']);
    }

    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_parent']);
    }
}