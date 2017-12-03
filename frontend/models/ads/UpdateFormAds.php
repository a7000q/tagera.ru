<?php

namespace frontend\models\ads;

use yii\helpers\ArrayHelper;
use frontend\models\files\Files;
use Yii;


class UpdateFormAds extends Ads
{
    public $image;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg']
        ]);
    }

    public function attributeLabels()
    {
        $result = [
            'image' => 'Фото'
        ];

        if ($this->category)
        {
            foreach ($this->category->fieldsAll as $field)
            {
                $result["field__".$field->id] = $field->name;
            }
        }

        return ArrayHelper::merge(parent::attributeLabels(), $result); // TODO: Change the autogenerated stub
    }

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
        $field_value = AdsFields::find()->where(['id_field' => $id_field])->andWhere(['id_product' => $this->id])->one();
        $value = ArrayHelper::getValue($field_value, "value");

        return json_decode($value);
    }

    private function setField($id_field, $value)
    {
        $field_value = AdsFields::find()->where(['id_field' => $id_field])->andWhere(['id_product' => $this->id])->one();
        if (!$field_value)
            $field_value = new AdsFields(['id_product' => $this->id, 'id_field' => $id_field]);

        if (is_array($value))
            $value = json_encode($value);

        $field_value->value = $value;
        $field_value->save();
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

    public function saveImage()
    {
        if (!$this->image)
            return false;

        $dir = "files/products/".$this->id;
        if (!is_dir($dir))
            mkdir($dir, 0777);

        $src = $dir."/".$this->id.$this->image->baseName.time().".".$this->image->extension;
        $this->image->saveAs($src);

        $file = new Files(['src' => $src]);
        $file->save();

        $product_image = Yii::createObject(AdsImages::className());
        $product_image->setAttributes([
            'id_product' => $this->id,
            'id_file' => $file->id,
            'date' => time()
        ]);

        $product_image->save();
    }

    public function loadFields($post)
    {
        $data = ArrayHelper::getValue($post, "UpdateFormAds");

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


}