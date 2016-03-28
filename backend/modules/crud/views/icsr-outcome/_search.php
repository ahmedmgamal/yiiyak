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
 * @var backend\modules\crud\models\search\IcsrOutcome $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="icsr-outcome-search">

    <?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    		<?php echo $form->field($model, 'icsr_id') ?>

		<?php echo $form->field($model, 'icsr_outcome_lkp_id') ?>

		<?php echo $form->field($model, 'icsr_outcome_date') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
