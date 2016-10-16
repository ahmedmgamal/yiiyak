 <?php

 use yii\helpers\Html;
 use \dmstr\bootstrap\Tabs;
 use yii\bootstrap\ActiveForm;

 ?>

<div class="icsr-form">

    <?php $form = ActiveForm::begin([
        'id' => 'IcsrNullReason',
        'layout' => 'horizontal',
        'action' => ['export?id='.$model->id.'&case=null'],
           'options' => ['target' =>'_blank']

    ]
);
?>

    <?php $this->beginBlock('main'); ?>



    <p>
        <label class="control-label col-sm-3" for="null-reason">Nullification Reason</label>
    <div class="col-sm-6">
     <?php echo Html::input('text','nullReason','',['class' => 'form-control' , 'id' => 'null-reason' , 'required' => true]); ?>
    </div>


 </p>
    <?php $this->endBlock(); ?>
    <?=
    Tabs::widget(
        [
            'encodeLabels' => false,
            'items' => [ [
                'label'   => 'Null Case Reason',
                'content' => $this->blocks['main'],
                'active'  => true,
            ], ]
        ]
    );
    ?>

    <?php echo Html::submitButton(
        '<span class="glyphicon glyphicon-check"></span> ' .
        ($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Export')),
        [
            'id' => 'save-' . $model->formName(),
            'class' => 'btn btn-success'
        ]
    );
    ?>



    <?php ActiveForm::end(); ?>

</div>


