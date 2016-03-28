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
use backend\modules\crud\models\IcsrEvent as IcsrEventModel;

/**
 * IcsrEvent represents the model behind the search form about `backend\modules\crud\models\IcsrEvent`.
 */
class IcsrEvent extends IcsrEventModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'icsr_id', 'meddra_llt_id', 'meddra_pt_id'], 'integer'],
			[['event_description', 'event_type', 'event_date'], 'safe'],
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
			]);

		$query->andFilterWhere(['like', 'event_description', $this->event_description])
		->andFilterWhere(['like', 'event_type', $this->event_type]);

		return $dataProvider;
	}


}
