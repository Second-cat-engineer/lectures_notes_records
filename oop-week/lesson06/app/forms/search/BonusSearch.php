<?php

namespace app\forms\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bonus;

/**
 * BonusSearch represents the model behind the search form about `app\models\Bonus`.
 */
class BonusSearch extends Bonus
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['id', 'order_id', 'employee_id', 'cost'],
                'integer'
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
        $query = Bonus::find();

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
            'cost' => $this->cost,
        ]);

        return $dataProvider;
    }
}
