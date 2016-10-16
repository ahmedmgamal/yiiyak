<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\PsmfSection $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="psmf-section-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    'id' => 'PsmfSection',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <br>
        <button type="button" id="addSection" class="btn btn-primary" > <?php echo Yii::t('app','Add Section') ?> <span class="glyphicon glyphicon-plus"></span></button>
<div class="psmf-sections">
        <div class="psmf-section">

			<?= $form->field($model, 'section_name[]')->textInput(['maxlength' => true , 'required' => true]) ?>
			<?= $form->field($model, 'section_content[]')->textarea(['rows' => 6 , 'required' => true]) ?>
        </div>


</div>

        <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true]); ?>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => Yii::t('app', StringHelper::basename('backend\modules\crud\models\PsmfSection')),
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
        ($model->isNewRecord ? 'Export' : 'Export'),
        [
        'id' => 'save-' . $model->formName(),
        'class' => 'btn btn-success'
        ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>


</div>

<?php $this->registerJsFile('@web/crud/psmf-section/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>
