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
 * @var backend\modules\crud\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
		'id' => 'User',
		'layout' => 'horizontal',
		'enableClientValidation' => true,
		'errorSummaryCssClass' => 'error-summary alert alert-error'
	]
);
?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

			<?php echo $form->field($model, 'id')->textInput() ?>
			<?php echo $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'status')->textInput() ?>
			<?php echo $form->field($model, 'created_at')->textInput() ?>
			<?php echo $form->field($model, 'updated_at')->textInput() ?>
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
