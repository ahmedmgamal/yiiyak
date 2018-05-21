<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out your email. A link to reset password will be sent there.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput() ?>

                <div class="form-group">
                    <?php
                    $session = Yii::$app->session;
                    if($session->get('success')){
                        echo Html::submitButton('Send', ['class' => 'btn','disabled'=>'true']);
                    }else{
                       echo Html::submitButton('Send', ['class' => 'btn btn-primary']);
                    }
                    ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php $this->registerJsFile('@web/js/requestPasswordResetToken.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>

