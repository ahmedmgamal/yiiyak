<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\crud\models\LkpIcsrEventoutcome */

$this->title = 'Create Lkp Icsr Eventoutcome';
$this->params['breadcrumbs'][] = ['label' => 'Lkp Icsr Eventoutcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lkp-icsr-eventoutcome-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
