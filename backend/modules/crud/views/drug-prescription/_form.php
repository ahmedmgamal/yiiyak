<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\DrugPrescription $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="drug-prescription-form">

    <?php $form = ActiveForm::begin([
    'id' => 'DrugPrescription',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            
 <?php  echo       Html::activeHiddenInput($model, 'icsr_id') ; ?>
			<?=                         $form->field($model, 'drug_role')->dropDownList(
                            
                            \yii\helpers\ArrayHelper::map(backend\modules\crud\models\LkpDrugRole::find()->all(), 'id', 'name')

                        ); ?>

			<?= $form->field($model, 'active_substance_names')->textInput(['maxlength' => true]) ?>

			<?php echo $form->field($model, 'dose')->textInput(['maxlength' => true]) ?>

			<?php echo $form->field($model, 'expiration_date')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd']); ?>
			<?php echo $form->field($model, 'lot_no')->textInput(['maxlength' => true]) ?>

			<?php echo $form->field($model, 'use_date_start')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd']); ?>
			<?php echo $form->field($model, 'use_date_end')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd']); ?>
			<?php echo $form->field($model, 'duration_of_use')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'duration_of_use_unit')->dropDownList(                          
                            \yii\helpers\ArrayHelper::map(backend\modules\crud\models\LkpTimeUnit::find()->all(), 'id', 'name')

                        ); ?>
			<?php echo $form->field($model, 'reason_of_use')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'problem_went_after_stop')->checkbox(); ?>
			<?php echo $form->field($model, 'problem_returned_after_reuse')->checkbox(); ?>
			<?php echo  $form->field($model, 'product_avilable')->checkbox(); ?>
			<?= $form->field($model, 'drug_addtional_info')->textInput(['maxlength' => true]) ?>

            <?php
                $drug_actions = backend\modules\crud\models\LkpDrugAction::find()->all();
                $drug_actions_drop_list = ArrayHelper::map($drug_actions,'id','name');
                ?>

            <?=       $form->field($model, 'lkp_drug_action_id')->dropDownList($drug_actions_drop_list) ?>

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

