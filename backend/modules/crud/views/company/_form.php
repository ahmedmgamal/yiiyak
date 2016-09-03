<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/4b7e79a8340461fe629a6ac612644d03
 *
 * @package default
 */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
 *
 * @var yii\web\View $this
 * @var backend\modules\crud\models\Company $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin([
		'id' => 'Company',
		'layout' => 'horizontal',
		'enableClientValidation' => true,
		'errorSummaryCssClass' => 'error-summary alert alert-error'
	]
);
?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
			<?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'adderess')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'reg_no')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'license_no')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'license_image_url')->textInput(['maxlength' => true]) ?>

			<?php if ($this->context->action->id == 'create') { ?>
			<?php echo $form->field($userModel, 'username')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($userModel, 'email')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($userModel, 'password_hash')->textInput(['maxlength' => true]) ?>

			<?php } ?>

		</p>
        <?php $this->endBlock(); ?>

        <?php echo
Tabs::widget(
	[
		'encodeLabels' => false,
		'items' => [ [
				'label'   => $model->getAliasModel(),
				'content' => $this->blocks['main'],
				'active'  => true,
			], ]
	]
);
?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?php echo Html::submitButton(
	'<span class="glyphicon glyphicon-check"></span> ' .
	($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
	[
		'id' => 'save-' . $model->formName(),
		'class' => 'btn btn-success'
	]
);
?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
