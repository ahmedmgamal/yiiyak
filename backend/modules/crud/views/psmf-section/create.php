<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var backend\modules\crud\models\PsmfSection $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'PsmfSections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud psmf-section-create">

    <h1>
        <?= Yii::t('app', 'PsmfSection') ?>        <small>
                        <?= $model->id ?>        </small>
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

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
