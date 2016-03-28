<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/eeda5c365686c9888dbc13dbc58f89a1
 *
 * @package default
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 *
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

    		<?php echo $form->field($model, 'id') ?>

		<?php echo $form->field($model, 'drug_id') ?>

		<?php echo $form->field($model, 'icsr_id') ?>

		<?php echo $form->field($model, 'dose') ?>

		<?php echo $form->field($model, 'frequency_lkp_id') ?>

		<?php // echo $form->field($model, 'expiration_date') ?>

		<?php // echo $form->field($model, 'lot_no') ?>

		<?php // echo $form->field($model, 'ndc') ?>

		<?php // echo $form->field($model, 'use_date_start') ?>

		<?php // echo $form->field($model, 'use_date_end') ?>

		<?php // echo $form->field($model, 'duration_of_use') ?>

		<?php // echo $form->field($model, 'duration_of_use_unit') ?>

		<?php // echo $form->field($model, 'reason_of_use') ?>

		<?php // echo $form->field($model, 'problem_went_after_stop') ?>

		<?php // echo $form->field($model, 'problem_returned_after_reuse') ?>

		<?php // echo $form->field($model, 'product_avilable') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
