<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property string $date
 *
 * @property Assignment[] $assignments
 * @property Dismiss[] $dismisses
 * @property Bonus[] $bonuses
 * @property Recruit[] $recruits
 * @property Vacation[] $vacations
 */
class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['date'],
                'required'
            ],
            [
                ['date'],
                'date',
                'format' => 'php:Y-m-d'
            ],
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
        ];
    }

    public function getAssignments(): ActiveQuery
    {
        return $this->hasMany(Assignment::class, ['order_id' => 'id']);
    }

    public function getDismisses(): ActiveQuery
    {
        return $this->hasMany(Dismiss::class, ['order_id' => 'id']);
    }

    public function getBonuses(): ActiveQuery
    {
        return $this->hasMany(Bonus::class, ['order_id' => 'id']);
    }

    public function getRecruits(): ActiveQuery
    {
        return $this->hasMany(Recruit::class, ['order_id' => 'id']);
    }

    public function getVacations(): ActiveQuery
    {
        return $this->hasMany(Vacation::class, ['order_id' => 'id']);
    }
}
