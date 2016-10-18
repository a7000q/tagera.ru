<?php

namespace common\models\geo;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "city".
 *
 * @property string $id
 * @property string $id_region
 * @property string $name
 *
 * @property Profile[] $profiles
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_region'], 'required'],
            [['id_region'], 'integer'],
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
            'id_region' => 'Id Region',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['id_city' => 'id']);
    }

    static public function getAllArray()
    {
        $data = static::find()->all();
        return ArrayHelper::map($data, 'id', 'name', 'region.name');
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'id_region']);
    }
}
