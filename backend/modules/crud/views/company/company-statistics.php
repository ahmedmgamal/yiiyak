<?php
/**
 *
 * @var yii\web\View $this
 * @var backend\modules\crud\models\Company $model
 */

use yii\bootstrap\Tabs;
use yii\widgets\DetailView;

$this->title = $model->getAliasModel() . $model->name;

$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
?>

<div class="giiant-crud company-statistics">
    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?php echo \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?php echo $model->getAliasModel() ?>        <small>
            <?php echo $model->name ?>        </small>
        <small class="subscriptionEnd"><?= Yii::t('app','subscription ends on ') . $model->end_date?></small>
    </h1>

    <div class="clearfix crud-navigation">
        </div>
    <br><br>
    <div class="tab-content"><div id="relation-tabs-tab0" class="tab-pane active">

            <table id="w0" class="table table-striped table-bordered detail-view">
                <tbody>
                <tr><th class="col-md-3"><?= Yii::t('app','Type')?></th> <th class="col-md-3"><?= Yii::t('app','Total')?></th> <th class="col-md-3"><?= Yii::t('app','Used')?></th> <th class="col-md-3"><?= Yii::t('app','Remaining')?></th></tr>
               <tr><td><?= Yii::t('app','Product') ?></td><td><?= $totalProducts ?></td><td><?= $usedProducts?></td><td><?= $remainingProducts ?></td></tr>
                <tr><td><?= Yii::t('app','User') ?></td><td><?= $totalUsers ?></td><td><?= $usedUsers?></td><td><?= $remainingUsers ?></td></tr>

                </tbody>
            </table>
        </div></div>


    <hr/>

</div>
<?php $this->registerCssFile('@web/crud/company/css/custom.css',['depends' => [\yii\bootstrap\BootstrapAsset::className()]])?>
