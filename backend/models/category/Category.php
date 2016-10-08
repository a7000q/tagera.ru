<?php

namespace backend\models\category;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

class Category extends \common\models\category\SCategory
{
    public function getBreadcrumbs()
    {
        $parent = $this->parent;
        while ($parent)
        {
            $result[] = ['label' => $parent->name, 'url' => ['category/view', 'id' => $parent->id]];
            $parent = $parent->parent;
        }

        $result[] = ['label' => "Категории", 'url' => ['category/index']];
        krsort($result);

        return $result;
    }

    static public function newCategory($id_parent)
    {
        $model = new Category();
        $model->id_parent = $id_parent;
        $model->sort = 500;
        $model->save();
    }

    public function getParentName()
    {
        return ArrayHelper::getValue($this, 'parent.name');
    }

    public function getFieldsDataProvider()
    {
        return new ActiveDataProvider([
            'query' => PropertyField::find()->where(['id_category' => $this->id])
        ]);
    }

    public function getCategoriesDataProvider()
    {
        return new ActiveDataProvider([
            'query' => $this->getCategories()
        ]);
    }
}
