<?php

namespace common\models\category;

use Yii;
use common\models\files\UFiles;

/**
 * This is the model class for table "s_category_image".
 *
 * @property integer $id
 * @property integer $id_category
 * @property integer $id_file
 *
 * @property SCategory $idCategory
 * @property UFiles $idFile
 */
class SCategoryImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 's_category_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category', 'id_file'], 'integer'],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => SCategory::className(), 'targetAttribute' => ['id_category' => 'id']],
            [['id_file'], 'exist', 'skipOnError' => true, 'targetClass' => UFiles::className(), 'targetAttribute' => ['id_file' => 'id']],
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
            'id_file' => 'Id File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategory()
    {
        return $this->hasOne(SCategory::className(), ['id' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(UFiles::className(), ['id' => 'id_file']);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $this->file->delete();
            return true;
        } else {
            return false;
        }
    }
}
