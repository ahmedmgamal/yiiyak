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
use backend\modules\crud\models\IcsrReporter as IcsrReporterModel;

/**
 * IcsrReporter represents the model behind the search form about `backend\modules\crud\models\IcsrReporter`.
 */
class IcsrReporter extends IcsrReporterModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'icsr_id', 'country_lkp_id', 'occupation_lkp_id'], 'integer'],
			[['first_name', 'last_name', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'phone', 'email', 'health_professional'], 'safe'],
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
		$query = IcsrReporterModel::find();

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
				'country_lkp_id' => $this->country_lkp_id,
				'occupation_lkp_id' => $this->occupation_lkp_id,
			]);

		$query->andFilterWhere(['like', 'first_name', $this->first_name])
		->andFilterWhere(['like', 'last_name', $this->last_name])
		->andFilterWhere(['like', 'address_line_1', $this->address_line_1])
		->andFilterWhere(['like', 'address_line_2', $this->address_line_2])
		->andFilterWhere(['like', 'city', $this->city])
		->andFilterWhere(['like', 'state', $this->state])
		->andFilterWhere(['like', 'zip_code', $this->zip_code])
		->andFilterWhere(['like', 'phone', $this->phone])
		->andFilterWhere(['like', 'email', $this->email])
		->andFilterWhere(['like', 'health_professional', $this->health_professional]);

		return $dataProvider;
	}


}
