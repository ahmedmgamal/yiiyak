<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\DrugPrescription $model
*/

$this->title = $model->getAliasModel() . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => isset($model->drug->trade_name) ? $model->drug->trade_name : 'Show' , 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud drug-prescription-update">

    <h1>
        <?= $model->getAliasModel() ?>        <small>
                     </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
