
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
?>


<div class="create-email-form">

    <?php $form = ActiveForm::begin([
            'id' => 'createEmailForm',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error',
            'action' => 'send-email'
        ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
    <input type="hidden" name="xmlUrl" value="<?php echo $xmlUrl; ?>" >
        <input type="hidden" name="icsrId" value="<?php echo $icsrId; ?>" >
        <p>

        <div class="form-group field-email ">
            <label class="control-label col-sm-3" for="email"><?= Yii::t('app','Email')?></label>
            <div class="col-sm-6">
                <input type="email" id="email" class="form-control" name="email" >

            </div>

        </div>


        <div class="form-group field-additionalInfo ">
            <label class="control-label col-sm-3" for="additionalInfo"><?= Yii::t('app','Additional Info')?></label>
            <div class="col-sm-6">
                <textarea id="additionalInfo" class="form-control" name="additionalInfo" ></textarea>
            </div>
         </div>

        </p>
        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [ [
                    'label'   => Yii::t('app', 'Create Email'),
                    'content' => $this->blocks['main'],
                    'active'  => true,
                ], ]
            ]
        );
        ?>
        <hr/>



        <?= Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> ' .
            "Send",
            [
                'id' => 'save',
                'class' => 'btn btn-success'
            ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
