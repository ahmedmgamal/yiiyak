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
 * @var backend\modules\crud\models\search\Drug $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="drug-search">

    <?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    		<?php echo $form->field($model, 'id') ?>

		<?php echo $form->field($model, 'generic_name') ?>

		<?php echo $form->field($model, 'trade_name') ?>

		<?php echo $form->field($model, 'composition') ?>

		<?php echo $form->field($model, 'company_id') ?>

		<?php // echo $form->field($model, 'manufacturer') ?>

		<?php // echo $form->field($model, 'strength') ?>

		<?php // echo $form->field($model, 'route_lkp_id') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
