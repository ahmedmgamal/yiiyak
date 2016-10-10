<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\IcsrVersionResponse $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="icsr-version-response-form">

    <?php $form = ActiveForm::begin([
    'id' => 'IcsrVersionResponse',
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

            <div class="form-group  ">

                <label class="control-label col-sm-3" for="responseType"><?= Yii::t('app','Response Type'); ?></label>
            <div class="col-sm-6">
            <?= Html::dropDownList('responseType',null,['file' => Yii::t('app','Upload File') , 'id' => Yii::t('app','Write ID') , 'received' => Yii::t('app','Received')],['class' => 'form-control' , 'id' => 'responseType']); ?>
            </div>

        </div>
            <?= $form->field($model, 'xmlFile')->fileInput(); ?>

        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => Yii::t('app', StringHelper::basename('backend\modules\crud\models\IcsrVersionResponse')),
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


<?php $this->registerJsFile('@web/crud/icsr-version-response/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>

