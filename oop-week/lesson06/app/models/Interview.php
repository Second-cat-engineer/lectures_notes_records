<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%interview}}".
 *
 * @property integer $id
 * @property string $date
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property integer $status
 * @property string $reject_reason
 * @property integer $employee_id
 */
class Interview extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';

    const STATUS_NEW = 1;
    const STATUS_PASS = 2;
    const STATUS_REJECT = 3;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%interview}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['date', 'first_name', 'last_name'], 'required'],
            [['status'], 'required', 'except' => self::SCENARIO_CREATE],
            [['status'], 'default', 'value' => self::STATUS_NEW],
            [
                ['date'],
                'date',
                'format' => 'php:Y-m-d'
            ],
            [['reject_reason'], 'required', 'when' => function (self $model) {
                return $model->status == self::STATUS_REJECT;
            }, 'whenClient' => "function (attribute, value) {
                    return $('#interview-status').val() == '" . self::STATUS_REJECT. "';
                }"
            ],
            [['status', 'employee_id'], 'integer', 'except' => self::SCENARIO_CREATE],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 255],
            [['reject_reason'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'status' => 'Status',
            'reject_reason' => 'Reject Reason',
            'employee_id' => 'Employee',
        ];
    }

    public function getNextStatusList(): array
    {
        if ($this->status == self::STATUS_PASS) {
            return [
                self::STATUS_PASS => 'Passed',
            ];
        } elseif ($this->status == self::STATUS_REJECT) {
            return [
                self::STATUS_PASS => 'Passed',
                self::STATUS_REJECT => 'Rejected',
            ];
        } else {
            return [
                self::STATUS_NEW => 'New',
                self::STATUS_PASS => 'Passed',
                self::STATUS_REJECT => 'Rejected',
            ];
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (in_array('status', array_keys($changedAttributes)) && $this->status != $changedAttributes['status']) {

            $view = null;
            $subject = '';

            if ($this->status == self::STATUS_NEW) {
                $view = 'interview/join';
                $subject = 'You are joined to interview!';

                $log = new Log();
                $log->message = $this->last_name . ' ' . $this->first_name . ' is joined to interview';
                $log->save();

            } elseif ($this->status == self::STATUS_PASS) {
                $view = 'interview/pass';
                $subject = 'You are passed an interview!';

                $log = new Log();
                $log->message = $this->last_name . ' ' . $this->first_name . ' is passed an interview';
                $log->save();

            } elseif ($this->status == self::STATUS_REJECT) {
                $view = 'interview/reject';
                $subject = 'You are failed an interview';

                $log = new Log();
                $log->message = $this->last_name . ' ' . $this->first_name . ' is failed an interview';
                $log->save();
            }

            if ($this->email && !is_null($view)) {
                Yii::$app->mailer->compose($view, ['model' => $this])
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setTo($this->email)
                    ->setSubject($subject)
                    ->send();
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
