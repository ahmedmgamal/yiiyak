<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;
use yii\jui\DatePicker;

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

            <?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'version_description')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'prsuFile')->fileInput() ?>
            <?= $form->field($model,'next_prsu_date')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd']);?>
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

