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
 * @var backend\modules\crud\models\search\IcsrReporter $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="icsr-reporter-search">

    <?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    		<?php echo $form->field($model, 'id') ?>

		<?php echo $form->field($model, 'icsr_id') ?>

		<?php echo $form->field($model, 'country_lkp_id') ?>

		<?php echo $form->field($model, 'first_name') ?>

		<?php echo $form->field($model, 'last_name') ?>

		<?php // echo $form->field($model, 'address_line_1') ?>

		<?php // echo $form->field($model, 'address_line_2') ?>

		<?php // echo $form->field($model, 'city') ?>

		<?php // echo $form->field($model, 'state') ?>

		<?php // echo $form->field($model, 'zip_code') ?>

		<?php // echo $form->field($model, 'phone') ?>

		<?php // echo $form->field($model, 'email') ?>

		<?php // echo $form->field($model, 'occupation_lkp_id') ?>

		<?php // echo $form->field($model, 'health_professional') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
