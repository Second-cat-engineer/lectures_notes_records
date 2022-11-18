<?php

namespace app\forms;

use yii\base\Model;

/**
 * @property string $date
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 */
class InterviewJoinForm extends Model
{
    public $date;
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $email = null;

    public function init()
    {
        $this->date = date('Y-m-d');
    }

    public function rules(): array
    {
        return [
            [
                ['date', 'firstName', 'lastName'],
                'required'
            ],
            [
                ['date'],
                'date',
                'format' => 'php:Y-m-d'
            ],
            [
                ['email'],
                'email'
            ],
            [
                ['firstName', 'lastName', 'email'],
                'string',
                'max' => 255
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'date' => 'Date',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
        ];
    }
}