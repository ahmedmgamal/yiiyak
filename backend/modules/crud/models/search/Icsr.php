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
use backend\modules\crud\models\Icsr as IcsrModel;

/**
 * Icsr represents the model behind the search form about `backend\modules\crud\models\Icsr`.
 */
class Icsr extends IcsrModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'drug_id'], 'integer'],
			[['patient_identifier', 'patient_age_unit', 'patient_birth_date', 'patient_weight_unit', 'extra_history'], 'safe'],
			[['patient_age', 'patient_weight'], 'number'],
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
		$query = IcsrModel::find();

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
				'drug_id' => $this->drug_id,
				'patient_age' => $this->patient_age,
				'patient_birth_date' => $this->patient_birth_date,
				'patient_weight' => $this->patient_weight,
			]);

		$query->andFilterWhere(['like', 'patient_identifier', $this->patient_identifier])
		->andFilterWhere(['like', 'patient_age_unit', $this->patient_age_unit])
		->andFilterWhere(['like', 'patient_weight_unit', $this->patient_weight_unit])
		->andFilterWhere(['like', 'extra_history', $this->extra_history]);

		return $dataProvider;
	}


}
