<?php

namespace backend\models\category;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use common\models\files\UFiles;

class Category extends \common\models\category\SCategory
{
    public $imageFile;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['imageFile', 'file']
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'imageFile' => 'Фото'
        ]);
    }

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

    public function getImage()
    {
        return $this->hasOne(CategoryImage::className(), ['id_category' => 'id']);
    }

    public function saveImageFile()
    {
        if (!$this->imageFile)
            return false;

        $dir = Yii::getAlias('@frontend/web/files/category/');

        if (!is_dir($dir))
            mkdir($dir, 0777);

        $file_name = $this->id.$this->imageFile->baseName.time().".".$this->imageFile->extension;
        $src = $dir."/".$file_name;
        $this->imageFile->saveAs($src);

        $src = 'files/category/'.$file_name;

        $file = new UFiles(['src' => $src]);
        $file->save();

        $category_image = new CategoryImage([
            'id_category' => $this->id,
            'id_file' => $file->id,
        ]);

        $category_image->save();
    }
}
