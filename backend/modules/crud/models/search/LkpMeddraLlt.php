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
use backend\modules\crud\models\LkpMeddraLlt as LkpMeddraLltModel;

/**
 * LkpMeddraLlt represents the model behind the search form about `backend\modules\crud\models\LkpMeddraLlt`.
 */
class LkpMeddraLlt extends LkpMeddraLltModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'meddra_pt_id'], 'integer'],
			[['code', 'description'], 'safe'],
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
		$query = LkpMeddraLltModel::find();

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
				'meddra_pt_id' => $this->meddra_pt_id,
			]);

		$query->andFilterWhere(['like', 'code', $this->code])
		->andFilterWhere(['like', 'description', $this->description]);

		return $dataProvider;
	}


}
