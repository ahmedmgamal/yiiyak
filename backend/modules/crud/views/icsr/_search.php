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
 * @var backend\modules\crud\models\search\Icsr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="icsr-search">

    <?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    		<?php echo $form->field($model, 'id') ?>

		<?php echo $form->field($model, 'drug_id') ?>

		<?php echo $form->field($model, 'patient_identifier') ?>

		<?php echo $form->field($model, 'patient_age') ?>

		<?php echo $form->field($model, 'patient_age_unit') ?>

		<?php // echo $form->field($model, 'patient_birth_date') ?>

		<?php // echo $form->field($model, 'patient_weight') ?>

		<?php // echo $form->field($model, 'patient_weight_unit') ?>

		<?php // echo $form->field($model, 'extra_history') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
