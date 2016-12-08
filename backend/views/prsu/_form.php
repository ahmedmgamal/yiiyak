<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\Prsu $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="prsu-form">

    <?php $form = ActiveForm::begin([
    'id' => 'Prsu',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            
			<?= $form->field($model, 'id')->textInput() ?>
			<?= $form->field($model, 'drug_id')->textInput() ?>
			<?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'version_description')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'prsu_file_url')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ack_file_url')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'prsu_created_by')->textInput() ?>
			<?= $form->field($model, 'prsu_created_at')->textInput() ?>
			<?= $form->field($model, 'ack_created_by')->textInput() ?>
			<?= $form->field($model, 'ack_created_at')->textInput() ?>
			<?= $form->field($model, 'next_prsu_date')->textInput() ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => Yii::t('app', StringHelper::basename('backend\modules\crud\models\Prsu')),
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?= Html::submitButton(
        '<span class="glyphicon glyphicon-check"></span> ' .
        ($model->isNewRecord ? 'Create' : 'Save'),
        [
        'id' => 'save-' . $model->formName(),
        'class' => 'btn btn-success'
        ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>

