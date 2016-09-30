<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/a0a12d1bd32eaeeb8b2cff56d511aa22
 *
 * @package default
 */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 *
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\crud\models\search\User $searchModel
 */
$this->title = $searchModel->getAliasModel(true);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="giiant-crud user-index">


    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>

    <h1>
        <?php echo $searchModel->getAliasModel(true) ?>        <small>
            List
        </small>
    </h1>
    <div class="clearfix crud-navigation">

		<div class="pull-left">
			<?php echo Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
		</div>
        <div class="pull-right">


                    </div>
    </div>


    <div class="table-responsive">
        <?php echo GridView::widget([
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
			[
				'attribute' => 'id',
				'value' => function ($model){

					$misleadingString = hexdec($model->id / .5 . "PVRadar");

					return "PV-User-{$misleadingString}" ;
				}
			],
			'username',

			'email:email',

			[
				'attribute' => 'status',
				'value' => function ($data){
								if ($data->status == 10){
									return 'Active';
								}
								return 'Inactive';
							}
			],
			[
				'attribute' => 'company_id',
				'value' => function ($model){
				if (isset($model->company->name)) {
					return $model->company->name;
				}
			}
			]

		],

	]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>
