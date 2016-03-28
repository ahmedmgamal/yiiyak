<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/d4b4964a63cc95065fa0ae19074007ee
 *
 * @package default
 */


use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 *
 * @var yii\web\View $this
 * @var backend\modules\crud\models\LkpIcsrOutcome $model
 */
$copyParams = $model->attributes;

$this->title = $model->getAliasModel() . $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
?>
<div class="giiant-crud lkp-icsr-outcome-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?php echo \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?php echo $model->getAliasModel() ?>        <small>
            <?php echo $model->id ?>        </small>
    </h1>


    <div class="clearfix crud-navigation">
        <!-- menu buttons -->
        <div class='pull-left'>
            <?php echo Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?php echo Html::a('<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('app', 'Copy'), ['create', 'id' => $model->id, 'LkpIcsrOutcome            '=>$copyParams], ['class' => 'btn btn-success']) ?>
            <?php echo Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="pull-right">
            <?php echo Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'Full list'), ['index'], ['class'=>'btn btn-default']) ?>
        </div>

    </div>


    <?php $this->beginBlock('backend\modules\crud\models\LkpIcsrOutcome'); ?>


    <?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'description',
		],
	]); ?>


    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id],
	[
		'class' => 'btn btn-danger',
		'data-confirm' => '' . Yii::t('app', 'Are you sure to delete this item?') . '',
		'data-method' => 'post',
	]); ?>
    <?php $this->endBlock(); ?>



<?php $this->beginBlock('Icsrs'); ?>
<div style='position: relative'><div style='position:absolute; right: 0px; top: 0px;'>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Icsrs',
	['/crud/icsr/index'],
	['class'=>'btn text-muted btn-xs']
) ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Icsr',
	['/crud/icsr/create', 'Icsr' => ['id' => $model->id]],
	['class'=>'btn btn-success btn-xs']
); ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-link"></span> ' . Yii::t('app', 'Attach') . ' Icsr', ['/crud/icsr-outcome/create', 'IcsrOutcome'=>['icsr_outcome_lkp_id'=>$model->id]],
	['class'=>'btn btn-info btn-xs']
) ?>
</div></div><?php Pjax::begin(['id'=>'pjax-Icsrs', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Icsrs ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?php echo '<div class="table-responsive">' . \yii\grid\GridView::widget([
		'layout' => '{summary}{pager}<br/>{items}{pager}',
		'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getIcsrOutcomes(), 'pagination' => ['pageSize' => 20, 'pageParam'=>'page-icsroutcomes']]),
		'pager'        => [
			'class'          => yii\widgets\LinkPager::className(),
			'firstPageLabel' => Yii::t('app', 'First'),
			'lastPageLabel'  => Yii::t('app', 'Last')
		],
		'columns' => [[
				'class'      => 'yii\grid\ActionColumn',
				'template'   => '{view} {delete}',
				'contentOptions' => ['nowrap'=>'nowrap'],

				/**
				 *
				 */
				'urlCreator' => function ($action, $model, $key, $index) {
					// using the column name as key, not mapping to 'id' like the standard generator
					$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
					$params[0] = '/crud/icsr-outcome' . '/' . $action;
					return $params;
				},
				'buttons'    => [

					/**
					 *
					 */
					'delete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
								'class' => 'text-danger',
								'title'         => Yii::t('app', 'Remove'),
								'data-confirm'  => Yii::t('app', 'Are you sure you want to delete the related item?'),
								'data-method' => 'post',
								'data-pjax' => '0',
							]);
					},

					/**
					 *
					 */
					'view' => function ($url, $model) {
						return Html::a(
							'<span class="glyphicon glyphicon-cog"></span>',
							$url,
							[
								'data-title'  => Yii::t('app', 'View Pivot Record'),
								'data-toggle' => 'tooltip',
								'data-pjax'   => '0',
								'class'       => 'text-muted',
							]
						);
					},
				],
				'controller' => '/crud/icsr-outcome'
			],
			// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'icsr_id',

				/**
				 *
				 */
				'value' => function ($model) {
					if ($rel = $model->getIcsr()->one()) {
						return Html::a($rel->id, ['/crud/icsr/view', 'id' => $rel->id, ], ['data-pjax' => 0]);
					} else {
						return '';
					}
				},
				'format' => 'raw',
			],
			'icsr_outcome_date',
		]
	]) . '</div>' ?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


    <?php echo Tabs::widget(
	[
		'id' => 'relation-tabs',
		'encodeLabels' => false,
		'items' => [ [
				'label'   => '<b class=""># '.$model->id.'</b>',
				'content' => $this->blocks['backend\modules\crud\models\LkpIcsrOutcome'],
				'active'  => true,
			], [
				'content' => $this->blocks['Icsrs'],
				'label'   => '<small>Icsrs <span class="badge badge-default">'.count($model->getIcsrs()->asArray()->all()).'</span></small>',
				'active'  => false,
			], ]
	]
);
?>
</div>
