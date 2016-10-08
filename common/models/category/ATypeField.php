<?php

namespace common\models\category;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "a_type_field".
 *
 * @property integer $id
 * @property string $name
 *
 * @property SPropertyField[] $sPropertyFields
 */
class ATypeField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'a_type_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSPropertyFields()
    {
        return $this->hasMany(SPropertyField::className(), ['id_type' => 'id']);
    }

    static public function getAllArray()
    {
        $result = static::find()->all();
        return ArrayHelper::map($result, "id", "name");
    }
}
