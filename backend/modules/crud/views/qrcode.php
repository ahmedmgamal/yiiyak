
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;



$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>

<?php

if(! empty($alert)){
    echo "<div style=' padding: 20px;
    background-color: #f44336;
    color: white;'> $alert </div>";
}
?>

<img src="<?= $googleUri ?>" alt="" />
<input type="text" calss="form-control" name="qrcode" style="width: 15%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;" placeholder="Verification Code" >

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>


