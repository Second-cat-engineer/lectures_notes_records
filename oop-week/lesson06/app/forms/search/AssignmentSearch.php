<?php

namespace app\forms\search;

use app\models\Assignment;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AssignmentSearch extends Assignment
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['id', 'order_id', 'employee_id', 'position_id', 'salary'],
                'integer'
            ],
            [
                ['date'],
                'safe'
            ],
            [
                ['active'],
                'boolean'
            ],
            [
                ['rate'],
                'number'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Assignment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'employee_id' => $this->employee_id,
            'position_id' => $this->position_id,
            'date' => $this->date,
            'rate' => $this->rate,
            'salary' => $this->salary,
            'active' => $this->active,
        ]);

        return $dataProvider;
    }
}
