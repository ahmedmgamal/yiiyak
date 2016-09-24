<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\LkpPlan $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="lkp-plan-form">

    <?php $form = ActiveForm::begin([
    'id' => 'LkpPlan',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?php
                    foreach ($lkpLimitsModel->find()->all() as $key => $obj)
                    {
                  echo   $form->field($model, "limits[{$obj->id}]")->textInput(['type' => 'number' , 'value' => $model->getOneLimitAmount($obj->name)])->label("{$obj->name} Limit");

            }

            ?>

        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => Yii::t('app', StringHelper::basename('backend\modules\crud\models\LkpPlan')),
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

