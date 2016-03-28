<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/e0080b9d6ffa35acb85312bf99a557f2
 *
 * @package default
 */


namespace backend\modules\crud\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\crud\models\Drug as DrugModel;

/**
 * Drug represents the model behind the search form about `backend\modules\crud\models\Drug`.
 */
class Drug extends DrugModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'company_id', 'route_lkp_id'], 'integer'],
			[['generic_name', 'trade_name', 'composition', 'manufacturer', 'strength'], 'safe'],
		];
	}


	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}


	/**
	 * Creates data provider instance with search query applied
	 *
	 *
	 * @param array   $params
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = DrugModel::find();

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
				'company_id' => $this->company_id,
				'route_lkp_id' => $this->route_lkp_id,
			]);

		$query->andFilterWhere(['like', 'generic_name', $this->generic_name])
		->andFilterWhere(['like', 'trade_name', $this->trade_name])
		->andFilterWhere(['like', 'composition', $this->composition])
		->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
		->andFilterWhere(['like', 'strength', $this->strength]);

		return $dataProvider;
	}


}
