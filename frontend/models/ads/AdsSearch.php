<?php

namespace frontend\models\ads;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use frontend\models\category\Category;
use yii\helpers\Url;

class AdsSearch extends Model
{
    public $search_text;
    public $category_slug;

    public $p1;
    public $p2;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['search_text', 'category_slug'], 'string'],
            [['p1', 'p2'], 'filter', 'filter' => function($value){
                return (int)str_replace(" ", "", $value);
            }],
            [['p1', 'p2'], 'safe']
        ]);
    }

    public function search()
    {

    }

    public function getCategoryObject()
    {
        return Category::findOne(['slug' => $this->category_slug]);
    }


    public function getUrlForm($category = false)
    {
        if (!$category)
            $category = ($this->category_slug)?$this->category_slug:"category";

        $params[] = "/".$category;

        if ($this->search_text)
            $params['search'] = $this->search_text;

        if ($this->p1)
            $params['p1'] = $this->p1;

        if ($this->p2)
            $params['p1'] = $this->p2;

        return Url::toRoute($params);
    }

    public function loadButton($param)
    {
        if (isset($param['price-reset']))
            $this->resetPrice();
    }

    private function resetPrice()
    {
        $this->p1 = false;
        $this->p2 = false;
    }

}