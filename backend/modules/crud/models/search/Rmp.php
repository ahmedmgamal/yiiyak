<?php


namespace backend\modules\crud\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\crud\models\Rmp as RmpModel;

/**
 * Company represents the model behind the search form about `backend\modules\crud\models\Company`.
 */
class Rmp extends RmpModel
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['drug_id', 'ack_created_by'], 'integer'],
            [['version', 'ack_created_at','rmp_created_by'], 'safe'],
            [['version_description', 'rmp_file_url', 'ack_file_url'], 'string', 'max' => 255],
            [['drug_id'], 'exist', 'skipOnError' => true, 'targetClass' => Drug::className(), 'targetAttribute' => ['drug_id' => 'id']],
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

        $this->drug_id = (isset($params['id']))? $params['id'] : '';


        $query = RmpModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('rmpUser');

        $query->andFilterWhere([
            'id' => $this->id,
            'drug_id' => $this->drug_id
        ]);


        $query->andFilterWhere(['like', 'version', $this->version])
              ->andFilterWhere(['like', 'version_description', $this->version_description])
              ->andFilterWhere(['like', 'user.username', $this->rmp_created_by]);

        return $dataProvider;
    }


}