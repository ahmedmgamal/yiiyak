<?php

namespace backend\modules\crud\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\crud\models\IcsrEvent as IcsrEventModel;

/**
* IcsrEvent represents the model behind the search form about `backend\modules\crud\models\IcsrEvent`.
*/
class IcsrEvent extends IcsrEventModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'icsr_id', 'meddra_llt_id', 'meddra_pt_id'], 'integer'],
            [['event_description', 'event_date', 'event_end_date', 'event_outcome', 'meddra_llt_text', 'meddra_pt_text'], 'safe'],
];
}

/**
* @inheritdoc
*/
public function scenarios()
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
public function search($params)
{
$query = IcsrEventModel::find();

$dataProvider = new ActiveDataProvider([
'query' => $query,
]);

$this->load($params);

if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
return $dataProvider;
}

$query->andFilterWhere([
            'id' => $this->id,
            'icsr_id' => $this->icsr_id,
            'meddra_llt_id' => $this->meddra_llt_id,
            'meddra_pt_id' => $this->meddra_pt_id,
            'event_date' => $this->event_date,
            'event_end_date' => $this->event_end_date,
        ]);

        $query->andFilterWhere(['like', 'event_description', $this->event_description])
            ->andFilterWhere(['like', 'event_outcome', $this->event_outcome])
            ->andFilterWhere(['like', 'meddra_llt_text', $this->meddra_llt_text])
            ->andFilterWhere(['like', 'meddra_pt_text', $this->meddra_pt_text]);

return $dataProvider;
}
}