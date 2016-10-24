<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\IcsrNarritive $model
*/

$this->title = Yii::t('app', 'IcsrNarritive') . $model->id . ', ' . 'Edit';
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="giiant-crud icsr-narritive-update">

    <h1>
        <?= Yii::t('app', 'Icsr Narrative') ?>
        <small>
                                </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . 'View', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
