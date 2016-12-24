<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/4b7e79a8340461fe629a6ac612644d03
 *
 * @package default
 */


use yii\helpers\ArrayHelper;
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
<?php $company_id = isset($_GET['Company']['company_id']) ? $_GET['Company']['company_id'] : 0;
	  $createdUserRole = isset($model->id) ? $model->getRole($model->id)['item_name'] : 0;

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

			<?php echo $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
			<?php
			if ($this->context->action->id == 'create') {
				echo $form->field($model, 'password_hash')->textInput(['maxlength' => true]);
			}
			?>
			<?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group field-role_name required">
            <label class="control-label col-sm-3" for="role_name"><?= Yii::t('app','Role')?></label>
            <div class="col-sm-6">
                <select id="role_name" class="form-control" name="role_name">
                    <?php foreach ($roles as $key => $value){?>
                    <option value="<?= $value?>" <?php if($value == $createdUserRole) echo 'selected';?> >
						<?= Yii::t('app',$value)?>
						</option>
                    <?php }?>
                </select>
            </div>

        </div>

			<?php if (isset(\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id)['admin'])) {?>
			<?php echo $form->field($model,'company_id')->dropDownList(ArrayHelper::map($model->getAllCompanies(),'id','name'),['options'=>[$company_id=>['Selected'=>true]]]); ?>
			<?php }?>
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
