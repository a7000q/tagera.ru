<?php

namespace backend\models\category;

use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;


class PropertyField extends \common\models\category\SPropertyField
{
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['typeFieldName'] = 'Тип поля';
        return $labels;
    }

    static public function newProperty($id_category)
    {
        $model = new PropertyField();
        $model->id_category = $id_category;
        $model->save();
    }

    public function getTypeFieldName()
    {
        return ArrayHelper::getValue($this, 'typeField.name');
    }

    public function getBreadcrumbs()
    {
        $category = Category::findOne($this->id_category);
        $result = $category->breadcrumbs;
        $result[] = ['label' => $category->name, 'url' => ['category/view', 'id' => $category->id]];
        return $result;
    }
    
    public function getSelectValuesDataProvider()
    {
        if (!(($this->id_type == 2) or ($this->id_type == 3) or ($this->id_type == 4)))
            return false;

        return new ActiveDataProvider([
            'query' => SelectField::find()->where(['id_field' => $this->id])
        ]);
    }
}