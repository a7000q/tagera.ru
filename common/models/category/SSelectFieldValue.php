<?php

namespace common\models\category;

use Yii;

/**
 * This is the model class for table "s_select_field_value".
 *
 * @property integer $id
 * @property integer $id_field
 * @property string $value
 *
 * @property SPropertyField $idField
 */
class SSelectFieldValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 's_select_field_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_field'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['id_field'], 'exist', 'skipOnError' => true, 'targetClass' => SPropertyField::className(), 'targetAttribute' => ['id_field' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_field' => 'Id Field',
            'value' => 'Значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(SPropertyField::className(), ['id' => 'id_field']);
    }
}
