<?php

namespace app\forms;

use app\models\Interview;
use yii\base\Model;

class InterviewEditForm extends Model
{
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $email = null;

    private Interview $interview;

    public function __construct(Interview $interview, $config = [])
    {
        $this->interview = $interview;
        $this->lastName = $interview->last_name;
        $this->firstName = $interview->first_name;
        $this->email = $interview->email;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [
                ['firstName', 'lastName'],
                'required'
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

    public function attributeLabels(): array
    {
        return [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
        ];
    }
}