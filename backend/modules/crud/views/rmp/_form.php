<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;
use yii\jui\DatePicker;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\Rmp $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="rmp-form">

    <?php $form = ActiveForm::begin([
    'id' => 'Rmp',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error',
    'options' => ['enctype' => 'multipart/form-data']
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            
            <?php if(!isset($model->rmp_file_url) && empty($model->rmp_file_url))
            {?>
			<?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'version_description')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'rmpFile')->fileInput() ?>
            <?= $form->field($model,'next_rmp_date')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd','clientOptions' => ['minDate' => date('Y-m-d') , 'changeYear'=>'true' ,  'changeMonth'=>'true' , 'yearRange' => '+0:+50']]);?>

            <?php }?>

            <?php if (isset($model->rmp_file_url) && !empty($model->rmp_file_url))
            {?>

			<?= $form->field($model, 'ack_file_url')->fileInput() ?>

            <?php } ?>

        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => Yii::t('app', StringHelper::basename('backend\modules\crud\models\Rmp')),
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

