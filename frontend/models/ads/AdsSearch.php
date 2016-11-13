<?php

namespace frontend\models\ads;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use frontend\models\category\Category;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use Yii;

class AdsSearch extends Model
{
    public $search_text;
    public $category_slug;

    public $p1;
    public $p2;

    public $_dataProvider;

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
        $query = Ads::find();

        $query = $query->where(['status' => 10]);

        if ($this->search_text) {
            $query = $query->andWhere(['like', 'name', $this->search_text]);
            $query = $query->orWhere(['like', 'description', $this->search_text]);
        }

        if ($this->categoryObject) {
            $query = $query->andWhere(['in', 'id_category', $this->categoryObject->getIdAllChild()]);
        }

        if ($this->p1)
            $query = $query->andWhere(['>=', 'price', $this->p1]);

        if ($this->p2)
            $query = $query->andWhere(['<=', 'price', $this->p2]);

        if (Yii::$app->session->get('geo'))
            $query = $query->andWhere(['id_city' => Yii::$app->session->get('geo')]);

        $this->_dataProvider =  new ActiveDataProvider([
            'query' => $query
        ]);
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
            $params['p2'] = $this->p2;

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

    public function loadGet($params)
    {
        $this->setAttributes([
            'category_slug' => ArrayHelper::getValue($params, "slug"),
            'search_text' => ArrayHelper::getValue($params, "search"),
            'p1' => ArrayHelper::getValue($params, "p1"),
            'p2' => ArrayHelper::getValue($params, "p2")
        ]);
    }

}