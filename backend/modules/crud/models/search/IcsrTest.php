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
use backend\modules\crud\models\IcsrTest as IcsrTestModel;

/**
 * IcsrTest represents the model behind the search form about `backend\modules\crud\models\IcsrTest`.
 */
class IcsrTest extends IcsrTestModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'icsr_id', 'test_lkp_id'], 'integer'],
			[['date', 'result', 'result_unit', 'normal_low_range', 'normal_high_range', 'more_info'], 'safe'],
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
		$query = IcsrTestModel::find();

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
				'test_lkp_id' => $this->test_lkp_id,
				'date' => $this->date,
			]);

		$query->andFilterWhere(['like', 'result', $this->result])
		->andFilterWhere(['like', 'result_unit', $this->result_unit])
		->andFilterWhere(['like', 'normal_low_range', $this->normal_low_range])
		->andFilterWhere(['like', 'normal_high_range', $this->normal_high_range])
		->andFilterWhere(['like', 'more_info', $this->more_info]);

		return $dataProvider;
	}


}
