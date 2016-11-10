<?php

namespace common\models\files;

use Yii;

/**
 * This is the model class for table "u_files".
 *
 * @property integer $id
 * @property string $src
 *
 * @property UProductImages[] $uProductImages
 */
class UFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'u_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['src'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Src',
        ];
    }


    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            unlink(Yii::getAlias('@frontend/web/').$this->src);
            return true;
        } else {
            return false;
        }
    }
}
