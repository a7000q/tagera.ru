<?php

namespace frontend\models\category;


use common\models\category\SCategory;
use frontend\models\ads\Ads;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use Zelenin\yii\behaviors\Slug;

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

    public function getFullName()
    {
        $category_chain = $this->getCategoryChain();
        $result = "";
        foreach ($category_chain as $id_category)
        {
            $category = Category::findOne($id_category);
            if ($result == "")
                $result = $category->name;
            else
                $result .= " / ".$category->name;
        }

        return $result;
    }

    public function getCategoryChain()
    {
        $category = $this;

        while ($category->parent)
        {
            $result[] = $category->id;
            $category = $category->parent;
        }

        $result[] = $category->id;

        $result = array_reverse($result);

        return $result;
    }

    public static function getAllForMenu()
    {
        $categoryes = Category::find()->where(['id_parent' => null])->all();

        return ArrayHelper::map($categoryes, 'slug', 'name');
    }

    public static function getGeneralAll()
    {
        return Category::find()->where(['id_parent' => null])->all();
    }

    public function getIdAllChild()
    {
        $result[] = $this->id;
        foreach ($this->childrens as $child)
        {
            $r = $child->getIdAllChild();
            $result = ArrayHelper::merge($result, $r);
        }

        return $result;
    }

    public function getCountProducts($query = null)
    {
        $ids_category = $this->getIdAllChild();

        if (!$query)
            $result = Ads::find()->where(['id_category' => $ids_category])->count();
        else
        {
            $result = clone $query;
            $result = $result->andWhere(['id_category' => $ids_category])->count();
        }

        return $result;
    }


}