<?php

namespace frontend\models\ads;


use frontend\models\user\User;
use yii\base\Model;
use frontend\models\category\Category;
use yii\helpers\ArrayHelper;
use Yii;

class AddFormAds extends Model
{
    public $id_category;
    public $name;
    public $description;
    public $price;
    public $image1;
    public $image2;
    public $image3;
    public $image4;
    public $image5;
    public $image6;

    private $fields;

    public $username;
    public $phone;
    public $city;

    public function __get($name)
    {
        $param = explode("__", $name);

        if (count($param) != 0)
        {
            if ($param[0] == "field")
                return $this->getField($param[1]);
        }

        return parent::__get($name);
    }

    private function getField($id_field)
    {
        return ArrayHelper::getValue($this->fields, $id_field);
    }

    private function setField($id_field, $value)
    {
        $this->fields[$id_field] = $value;
    }

    public function __set($name, $value)
    {
        $param = explode("__", $name);

        if (count($param) != 0)
        {
            if ($param[0] == "field")
                return $this->setField($param[1], $value);
        }

        return parent::__set($name, $value);
    }

    public function rules()
    {
        return [
            [['id_category', 'city'], 'integer'],
            [['name', 'description', 'username', 'phone'], 'string'],
            [['name', 'username', 'phone', 'city', 'id_category'], 'required'],
            [['price'], 'number'],
            [['image1', 'image2', 'image3', 'image4', 'image5', 'image6'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg']
        ];
    }

    public function attributeLabels()
    {
        $result = [];

        if ($this->category)
        {
            foreach ($this->category->fieldsAll as $field)
            {
                $result["field__".$field->id] = $field->name;
            }
        }

        return ArrayHelper::merge($result, [
            'id_category' => 'Категория',
            'name' => 'Название объявления',
            'description' => 'Описание',
            'price' => 'Цена',
            'image1' => 'Фото',
            'username' => 'Имя',
            'phone' => 'Телефон',
            'city' => 'Город'
        ]);
    }

    public function getCategoryArray($id_category = null)
    {
        $result = Category::find()->where(['id_parent' => $id_category])->all();
        $result = ArrayHelper::map($result, 'id', 'name');

        return $result;
    }

    public function getModalLabel()
    {
        if (!$this->id_category)
            return "Выбрать";

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
        if (!$this->id_category)
            return false;

        $category = Category::findOne($this->id_category);

        while ($category->parent)
        {
            $result[] = $category->id;
            $category = $category->parent;
        }

        $result[] = $category->id;

        $result = array_reverse($result);

        return $result;
    }

    public function getCategory()
    {
        return Category::findOne($this->id_category);
    }

    public function loadFields($post)
    {
        $data = ArrayHelper::getValue($post, "AddFormAds");

        if ($data)
        {
            foreach ($data as $key => $value)
            {
                $name = explode("__", $key);

                if ($name[0] == "field")
                {
                    $this->{$key} = $value;
                }
            }
        }

    }

    public function setDefaultUser(User $user)
    {
        $this->username = $user->getMainUsername();
    }

    public function saveProduct()
    {

    }

}