<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
*/


if (isset($actionColumnTemplates)) {
$actionColumnTemplate = implode(' ', $actionColumnTemplates);
    $actionColumnTemplateString = $actionColumnTemplate;
} else {
Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New', ['create'], ['class' => 'btn btn-success']);
    $actionColumnTemplateString = " ";
}
?>
<div class="giiant-crud psmf-section-index">

    <?php //         ?>

    
    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>

    <h1>
        <?= Yii::t('app', 'Psmf') ?>        <small>
            List
        </small>
    </h1>
    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New', ['create'], ['class' => 'btn btn-success']) ?>
        </div>


    </div>

    <hr />

    <div class="table-responsive">
        <?= GridView::widget([
        'layout' => '{summary}{pager}{items}{pager}',
        'dataProvider' => $dataProvider,
        'pager' => [
        'class' => yii\widgets\LinkPager::className(),
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last'        ],
                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
        'headerRowOptions' => ['class'=>'x'],
        'columns' => [
            [
                'label' => Yii::t('app','File'),
                'format' => 'raw',
                'value' => function ($model){
                    if (isset($model->file_url)) {
                        $url = '<a href=' . $model->file_url . ' target="_blank"> ' . Yii::t('app', 'Psmf File') . ' </a>';
                        return $url;
                    }
                }
            ],
			'version',

        ],
        ]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>


