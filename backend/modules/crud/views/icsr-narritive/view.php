<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\IcsrNarritive $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('app', 'IcsrNarritive');
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud icsr-narritive-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('app', 'Icsr Narrative') ?>        <small>
               </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a(
            '<span class="glyphicon glyphicon-pencil"></span> ' . 'Edit',
            [ 'update', 'id' => $model->id],
            ['class' => 'btn btn-info']) ?>


        </div>


    </div>

    <hr />

    <?php $this->beginBlock('backend\modules\crud\models\IcsrNarritive'); ?>

    
    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'narritive',
        'reporter_comment',
        'sender_comment',
    ],
    ]); ?>

    
    <hr/>


    <?php $this->endBlock(); ?>



    <?= Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<b class=""># '.Yii::t('app','Icsr Narrative').'</b>',
    'content' => $this->blocks['backend\modules\crud\models\IcsrNarritive'],
    'active'  => true,
], ]
                 ]
    );
    ?>
</div>
