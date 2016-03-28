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
 * @var backend\modules\crud\models\search\IcsrTest $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="icsr-test-search">

    <?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    		<?php echo $form->field($model, 'id') ?>

		<?php echo $form->field($model, 'icsr_id') ?>

		<?php echo $form->field($model, 'test_lkp_id') ?>

		<?php echo $form->field($model, 'date') ?>

		<?php echo $form->field($model, 'result') ?>

		<?php // echo $form->field($model, 'result_unit') ?>

		<?php // echo $form->field($model, 'normal_low_range') ?>

		<?php // echo $form->field($model, 'normal_high_range') ?>

		<?php // echo $form->field($model, 'more_info') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
