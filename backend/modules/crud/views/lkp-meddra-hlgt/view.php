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
 * @var backend\modules\crud\models\LkpMeddraHlgt $model
 */
$copyParams = $model->attributes;

$this->title = $model->getAliasModel() . $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
?>
<div class="giiant-crud lkp-meddra-hlgt-view">

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
            <?php echo Html::a('<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('app', 'Copy'), ['create', 'id' => $model->id, 'LkpMeddraHlgt            '=>$copyParams], ['class' => 'btn btn-success']) ?>
            <?php echo Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="pull-right">
            <?php echo Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'Full list'), ['index'], ['class'=>'btn btn-default']) ?>
        </div>

    </div>


    <?php $this->beginBlock('backend\modules\crud\models\LkpMeddraHlgt'); ?>


    <?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'code',
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



<?php $this->beginBlock('LkpMeddraPts'); ?>
<div style='position: relative'><div style='position:absolute; right: 0px; top: 0px;'>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Lkp Meddra Pts',
	['/crud/lkp-meddra-pt/index'],
	['class'=>'btn text-muted btn-xs']
) ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Lkp Meddra Pt',
	['/crud/lkp-meddra-pt/create', 'LkpMeddraPt' => ['meddra_hlgt_id' => $model->id]],
	['class'=>'btn btn-success btn-xs']
); ?>
</div></div><?php Pjax::begin(['id'=>'pjax-LkpMeddraPts', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-LkpMeddraPts ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?php echo '<div class="table-responsive">' . \yii\grid\GridView::widget([
		'layout' => '{summary}{pager}<br/>{items}{pager}',
		'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getLkpMeddraPts(), 'pagination' => ['pageSize' => 20, 'pageParam'=>'page-lkpmeddrapts']]),
		'pager'        => [
			'class'          => yii\widgets\LinkPager::className(),
			'firstPageLabel' => Yii::t('app', 'First'),
			'lastPageLabel'  => Yii::t('app', 'Last')
		],
		'columns' => [[
				'class'      => 'yii\grid\ActionColumn',
				'template'   => '{view} {update}',
				'contentOptions' => ['nowrap'=>'nowrap'],

				/**
				 *
				 */
				'urlCreator' => function ($action, $model, $key, $index) {
					// using the column name as key, not mapping to 'id' like the standard generator
					$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
					$params[0] = '/crud/lkp-meddra-pt' . '/' . $action;
					return $params;
				},
				'buttons'    => [

				],
				'controller' => '/crud/lkp-meddra-pt'
			],
			'id',
			'code',
			'description',
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
				'content' => $this->blocks['backend\modules\crud\models\LkpMeddraHlgt'],
				'active'  => true,
			], [
				'content' => $this->blocks['LkpMeddraPts'],
				'label'   => '<small>Lkp Meddra Pts <span class="badge badge-default">'.count($model->getLkpMeddraPts()->asArray()->all()).'</span></small>',
				'active'  => false,
			], ]
	]
);
?>
</div>
