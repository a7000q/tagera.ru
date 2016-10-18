<?php

namespace common\models\products;

use Yii;

/**
 * This is the model class for table "u_product_fields".
 *
 * @property integer $id
 * @property integer $id_product
 * @property integer $id_field
 * @property string $value
 *
 * @property SPropertyField $idField
 * @property UProducts $idProduct
 */
class UProductFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'u_product_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_field'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['id_field'], 'exist', 'skipOnError' => true, 'targetClass' => SPropertyField::className(), 'targetAttribute' => ['id_field' => 'id']],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => UProducts::className(), 'targetAttribute' => ['id_product' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'id_field' => 'Id Field',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdField()
    {
        return $this->hasOne(SPropertyField::className(), ['id' => 'id_field']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduct()
    {
        return $this->hasOne(UProducts::className(), ['id' => 'id_product']);
    }
}
