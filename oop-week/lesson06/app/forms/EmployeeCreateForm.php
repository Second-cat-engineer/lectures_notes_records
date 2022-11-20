<?php

namespace app\forms;

use app\models\Interview;
use yii\base\Model;

class EmployeeCreateForm extends Model
{
    public string $firstName;
    public string $lastName;
    public string $address;
    public string $email;
    public $orderDate;
    public $contractDate;
    public $recruitDate;

    private ?Interview $interview;

    /**
     * @param ?Interview $interview
     * @param array $config
     */
    public function __construct(Interview $interview = null, array $config = [])
    {
        $this->interview = $interview;

        if ($this->interview) {
            $this->lastName = $this->interview->last_name;
            $this->firstName = $this->interview->first_name;
            $this->email = $this->interview->email;
        }

        $date = date('Y-m-d');

        $this->orderDate = $date;
        $this->contractDate = $date;
        $this->recruitDate = $date;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['firstName', 'lastName', 'address'], 'required'],
            [['email'], 'email'],
            [['firstName', 'lastName', 'email', 'address'], 'string', 'max' => 255],
            [['orderDate', 'contractDate', 'recruitDate'], 'required'],
            [['orderDate', 'contractDate', 'recruitDate'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'orderDate' => 'Order Date',
            'contractDate' => 'Contract Date',
            'recruitDate' => 'Recruit Date',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'address' => 'Address',
            'email' => 'Email',
        ];
    }
}