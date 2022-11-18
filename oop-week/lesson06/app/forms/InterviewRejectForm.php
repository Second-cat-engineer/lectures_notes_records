<?php

namespace app\forms;

use yii\base\Model;

class InterviewRejectForm extends Model
{
    public $reason;

    public function rules(): array
    {
        return [
            [['reason'], 'required'],
            [['reason'], 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'reason' => 'Reject Reason',
        ];
    }
}