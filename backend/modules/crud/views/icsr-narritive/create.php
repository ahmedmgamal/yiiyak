<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\IcsrNarritive $model
*/

$this->title = 'Create';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud icsr-narritive-create">

    <h1>
        <?= Yii::t('app', 'IcsrNarritive') ?>        <small>
                        <?= $model->id ?>        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=             Html::a(
            'Cancel',
            \yii\helpers\Url::previous(),
            ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
