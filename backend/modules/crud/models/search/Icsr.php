<?php

namespace backend\modules\crud\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\crud\models\Icsr as IcsrModel;
use yii\helpers\VarDumper;

/**
* Icsr represents the model behind the search form about `backend\modules\crud\models\Icsr`.
*/
class Icsr extends IcsrModel
{
    public $safetyReportId;
    public $meddraLltFromEvents;
/**
	 *
* @inheritdoc
	 * @return unknown
*/
	public function rules() {
return [
[['id', 'drug_id', 'reaction_country_id'], 'integer'],
            [['status','meddraLltFromEvents','safetyReportId','created_by','patient_identifier', 'patient_age_unit', 'patient_birth_date', 'patient_weight_unit', 'extra_history', 'is_serious', 'results_in_death', 'life_threatening', 'requires_hospitalization', 'results_in_disability', 'is_congenital_anomaly', 'others_significant', 'report_type'], 'safe'],
            [['patient_age', 'patient_weight'], 'number'],
];
}

/**
* @inheritdoc
*/
	public function scenarios() {
// bypass scenarios() implementation in the parent class
return Model::scenarios();
}

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params , $stat) {

        $this->drug_id = (isset($params['id']))? $params['id'] : '';
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
        $query->joinWith('createdBy');
        $query->joinWith('reactionCountry');
        $query->joinWith('drug');
        $query->joinWith('icsrEvents');
        $query->where(['=', 'icsr.status' ,$stat]);
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
            ->andFilterWhere(['like', 'extra_history', $this->extra_history])
            ->andFilterWhere(['like', 'is_serious', $this->is_serious])
            ->andFilterWhere(['like', 'results_in_death', $this->results_in_death])
            ->andFilterWhere(['like', 'life_threatening', $this->life_threatening])
            ->andFilterWhere(['like', 'requires_hospitalization', $this->requires_hospitalization])
            ->andFilterWhere(['like', 'results_in_disability', $this->results_in_disability])
            ->andFilterWhere(['like', 'is_congenital_anomaly', $this->is_congenital_anomaly])
            ->andFilterWhere(['like', 'others_significant', $this->others_significant])
            ->andFilterWhere(['like', 'report_type', $this->report_type])
            ->andFilterWhere(['like', 'user.username', $this->created_by])
            ->andFilterWhere(['like','icsr_event.meddra_llt_text',$this->meddraLltFromEvents]);

            $query->leftJoin('company','`drug`.company_id = `company`.id');
            $query->andWhere('`icsr`.id LIKE "%' . $this->safetyReportId . '%" ' .
                'OR `lkp_country`.code LIKE "%' . $this->safetyReportId . '%"' .
                'OR `company`.short_name LIKE "%' . $this->safetyReportId . '%"'
            );

        return $dataProvider;
    }
}