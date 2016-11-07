<?php

namespace common\models\products;

use Yii;

/**
 * This is the model class for table "u_products_unchecked".
 *
 * @property integer $id
 * @property integer $id_product
 * @property integer $date
 *
 * @property UProducts $idProduct
 */
class UProductsUnchecked extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'u_products_unchecked';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'date'], 'integer'],
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
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduct()
    {
        return $this->hasOne(UProducts::className(), ['id' => 'id_product']);
    }
}
