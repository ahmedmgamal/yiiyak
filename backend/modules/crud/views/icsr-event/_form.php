<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\IcsrEvent $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="icsr-event-form">

    <?php $form = ActiveForm::begin([
    'id' => 'IcsrEvent',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            
			<?php echo       Html::activeHiddenInput($model, 'icsr_id') ;?>
			<?php echo $form->field($model, 'event_description')->textInput(['maxlength' => true]) ?>
 			<?= $form->field($model, 'meddra_llt_text')->textInput(['maxlength' => true]) ?>
             <?= $form->field($model, 'meddra_pt_text')->textInput(['maxlength' => true]) ?>
 




        <?php echo $form->field($model, 'event_date')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd']); ?>
        <?php echo $form->field($model, 'event_end_date')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd']); ?>

            <?php
            $events_outcome = backend\modules\crud\models\LkpIcsrEventoutcome::find()->all();
            $events_outcome_list = ArrayHelper::map($events_outcome,'id','name');
            ?>
			<?=  $form->field($model, 'lkp_icsr_eventoutcome_id')->dropDownList($events_outcome_list )->label('Event Outcome'); ?>


       </p>
        <?php $this->endBlock(); ?>
        
        <?=
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

        <?= Html::submitButton(
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

<?php $this->registerJsFile('@web/crud/icsr-event/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>
