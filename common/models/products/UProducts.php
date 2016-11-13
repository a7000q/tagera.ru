<?php

namespace common\models\products;

use Yii;
use common\models\category\SCategory;
use common\models\user\User;
use common\models\geo\City;
use Zelenin\yii\behaviors\Slug;

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

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => Slug::className(),
                'slugAttribute' => 'slug',
                'attribute' => 'name',
                // optional params
                'ensureUnique' => true,
                'replacement' => '-',
                'lowercase' => true,
                'immutable' => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_category', 'date', 'id_city', 'status'], 'integer'],
            [['name', 'description', 'username', 'phone'], 'string', 'max' => 255],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => SCategory::className(), 'targetAttribute' => ['id_category' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['price'], 'number'],
            [['name', 'username', 'phone', 'id_city', 'id_category'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'id_user' => 'Id User',
            'id_category' => 'Id Category',
            'date' => 'Дата',
            'price' => 'Цена',
            'username' => 'Имя',
            'phone' => 'Телефон',
            'id_city' => 'Город',
            'status' => 'Статус'
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

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'id_city']);
    }
}
