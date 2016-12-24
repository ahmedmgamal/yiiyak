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
use backend\modules\crud\models\User as UserModel;

/**
 * User represents the model behind the search form about `backend\modules\crud\models\User`.
 */
class User extends UserModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'status', 'created_at', 'updated_at'], 'integer'],
			[['username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
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
        $userRole = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);

		$query = UserModel::find();


        if (isset($userRole['Manager']))
        {
            $query = UserModel::find()->where(['company_id' => \Yii::$app->user->identity->company_id]);
        }

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
				'status' => $this->status,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			]);

		$query->andFilterWhere(['like', 'username', $this->username])
		->andFilterWhere(['like', 'auth_key', $this->auth_key])
		->andFilterWhere(['like', 'password_hash', $this->password_hash])
		->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
		->andFilterWhere(['like', 'email', $this->email]);

		return $dataProvider;
	}


}
