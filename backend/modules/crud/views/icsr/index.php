<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
    * @var backend\modules\crud\models\search\Icsr $searchModel
*/

$this->title = $searchModel->getAliasModel(true);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="giiant-crud icsr-index">

    <?php //             echo $this->render('_search', ['model' =>$searchModel]);
        ?>

    
    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>

    <h1>
        <?= $searchModel->getAliasModel(true) ?>        <small>
            List
        </small>
    </h1>
    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        
    </div>


    <div class="table-responsive">
        <?= GridView::widget([
        'layout' => '{summary}{pager}{items}{pager}',
        'dataProvider' => $dataProvider,
        'pager' => [
        'class' => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('app', 'First'),
        'lastPageLabel' => Yii::t('app', 'Last')        ],
                    'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
        'headerRowOptions' => ['class'=>'x'],
        'columns' => [

                [
            'class' => 'yii\grid\ActionColumn',
            'urlCreator' => function($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                return Url::toRoute($params);
            },
            'contentOptions' => ['nowrap'=>'nowrap'],
            'visibleButtons' => [ 'delete' => false]
        ],
			// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'drug_id',
				/**
				 *
				 */
    'value' => function ($model) {
        if ($rel = $model->getDrug()->one()) {
						return Html::a($rel->id, ['/crud/drug/view', 'id' => $rel->id, ], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
			'patient_identifier',
			'patient_age',
			
			[
                'attribute'=>'patient_age_unit',
                'value' => function ($model) { return $model->patient_age_unit ;}    
            ],'patient_weight',
			[
                'attribute'=>'patient_weight_unit',
                'value' =>function ($model) { return $model->getPatientWeightUnit()->one()->name;}     
            ],

			/*[
                'attribute'=>'results_in_death',
                'value' => function ($model) {
                    return backend\modules\crud\models\Icsr::getResultsInDeathValueLabel($model->results_in_death);
                }    
            ]*/
			/*[
                'attribute'=>'life_threatening',
                'value' => function ($model) {
                    return backend\modules\crud\models\Icsr::getLifeThreateningValueLabel($model->life_threatening);
                }    
            ]*/
			/*[
                'attribute'=>'requires_hospitalization',
                'value' => function ($model) {
                    return backend\modules\crud\models\Icsr::getRequiresHospitalizationValueLabel($model->requires_hospitalization);
                }    
            ]*/
			/*[
                'attribute'=>'results_in_disability',
                'value' => function ($model) {
                    return backend\modules\crud\models\Icsr::getResultsInDisabilityValueLabel($model->results_in_disability);
                }    
            ]*/
			/*[
                'attribute'=>'is_congenital_anomaly',
                'value' => function ($model) {
                    return backend\modules\crud\models\Icsr::getIsCongenitalAnomalyValueLabel($model->is_congenital_anomaly);
                }    
            ]*/
			/*[
                'attribute'=>'others_significant',
                'value' => function ($model) {
                    return backend\modules\crud\models\Icsr::getOthersSignificantValueLabel($model->others_significant);
                }    
            ]*/
			/*[
                'attribute'=>'report_type',
                'value' => function ($model) {
                    return backend\modules\crud\models\Icsr::getReportTypeValueLabel($model->report_type);
                }    
            ]*/
			/*'patient_birth_date'*/
			/*'patient_identifier'*/
			/*'extra_history'*/
        ],
        ]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>



