<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\search\DrugPrescription $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="drug-prescription-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'drug_id') ?>

		<?= $form->field($model, 'icsr_id') ?>

		<?= $form->field($model, 'dose') ?>


		<?php // echo $form->field($model, 'expiration_date') ?>

		<?php // echo $form->field($model, 'lot_no') ?>

		<?php // echo $form->field($model, 'use_date_start') ?>

		<?php // echo $form->field($model, 'use_date_end') ?>

		<?php // echo $form->field($model, 'duration_of_use') ?>

		<?php // echo $form->field($model, 'duration_of_use_unit') ?>

		<?php // echo $form->field($model, 'reason_of_use') ?>


		<?php // echo $form->field($model, 'problem_returned_after_reuse') ?>

		<?php // echo $form->field($model, 'product_avilable') ?>

		<?php // echo $form->field($model, 'active_substance_names') ?>

		<?php // echo $form->field($model, 'drug_role') ?>

		<?php // echo $form->field($model, 'drug_addtional_info') ?>

		<?php // echo $form->field($model, 'drug_action_drug_withdrawn')->checkbox() ?>

		<?php // echo $form->field($model, 'drug_action_dose_reduced')->checkbox() ?>

		<?php // echo $form->field($model, 'drug_action_dose_increased')->checkbox() ?>

		<?php // echo $form->field($model, 'drug_action_dose_not_changed')->checkbox() ?>

		<?php // echo $form->field($model, 'drug_action_unknown')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
