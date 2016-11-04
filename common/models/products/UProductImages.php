<?php

namespace common\models\products;

use Yii;
use common\models\files\UFiles;

/**
 * This is the model class for table "u_product_images".
 *
 * @property integer $id
 * @property integer $id_product
 * @property integer $id_file
 * @property integer $date
 *
 * @property UFiles $idFile
 * @property UProducts $idProduct
 */
class UProductImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'u_product_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_file', 'date'], 'integer'],
            [['id_file'], 'exist', 'skipOnError' => true, 'targetClass' => UFiles::className(), 'targetAttribute' => ['id_file' => 'id']],
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
            'id_file' => 'Id File',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFile()
    {
        return $this->hasOne(UFiles::className(), ['id' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduct()
    {
        return $this->hasOne(UProducts::className(), ['id' => 'id_product']);
    }
}
