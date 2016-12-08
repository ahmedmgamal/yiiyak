<?php

namespace backend\modules\crud\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\crud\models\Prsu as PrsuModel;


class Prsu extends PrsuModel
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['drug_id'], 'integer'],
            [['version','prsu_created_by','ack_created_by'], 'safe'],
            [['version_description', 'prsu_file_url', 'ack_file_url'], 'string', 'max' => 255],
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


        $query = PrsuModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('prsuUser');
        $query->joinWith('prsuAckUser ackUser');

        $query->andFilterWhere([
            'id' => $this->id,
            'drug_id' => $this->drug_id
        ]);


        $query->andFilterWhere(['like', 'version', $this->version])
            ->andFilterWhere(['like', 'version_description', $this->version_description])
            ->andFilterWhere(['like', 'user.username', $this->prsu_created_by])
            ->andFilterWhere(['like','ackUser.username',$this->ack_created_by]);

        return $dataProvider;
    }


}