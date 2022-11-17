<?php

namespace app\forms\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dismiss;

/**
 * DismissSearch represents the model behind the search form about `app\models\Dismiss`.
 */
class DismissSearch extends Dismiss
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['id', 'order_id', 'employee_id'],
                'integer'
            ],
            [
                ['date', 'reason'],
                'safe'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios(): array
    {
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
        $query = Dismiss::find();

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
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'reason', $this->reason]);

        return $dataProvider;
    }
}
