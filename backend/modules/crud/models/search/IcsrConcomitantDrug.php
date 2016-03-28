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
use backend\modules\crud\models\IcsrConcomitantDrug as IcsrConcomitantDrugModel;

/**
 * IcsrConcomitantDrug represents the model behind the search form about `backend\modules\crud\models\IcsrConcomitantDrug`.
 */
class IcsrConcomitantDrug extends IcsrConcomitantDrugModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'icsr_id', 'frequency_lkp_id'], 'integer'],
			[['drug_name', 'start_date', 'stop_date', 'duration_of_use', 'dose'], 'safe'],
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
		$query = IcsrConcomitantDrugModel::find();

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
				'start_date' => $this->start_date,
				'stop_date' => $this->stop_date,
				'frequency_lkp_id' => $this->frequency_lkp_id,
			]);

		$query->andFilterWhere(['like', 'drug_name', $this->drug_name])
		->andFilterWhere(['like', 'duration_of_use', $this->duration_of_use])
		->andFilterWhere(['like', 'dose', $this->dose]);

		return $dataProvider;
	}


}
