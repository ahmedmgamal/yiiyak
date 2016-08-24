<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\crud\models\LkpIcsrEventoutcome */

$this->title = 'Update Lkp Icsr Eventoutcome: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lkp Icsr Eventoutcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lkp-icsr-eventoutcome-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
