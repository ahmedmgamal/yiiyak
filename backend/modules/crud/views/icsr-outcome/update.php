<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/fcd70a9bfdf8de75128d795dfc948a74
 *
 * @package default
 */


use yii\helpers\Html;

/**
 *
 * @var yii\web\View $this
 * @var backend\modules\crud\models\IcsrOutcome $model
 */
$this->title = $model->getAliasModel() . $model->icsr_id . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->icsr_id, 'url' => ['view', 'icsr_id' => $model->icsr_id, 'icsr_outcome_lkp_id' => $model->icsr_outcome_lkp_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud icsr-outcome-update">

    <h1>
        <?php echo $model->getAliasModel() ?>        <small>
                        <?php echo $model->icsr_id ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?php echo Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'icsr_id' => $model->icsr_id, 'icsr_outcome_lkp_id' => $model->icsr_outcome_lkp_id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
