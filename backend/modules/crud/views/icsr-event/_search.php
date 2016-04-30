<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\search\IcsrEvent $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="icsr-event-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'icsr_id') ?>

		<?= $form->field($model, 'event_description') ?>

		<?= $form->field($model, 'meddra_llt_id') ?>

		<?= $form->field($model, 'meddra_pt_id') ?>

		<?php // echo $form->field($model, 'event_date') ?>

		<?php // echo $form->field($model, 'event_end_date') ?>

		<?php // echo $form->field($model, 'event_outcome') ?>

		<?php // echo $form->field($model, 'meddra_llt_text') ?>

		<?php // echo $form->field($model, 'meddra_pt_text') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
