<?php

namespace common\models\category;

use Yii;

/**
 * This is the model class for table "s_property_field".
 *
 * @property integer $id
 * @property integer $id_category
 * @property integer $id_type
 * @property string $name
 *
 * @property SCategory $idCategory
 */
class SPropertyField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 's_property_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category', 'id_type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => SCategory::className(), 'targetAttribute' => ['id_category' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_category' => 'Id Category',
            'id_type' => 'Тип',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(SCategory::className(), ['id' => 'id_category']);
    }

    public function getTypeField()
    {
        return $this->hasOne(ATypeField::className(), ['id' => 'id_type']);
    }

    public function getSelectValues()
    {
        return $this->hasMany(SSelectFieldValue::className(), ['id_field' => 'id']);
    }
}
