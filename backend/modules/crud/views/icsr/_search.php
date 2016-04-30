<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\search\Icsr $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="icsr-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'drug_id') ?>

		<?= $form->field($model, 'patient_identifier') ?>

		<?= $form->field($model, 'patient_age') ?>

		<?= $form->field($model, 'patient_age_unit') ?>

		<?php // echo $form->field($model, 'patient_birth_date') ?>

		<?php // echo $form->field($model, 'patient_weight') ?>

		<?php // echo $form->field($model, 'patient_weight_unit') ?>

		<?php // echo $form->field($model, 'extra_history') ?>

		<?php // echo $form->field($model, 'is_serious') ?>

		<?php // echo $form->field($model, 'results_in_death') ?>

		<?php // echo $form->field($model, 'life_threatening') ?>

		<?php // echo $form->field($model, 'requires_hospitalization') ?>

		<?php // echo $form->field($model, 'results_in_disability') ?>

		<?php // echo $form->field($model, 'is_congenital_anomaly') ?>

		<?php // echo $form->field($model, 'others_significant') ?>

		<?php // echo $form->field($model, 'report_type') ?>

		<?php // echo $form->field($model, 'reaction_country_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
