<?php

namespace common\models\mails;

use Yii;

/**
 * This is the model class for table "c_mails".
 *
 * @property integer $id
 * @property string $from
 * @property string $subject
 * @property string $message
 * @property integer $date
 * @property integer $status
 */
class CMails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_mails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'status'], 'integer'],
            [['from', 'subject', 'message'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'subject' => 'Subject',
            'message' => 'Message',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }
}
