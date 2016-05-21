<?php

namespace backend\modules\crud\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\crud\models\LkpWeightUnit as LkpWeightUnitModel;

/**
* LkpWeightUnit represents the model behind the search form about `backend\modules\crud\models\LkpWeightUnit`.
*/
class LkpWeightUnit extends LkpWeightUnitModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id'], 'integer'],
            [['name'], 'safe'],
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
$query = LkpWeightUnitModel::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

return $dataProvider;
}
}