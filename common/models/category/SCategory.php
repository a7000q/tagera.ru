<?php

namespace common\models\category;

use Yii;

/**
 * This is the model class for table "s_category".
 *
 * @property integer $id
 * @property integer $id_parent
 * @property string $name
 * @property string $icon
 *
 * @property SCategory $idParent
 * @property SCategory[] $sCategories
 * @property SPropertyField[] $sPropertyFields
 */
class SCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 's_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent', 'sort'], 'integer'],
            ['sort', 'default', 'value' => 500],
            [['name', 'icon'], 'string', 'max' => 255],
            [['id_parent'], 'exist', 'skipOnError' => true, 'targetClass' => SCategory::className(), 'targetAttribute' => ['id_parent' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'Id Parent',
            'name' => 'Название',
            'icon' => 'Иконка',
            'parent.name' => 'Родитель',
            'sort' => 'Сортировка'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(SCategory::className(), ['id' => 'id_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(self::className(), ['id_parent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFields()
    {
        return $this->hasMany(SPropertyField::className(), ['id_category' => 'id']);
    }

    public function getImage()
    {
        return $this->hasOne(SCategoryImage::className(), ['id_category' => 'id']);
    }
}
