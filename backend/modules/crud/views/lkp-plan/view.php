<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\LkpPlan $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('app', 'Plan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'LkpPlans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud lkp-plan-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('app', 'Plan') ?>        <small>
            <?= $model->name ?>        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>




            <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . 'New',
            ['create'],
            ['class' => 'btn btn-success']) ?>
        </div>


    </div>

    <hr />

    <?php $this->beginBlock('backend\modules\crud\models\LkpPlan'); ?>

    
    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',

        [
            'label' => 'drug',
            'value' =>  $model->getOneLimitAmount('drug'),
        ],

        [
            'label' => 'user',
            'value' =>  $model->getOneLimitAmount('user'),
        ],

    ],
    ]); ?>

    
    <hr/>

    <?php $this->endBlock(); ?>


    
<?php $this->beginBlock('Companies'); ?>
<div style='position: relative'><div style='position:absolute; right: 0px; top: 0px;'>
  <?= Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Companies',
            ['company/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' Company',
            ['company/create', 'Company' => ['plan_id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</div></div><?php Pjax::begin(['id'=>'pjax-Companies', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Companies ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?= '<div class="table-responsive">' . \yii\grid\GridView::widget([
    'layout' => '{summary}{pager}<br/>{items}{pager}',
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getCompanies(), 'pagination' => ['pageSize' => 20, 'pageParam'=>'page-companies']]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => 'First',
        'lastPageLabel'  => 'Last'
    ],
    'columns' => [[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'company' . '/' . $action;
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'company'
],
        'id',
        'name',
        'adderess',
        'license_no',
        'license_image_url:url',
        'end_date',
]
]) . '</div>' ?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


    <?= Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<b class=""># '.$model->name.'</b>',
    'content' => $this->blocks['backend\modules\crud\models\LkpPlan'],
    'active'  => true,
],[
    'content' => $this->blocks['Companies'],
    'label'   => '<small>Companies <span class="badge badge-default">'.count($model->getCompanies()->asArray()->all()).'</span></small>',
    'active'  => false,
], ]
                 ]
    );
    ?>
</div>
