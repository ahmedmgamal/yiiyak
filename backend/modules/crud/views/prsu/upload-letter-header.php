<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

$this->title = 'Upload Letter Header';

?>
<div class="giiant-crud prsu-create">

    <h1>
        <?= Yii::t('app', 'Upload Letter Header') ?>        <small>
                 </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=             Html::a(
                'Cancel',
                \yii\helpers\Url::previous(),
                ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />






    <div class="prsu-form">

        <?php $form = ActiveForm::begin([
                'id' => 'Prsu',
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

            <div class="form-group field-prsu-prsufile">
                <label class="control-label col-sm-3" for="prsu-prsuack"> <?= Yii::t('app','Upload Letter Header');?></label>
                <div class="col-sm-6">
                    <input type="hidden" name="Prsu[prsuAck]" value=""><input type="file" id="prsu-prsuack" name="Prsu[prsuAck]">
                </div>

            </div>

            </p>
            <?php $this->endBlock(); ?>

            <?=
            Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                        'label'   => Yii::t('app','Upload'),
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
                ($model->isNewRecord ? 'Upload' : 'Upload'),
                [
                    'id' => 'save-' . $model->formName(),
                    'class' => 'btn btn-success'
                ]
            );
            ?>

            <?php ActiveForm::end(); ?>

        </div>

    </div>






</div>
