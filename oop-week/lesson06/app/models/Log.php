<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $user_id
 * @property string $message
 */
class Log extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['user_id'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'message' => 'Message',
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'created_at',
                ],
            ],
            [
                'class' => BlameableBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'user_id',
                ],
            ],
        ];
    }
}
