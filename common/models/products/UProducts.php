<?php

namespace common\models\products;

use Yii;

/**
 * This is the model class for table "u_products".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $id_user
 * @property integer $id_category
 * @property integer $date
 *
 * @property SCategory $idCategory
 * @property User $idUser
 */
class UProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'u_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_category', 'date'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => SCategory::className(), 'targetAttribute' => ['id_category' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
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
            'description' => 'Description',
            'id_user' => 'Id User',
            'id_category' => 'Id Category',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(SCategory::className(), ['id' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
