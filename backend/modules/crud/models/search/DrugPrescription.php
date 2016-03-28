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
use backend\modules\crud\models\DrugPrescription as DrugPrescriptionModel;

/**
 * DrugPrescription represents the model behind the search form about `backend\modules\crud\models\DrugPrescription`.
 */
class DrugPrescription extends DrugPrescriptionModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'drug_id', 'icsr_id', 'frequency_lkp_id'], 'integer'],
			[['dose', 'expiration_date', 'lot_no', 'ndc', 'use_date_start', 'use_date_end', 'duration_of_use_unit', 'reason_of_use', 'problem_went_after_stop', 'problem_returned_after_reuse', 'product_avilable'], 'safe'],
			[['duration_of_use'], 'number'],
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
		$query = DrugPrescriptionModel::find();

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
				'icsr_id' => $this->icsr_id,
				'frequency_lkp_id' => $this->frequency_lkp_id,
				'expiration_date' => $this->expiration_date,
				'use_date_start' => $this->use_date_start,
				'use_date_end' => $this->use_date_end,
				'duration_of_use' => $this->duration_of_use,
			]);

		$query->andFilterWhere(['like', 'dose', $this->dose])
		->andFilterWhere(['like', 'lot_no', $this->lot_no])
		->andFilterWhere(['like', 'ndc', $this->ndc])
		->andFilterWhere(['like', 'duration_of_use_unit', $this->duration_of_use_unit])
		->andFilterWhere(['like', 'reason_of_use', $this->reason_of_use])
		->andFilterWhere(['like', 'problem_went_after_stop', $this->problem_went_after_stop])
		->andFilterWhere(['like', 'problem_returned_after_reuse', $this->problem_returned_after_reuse])
		->andFilterWhere(['like', 'product_avilable', $this->product_avilable]);

		return $dataProvider;
	}


}
